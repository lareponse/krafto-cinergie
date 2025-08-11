<?php
namespace App\Models\Abilities;

trait HasProfilePicture
{
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


    public function bannerPictureField(): string
    {
        return 'avatar_landscape';
    }

    public function hasBannerPicture(): bool
    {
        return !empty($this->bannerPicturePath());
    }

    public function bannerPicturePath(): string
    {
        return $this->get($this->bannerPictureField()) ?? '';
    }
}
