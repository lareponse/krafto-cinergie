<?php

namespace App\Controllers\Open;

use \HexMakina\kadro\Models\Tag;
use App\Models\Professional as Model;
use App\Models\ProfessionalPraxis;

use App\Controllers\Abilities\Paginator;


class Professional extends Kortex
{
    private const PRAXIS_PARENT_ID = 91;
    private const ALLOWED_GENDERS = ['h','f','nb'];
    
    public function professionals()
    {
        $filters = array_merge($this->routerParamsAsFilters(), ['isListed' => '1']);
        $options = ['order_by' => [['professional', 'lastname', 'ASC'], ['professional', 'firstname', 'ASC']]];


        $paginator = new Paginator($this->router()->params('page'), $filters, $options);
        $paginator->perPage(12);
        $paginator->setClass(Model::class);


        $this->viewport('paginator', $paginator);
        $this->viewport('praxis', ProfessionalPraxis::all());
        $this->viewport('form_filters', $this->router()->params());
    }

    public function professional()
    {
        $slug = $this->router()->params('slug');
        $professional = Model::exists('slug', $slug);
        dd($professional, $slug);
    }

    private function routerParamsAsFilters()
    {
        $filters = [];
        if($this->router()->params('metier')){
            $praxis_id = $this->router()->params('metier');
            $professional_ids = (ProfessionalPraxis::professionalIds($praxis_id));
            $filters['ids'] = $professional_ids;
        }

        if(!empty($this->router()->params('genre')) && in_array($this->router()->params('genre'), self::ALLOWED_GENDERS)){
            $filters['gender'] = $this->router()->params('genre'); 
        }

        if($this->router()->params('tranche-age')){
            $tranche = $this->router()->params('tranche-age');
            
            $now = new \DateTimeImmutable();
            $interval = new \DateInterval('P'.$tranche.'Y');

            $filters['birthYearMin'] = $now->sub($interval)->format('Y');
        }

        if($this->router()->params('nom')) {
            $filters['fullname'] = $this->router()->params('nom');
        }

        return $filters;
    }

}
