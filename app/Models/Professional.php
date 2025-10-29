<?php

namespace App\Models;

use HexMakina\BlackBox\Database\SelectInterface;
use HexMakina\TightORM\TightModel;

class Professional extends TightModel
{
    use Abilities\HasCompletion;
    use Abilities\HasAddress;
    use Abilities\HasSlug;
    use Abilities\HasTags;
    use Abilities\HasPraxis;
    use Abilities\HasProfilePicture;
    use Abilities\HasSecrets;

    use Abilities\FiltersOnFirstChar;

    public const PRAXIS_DIRECTOR_SLUG = 'pro-praxis-realisateur';

    public function __toString()
    {
        return $this->fullName();
    }

    public function tagIds(): array
    {
        return [];
    }


    public static function idsByPraxis(int $praxis_id): array
    {
        $query = 'SELECT `professional_praxis`.`professional_id` FROM `professional_praxis`  WHERE `professional_praxis`.`tag_id` = :tag_id';
        $query = self::raw($query, ['tag_id' => $praxis_id]);

        return $query->fetchAll(\PDO::FETCH_COLUMN);
    }

    public function fieldsForCompletion(): array
    {
        return ['firstname', 'lastname', 'content', 'gender', 'birth', ['tel', 'gsm', 'fax'], 'email', 'url', 'country', 'province', 'zip', 'city', 'street'];
    }


    public function fullName(): string
    {
        return empty($this->get('label')) ? $this->get('lastname') . ' ' . $this->get('firstname') : $this->get('label');
    }


    // TODO this is wrong, use join to select article in a single query (copy paste lazyness)
    // check Article::related_ids()
    public function relatedArticles(): array
    {
        $ret = [];

        $res = self::database()->table('article_professional')->select(['article_id'])->whereEQ('professional_id', $this->id());
        $res = $res->retCol();
        
        if(!empty($res)){
            
            $query = Article::filter();
            $query = $query->whereNumericIn('id', $res);
            $res = $query->retObj(Article::class);
            if(!empty($res)){
                $ret = $res;
            }
        }

        return $ret;
    }

    public static function filter($filters = [], $options = []): SelectInterface
    {
        //---- JOIN & FILTER SERVICE
        $Query = parent::filter($filters, $options);

        $Query->selectAlso(['label' => "CONCAT(firstname,' ', lastname)"]);

        if (isset($filters['organisation'])) {
            $Query->join(['organisation_professional', 'organisation_professional'], [
                ['professional', 'id', 'organisation_professional', 'professional_id'],
                ['organisation_professional', 'organisation_id', $filters['organisation']->id()]
            ]);
        }

        if (isset($filters['article'])) {
            $Query->join(['article_professional', 'article_professional'], [
                ['professional', 'id', 'article_professional', 'professional_id'],
                ['article_professional', 'article_id', $filters['article']->id()]
            ]);
        }

        if (isset($options['withoutDeadites']) && $options['withoutDeadites'] === true) {
            $Query->whereEmpty('death');
        }
        if (isset($options['withMoviePraxis'])) {
            $movie = $options['withMoviePraxis'];
            $Query->join(['movie_professional', 'workedOn'], [
                ['workedOn','professional_id', 'professional', 'id'],
                ['workedOn', 'movie_id', $movie->id()]
            ]);
            
            $Query->selectAlso(['workedAs' => ["GROUP_CONCAT(DISTINCT workedOn.praxis_id SEPARATOR ', ')"]]);
            $Query->groupBy(['professional', 'id']);
        }
        else if (!isset($options['withPraxis']) || $options['withPraxis'] !== false) {
            $Query->join(['professional_praxis', 'praxis'], [['praxis', 'professional_id', 'professional', 'id']], 'LEFT OUTER');
            $Query->selectAlso(['praxis_ids' => ["GROUP_CONCAT(DISTINCT praxis.tag_id SEPARATOR ',')"]]);
            $Query->groupBy(['professional', 'id']);
        }

        if (isset($filters['FiltersOnFirstChar'])) {
            self::applyFirstCharFilter($filters['FiltersOnFirstChar'], $Query, 'lastname');
        }

        if (isset($filters['fullname'])) {

            $isLike = '%' . $filters['fullname'] . '%';
            $bindname = $Query->addBinding('fullNameSearch', $isLike);
            $Query->whereWithBind('CONCAT(`professional`.`firstname`, \' \',`professional`.`lastname`) LIKE ' . $bindname);
        }
        return $Query;
    }

    public function before_save(): array
    {
        $this->set('label', $this->fullName());
        return parent::before_save();
    }
}
