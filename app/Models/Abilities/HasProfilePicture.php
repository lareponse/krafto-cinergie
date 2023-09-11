<?php
namespace App\Models\Abilities;

trait HasProfilePicture
{

    public function defaultProfilePicture():string{
        return 'https://api.dicebear.com/7.x/shapes/svg?seed=Jasmine&backgroundColor=000000&shape2Color=FF0000';
    }
    
    public function profilePictureField():string {
        return 'legacy_photo_illu';
    }

    public function profilePicture(): string
    {
        return empty($this->get($this->profilePictureField())) ? $this->defaultProfilePicture() : '/public' . $this->get($this->profilePictureField());
    }

}
