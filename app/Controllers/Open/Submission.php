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



        $res = explode('/', $this->router()->referer());

        // no slug
        if (!isset($res[4])) {
            $page = $res[3];
            $submission->set('urn', $page);
        } else {

            list($type, $slug) = array_slice($res, -2);
            $trans = [
                'personne' => \App\Models\Professional::class,
                'organisation' => \App\Models\Organisation::class,
                'job' => Job::class
            ];

            // deny the request if the type is not found
            $fqnClass = $trans[$type] ?? $this->router()->hopBack();

            // deny the request if the record is not found through the slug
            $existing = $fqnClass::exists(['slug' => $slug]) ?? $this->router()->hopBack();

            // now we have a verified slug and a record, we can proceed with the form
            $submission->set('urn', $existing->urn());
        }

        $submission->save(0);

        $this->viewport('submission', $submission);
    }
}
