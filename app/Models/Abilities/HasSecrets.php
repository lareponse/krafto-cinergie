<?php
namespace App\Models\Abilities;

trait HasSecrets
{
    abstract public function get($prop);

    private $secrets = null;
    private $legacy_mapping = [
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
        if(!isset($this->legacy_mapping[$prop])){
            throw new \InvalidArgumentException($prop.' IS NOT A VALID SECRET PROP');
        }

        return in_array($this->legacy_mapping[$prop], $this->secretFields());
    }

    public function canDisplay(string $prop)
    {
        return !empty($this->get($prop)) && !$this->isSecret($prop);
    }

    private function secretFields()
    {
        if(is_null($this->secrets))
            $this->secrets = explode(';', $this->get('secret'));
        
        return $this->secrets;
    }

}
