<?php

require_once "DataBase.php";

if(!isset($_POST['Nazwisko'])) header("Location: test5.html");

$link = new mysqli($servername, $username, $password, $dbname);

if($link->errno != 0) {
    die("Błąd połączenia ".$link->errno);
}

$safePost = filter_input(INPUT_POST, 'Nazwisko', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$osiagniecia = array();
$data = array();
foreach ($_POST as $key => $value) {
    $value = str_replace([';','-'],'',$value);
    $value = trim($value);
    $value = strtolower($value);
    $value = ucfirst($value);
    $data[$key] = $value;
    if(str_contains($key, 'wyroznienie')) $osiagniecia[$key] = $value;
}


// $pdo = $link->prepare("SELECT * FROM `kandydat` WHERE `Pesel` = ?");
// $pdo->bind_param("s", "$data[Pesel]");
// $pdo->execute();

// if($pdo->num_rows() >= 1) {
//     die("Taki pesel znajduje się już w bazie danych");
// }

var_dump($osiagniecia);
?>