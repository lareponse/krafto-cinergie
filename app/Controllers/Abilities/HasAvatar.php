<?php

namespace App\Controllers\Abilities;

trait HasAvatar
{
    /**
     * @param mixed                 $record
     * @param callable              $pathGetter function ($record): (?string)
     * @param (callable|string)|null $fallback  string URL/path or callable returning one; only evaluated if needed
     */
    protected function imageFor($record, callable $pathGetter, $fallback = null)
    {
        $root_path = rtrim($this->get('settings.folders.images'), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
        $root_url  = rtrim($this->get('settings.urls.images'), '/') . '/';

        $res = $pathGetter($record);

        // If it's a string and handled by the image controller directly
        if (is_string($res) && function_exists('str_starts_with') ? str_starts_with($res, '/images/') : strpos($res, '/images/') === 0) {
            return $res;
        }

        // If it's an absolute URL, just return it
        if (is_string($res) && preg_match('~^https?://~i', $res)) {
            return $res;
        }

        // If empty or file missing -> lazy fallback
        if (empty($res) || !file_exists($root_path . $res)) {
            if (is_callable($fallback)) {
                $fb = $fallback(); // evaluate lazily
                return $fb ?? $this->defaultAvatar();
            }
            return $fallback ?? $this->defaultAvatar();
        }

        // Build URL from relative path
        return $root_url . ltrim($res, '/');
    }

    public function avatarFor($record)
    {
        return $this->imageFor($record, fn($r) => $r->profilePicturePath());
    }


    public function defaultAvatar()
    {
        return $this->get('settings.urls.default_image');
    }

    public function bannerFor($record)
    {
        // lazy fallback: only compute avatar if banner missing
        return $this->imageFor(
            $record,
            fn($r) => $r->bannerPicturePath(),
            fn() => $this->avatarFor($record)
        );
    }

    public function HasAvatar__Traitor_after_view()
    {
        $model = $this->loadModel();
        $this->viewport('avatar', $this->avatarFor($model));
        $this->viewport('banner', $this->bannerFor($model));
        $this->viewport('avatarDirectory', $this->nid());
    }
}
