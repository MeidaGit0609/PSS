<?php
require_once '../../functions/user_functions.php';
require_once '../../config.php';

$header = "Location: ../../../pages/profile/change_name-surname.php" . ' ?change=';

if(count($_POST) > 0) {
    $new_name_surn = htmlspecialchars(trim($_POST['new_name_surname']));
    $user_id       = $_GET['user_id'];
    $user_info     = user_by_id($user_id);

    if(str_word_count($new_name_surn) < 2 ||  strlen($new_name_surn) < 4) {
        $header .= 'name_surname-fail';
    }
    elseif(strlen($new_name_surn) >= 65) {
        $header .= 'very_big';
    }
    else {
        change($new_name_surn, 'name_surname', $user_info['id']);
        $header .= 'happy';
    }
}
else {
    $header .= 'input-fail';
}
header($header);