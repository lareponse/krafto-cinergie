<?php
if (!empty($user_messages)) {
    foreach ($user_messages as $level => $messages) {
        $class = $level == 'notice' ? 'success' : $level;
        if($class == 'success') {
            echo sprintf('<div class="alert alert-%s" role="alert">%s</div>', $class, 'Toutes les modifications ont été enregistrées avec succès');
        }
        elseif($class == 'error') {
            echo sprintf('<div class="alert alert-%s" role="alert">%s</div>', $class, 'Une erreur est survenue lors de l\'enregistrement des modifications');
        }
        elseif($class == 'warning') {
            echo sprintf('<div class="alert alert-%s" role="alert">%s</div>', $class, 'Attention : certaines modifications n\'ont pas été enregistrées');
        }
        elseif($class == 'info') {
            echo sprintf('<div class="alert alert-%s" role="alert">%s</div>', $class, 'Information : certaines modifications ont été enregistrées avec succès');
        }
        // foreach ($messages as $messageWithContext) {
        //     list($message, $context) = $messageWithContext;
        //     echo sprintf('<div class="alert alert-%s" role="alert">%s</div>', $class, $messageWithContext[0]);
        // }
    }
}
