<?php

namespace App\Controllers\Open;

use App\Models\Submission as Model;

class Submission extends Kortex
{
    // The submit method is called when a form is submitted
    public function submit()
    {
        $submission = new Model();
        $submission->set('submitted', json_encode($this->router()->submitted()));


        $res = explode('/', $this->router()->referer());

        // no slug
        if (!isset($res[4])) {
            $page = $res[3];
            $submission->set('urn', $page);
        } else {

            list($type, $slug) = array_slice($res, -2);
            try {
                $type = ucfirst($type);
                $new = $this->get('\\App\\Models\\' . ucfirst($type));
            } catch (\Exception $e) {
                $this->router()->hopBack();
            }

            // deny the request if the record is not found through the slug
            $existing = get_class($new)::exists(['slug' => $slug]);
            if (!$existing) {
                $this->router()->hopBack();
            }

            // now we have a verified slug and a record, we can proceed with the form
            $submission->set('urn', $existing->urn());
        }

        $submission->save(0);

        $this->viewport('submission', $submission);
    }
}
