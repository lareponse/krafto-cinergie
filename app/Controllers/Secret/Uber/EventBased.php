<?php

namespace App\Controllers\Secret\Uber;

use App\Controllers\Secret\Krafto;

class EventBased extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    public function activeSection(): string
    {
      return 'Event';
    }

    public function home()
    {
        // requires at least a year
        if(empty($this->router()->params('year'))){
          $this->router()->hop($this->defaultHop());
        }

        $filters = $this->router()->params(); 
        $filters['month'] ??= 1;

        // Return an array of records based on filters
        $listing = $this->modelClassName()::filter($filters);

        $this->viewport('listing', $listing);
        $this->viewport('filters', $filters);
    }

    public function defaultHop($model=null): string
    {
        if($model){
            return $this->router()->hyp('dash_record', ['controller' => $this->className(), 'id' => $model->getID()]);
        }

        return $this->router()->hyp('dash_records', ['controller' => $this->className()]).'?year='.date('Y').'&month='.date('m');
    }
}
