<?php
require_once  'functions/user_functions.php';

$user_id = $_COOKIE['user'];
$user = user_by_id($_COOKIE['user']);

$postsOnePage = 2;

$config = [
    'companyName' => 'PSS'
];