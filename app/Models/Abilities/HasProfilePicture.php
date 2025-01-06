<?php
namespace App\Models\Abilities;

trait HasProfilePicture
{

    public function defaultProfilePicture():string{
        return '/public/images/cinergie-avatar.svg';
    }
    
    public function profilePictureField():string {
        return 'avatar';
    }

    public function hasProfilePicture(): bool
    {
        return !empty($this->profilePicturePath());
    }

    public function profilePicturePath(): string
    {
        return $this->get($this->profilePictureField()) ?? '';
    }

    public function profilePicture(): string
    {
        return $this->hasProfilePicture() ? $this->profilePicturePath() : $this->defaultProfilePicture();
    }

}
