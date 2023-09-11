<?php

namespace App\Models;

use HexMakina\Crudites\Crudites;

class ProfessionalPraxis
{
    public const PARENT_REFERENCE = 'professional_praxis';

    public static function all(): array
    {
        $query = 'SELECT `praxis`.`id`, `praxis`.`label` FROM `tag` as `praxis` 
        INNER JOIN `tag` as `parentTag` ON `parentTag`.`reference` = :parent_reference AND `praxis`.`parent_id` = `parentTag`.`id`';

        $query = Crudites::raw($query, ['parent_reference' => self::PARENT_REFERENCE]);

        return $query->fetchAll(\PDO::FETCH_KEY_PAIR);
    }

    public static function professionalIds(int $praxis_id): array
    {
        $query = 'SELECT `professional_tag`.`professional_id` FROM `professional_tag`  WHERE `professional_tag`.`tag_id` = :tag_id'; 
        $query = Crudites::raw($query, ['tag_id' => $praxis_id]);

        return $query->fetchAll(\PDO::FETCH_COLUMN);
    }
}
