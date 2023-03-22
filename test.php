<?php

require_once "DataBase.php";

$link = new mysqli($servername, $username, $password, $dbname);

$safePost = filter_input(INPUT_POST, 'Nazwisko', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$data = array();
foreach ($_POST as $key => $value) {
    $safePost = str_replace([';','-'],'',$safePost);
    $safePost = trim($safePost);
    $safePost = strtolower($safePost);
    $safePost = ucfirst($safePost);
    $data[$key] = $value;
}

var_dump($data);

?>