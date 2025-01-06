<?php
if (!empty($user_messages)) {
    foreach ($user_messages as $level => $messages) {
        $class = $level == 'notice' ? 'success' : $level;
        foreach ($messages as $messageWithContext) {
            list($message, $context) = $messageWithContext;
            echo sprintf('<div class="alert alert-%s" role="alert">%s</div>', $class, $messageWithContext[0]);
        }
    }
}
