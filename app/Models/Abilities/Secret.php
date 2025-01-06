<?php
namespace App\Models\Abilities;

class Secret
{ 
    private static $legacy_mapping = [
        'country' => 'pays',
        'province' => 'region',
        'city' => 'ville',
        'zip' => 'cp',
        'street' => 'adresse',

        'email' => 'email',
        'tel' => 'tel',
        'fax' => 'fax',
        'gsm' => 'mobile',

        'birth' => 'datenaiss'
    ];

    public function isSecret(string $prop)
    {
        if(!isset(self::$legacy_mapping[$prop])){
            throw new \InvalidArgumentException($prop.' IS NOT A VALID SECRET PROP');
        }
        
        return mb_strpos($this->get('secret'), self::$legacy_mapping[$prop]) !== false;
    }

    public function canDisplay(string $prop)
    {
        return !empty($this->get($prop)) && !$this->isSecret($prop);
    }

}
