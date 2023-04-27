<?php

namespace App\Controllers\Secret\Uber;

use App\Controllers\Secret\Krafto;

abstract class ShopProduct extends Krafto
{
    use \App\Controllers\Abilities\HasORM;

    public function activeSection(): string
    {
      return 'Boutique';
    }

    public function home()
    {
        if(!$this->router()->params('letter')){
            $this->router()->hop($this->defaultHop());
        }

        $listing = $this->modelClassName()::filter($this->router()->params());
        $this->viewport('listing', $listing);
        $this->viewport('filters', $this->router()->params());
    }

    public function defaultHop($model=null): string
    {
        if($model){
            return $this->router()->hyp('dash_record', ['controller' => $this->className(), 'id' => $model->getID()]);
        }

        return $this->router()->hyp('dash_records', ['controller' => $this->className()]).'?letter=AZ';
    }
}
