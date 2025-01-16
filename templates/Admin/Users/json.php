<?php
foreach ($users as $user) {
    unset($user->generated_html);
}
echo '<pre>' . json_encode(compact('users'), JSON_PRETTY_PRINT) . '</pre>';
