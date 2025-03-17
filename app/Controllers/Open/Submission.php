<?php

namespace App\Controllers\Open;

use App\Models\Submission as Model;

class Submission extends Kortex
{
    // The submit method is called when a form is submitted
    public function submit()
    {
        $submission = new Model();
        // $submission->set('urn', $this->router()->submitted('urn'));
        $submission->set('submitted', json_encode($this->router()->submitted()));
        $submission->set('submitted_by', json_encode(Model::submittedBy()));

        $path = parse_url($this->router()->referer());
        $path = $path['path'];

        if (preg_match('/(personnes|organisations|annonces|boutique)+/', $path, $res) > 0) {
            $submission->set('urn', preg_replace('/[^a-zA-Z0-9]/', '', $path));
        }
        else{
            $parts = trim($path, '/'); // Remove trailing slash if present
            $parts = explode('/', $parts); // Split the path by slashes
            $type = reset($parts); // Get the first non-empty element
            $slug = end($parts); // Get the last non-empty element
           
            $trans = [
                'personne' => \App\Models\Professional::class,
                'organisation' => \App\Models\Organisation::class,
            ];

            $fqnClass = $trans[$type] ?? $this->router()->hopBack();
            $existing = $fqnClass::exists(['slug' => $slug]) ?? $this->router()->hopBack();

            $submission->set('urn', $existing->urn());
        }

     
        $submission->save(0);
        $this->viewport('submission', $submission);
    }
}
