<?php

namespace App\Controllers\Open;

use App\Models\Submission as Model;

class Submission extends Kortex
{
    // The submit method is called when a form is submitted
    public function submit()
    {
        $res = explode('/', $this->router()->referer());

        list($type, $slug) = array_slice($res, -2);

        $new = $this->get('\\App\\Models\\' . ucfirst($type));
        
        // deny the request if the record type is not found
        if(!$new){
            $this->router()->hopBack();
        }
        
        // $new->import($this->router()->submitted());

        
        // deny the request if the record is not found through the slug
        $existing = get_class($new)::exists(['slug' => $slug]);
        if(!$existing){
            $this->router()->hopBack();
        }
        
        // now we have a verified slug and a record, we can proceed with the form
        $submission = new Model();
        $submission->set('urn', $existing->urn());
        $submission->set('submitted', json_encode($this->router()->submitted()));
        $submission->save(0);

        $this->viewport('submission', $submission);
        // $this->router()->hop('submission_confirmed', ['urn' => $submission->urn()]);
    }

    public function confirmed()
    {

    }
}