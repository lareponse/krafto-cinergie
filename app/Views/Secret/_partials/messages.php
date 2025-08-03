<?php
if (!empty($user_messages)) {
    foreach ($user_messages as $level => $messages) {


        $class = $level;
        if ($level === 'notice')
            $class = 'success';
        elseif ($level === 'error')
            $class = 'danger';

        if ($class == 'success') {
            echo sprintf('<div class="alert alert-%s" role="alert">%s</div>', $class, 'Toutes les modifications ont été enregistrées avec succès');
        } elseif ($level == 'error') {

            $message = 'Une erreur est survenue lors de l\'enregistrement des modifications';
            if (is_array($messages) && count($messages) > 1)
                $message = 'Plusieurs erreurs sont survenues lors de l\'enregistrement des modifications';

            foreach ($messages as $m)
                $message .= '<br>' . (is_array($m) ? $m[0] : $m);

            echo sprintf('<div class="alert alert-%s" role="alert">%s</div>', $class, $message);
        } elseif ($class == 'warning') {
            vd($messages);
            echo sprintf('<div class="alert alert-%s" role="alert">%s</div>', $class, 'Attention : certaines modifications n\'ont pas été enregistrées');
        } elseif ($class == 'info') {
            echo sprintf('<div class="alert alert-%s" role="alert">%s</div>', $class, 'Information : certaines modifications ont été enregistrées avec succès');
        }
    }
}
