<?php

namespace App\Controllers\Open;

class Images extends Home
{
  public function legacy()
  {
    $path = $this->router()->params('path');
    $parts = pathinfo($path);

    $newFileNames = array_unique([$parts['filename'], str_replace('_', '-', $parts['filename'])]);
    foreach ($newFileNames as $filename) {
      
      $newPath = $parts['dirname'] . '/' . $filename . '.' . $parts['extension'];

      if (file_exists($this->get('settings.folders.images') . '/' . $newPath)) {
        header("HTTP/1.1 301 Moved Permanently");
        header('Location: '.$this->get('settings.urls.images') . '/' . $newPath);
        exit;
      }
    }

    header("HTTP/1.1 404 Moved Permanently");
    exit;
  }
}
