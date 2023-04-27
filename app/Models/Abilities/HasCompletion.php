<?php
namespace App\Models\Abilities;

trait HasCompletion
{
    // returns the fields required to compute completion
    // f.i. ['firstname','lastname', 'content', 'gender','birth', ['tel','gsm', 'fax'], 'email', 'url','country','province','zip', 'city', 'street'];

    abstract public function fieldsForCompletion(): array;

    public function profileCompletion(): int
    {
        $ret = 0;
        $indicators = $this->fieldsForCompletion();
        foreach($indicators as $field_fields){
            if(is_array($field_fields)){
                $has_one = false;
                foreach($field_fields as $field){
                    if(!empty($this->get($field)))
                        $has_one = true;
                }
                if($has_one)
                    ++$ret;
            }
            else{
                if(!empty($this->get($field_fields)))
                    ++$ret;
            }
        }

        return intval((100/count($indicators))*$ret);
    }
}
