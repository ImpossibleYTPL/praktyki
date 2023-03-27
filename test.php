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

//wprowadzenie osiagniec do bazy
$osiagniecia = array();
foreach($data as $key => $value) {
    if(str_contains($key, "wyroznienie")){
        $key = str_replace("wyroznienie", "", $key);
        $osiagniecia[$key] = $value;
    }
}

$sql = "INSERT INTO `osiagniecia`(";
$keys = "";
$values = 'VALUES(';

foreach($osiagniecia as $key => $value) {
    $keys .= "`".$key."`" . ", ";
    $values .= $value . ", ";
}
$sql .= substr($keys, 0, -2).") ".substr($values, 0, -2).")";
$pdo = $link->prepare($sql);
$pdo ->execute();

$idOsiagniec = $pdo->insert_id;
echo $sql." id: ".$idOsiagniec;

//kryteria

$kryteria = array();
foreach($data as $key => $value) {
    if(str_contains($key, "kryteria")){
        $key = str_replace("kryteria", "", $key);
        $kryteria[$key] = $value;
    }
}

$sql = "INSERT INTO `kryteria`(";
$keys = "";
$values = 'VALUES(';

foreach($kryteria as $key => $value) {
    $keys .= "`".$key."`" . ", ";
    $values .= $value . ", ";
}
$sql .= substr($keys, 0, -2).") ".substr($values, 0, -2).")";
$pdo = $link->prepare($sql);
$pdo ->execute();

$idKryteria = $pdo->insert_id;
echo $sql." id: ".$idKryteria;

//oceny




//adres

$pdo = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = 'Puck' AND `Ulica` = 'Ulica nr' AND `Kod pocztowy` = '84-100' AND `Gmina` = 'Puck' AND `Poczta` = 'Puck'");
$pdo->execute();
if($pdo->num_rows() >= 1) {
    $result = $pdo->fetch();
    $idAdres = $result['ID'];
} else {
    $pdo = $link->prepare("INSERT INTO `adres`(`Miejscowosc`, `Ulica`, `Kod pocztowy`, `Gmina`, `Poczta`) VALUES ( ?, ?, ?, ?, ?)");
    $pdo->bind_param("sssss" , $data['Miejscowosc'], $data['UlicaNrDomu'], $data['KodPocztowy'], $data['Gmina'], $data['Poczta']);
    $pdo->execute();
    $idAdres = $pdo->insert_id;
}

//zameldowanie

$pdo = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = 'Puck' AND `Ulica` = 'Ulica nr' AND `Kod pocztowy` = '84-100' AND `Gmina` = 'Puck' AND `Poczta` = 'Puck'");
$pdo->execute();
if($pdo->num_rows() >= 1) {
    $result = $pdo->fetch();
    $idZameldowanie = $result['ID'];
} else {
    $pdo = $link->prepare("INSERT INTO `adres`(`Miejscowosc`, `Ulica`, `Kod pocztowy`, `Gmina`, `Poczta`) VALUES ( ?, ?, ?, ?, ?)");
    $pdo->bind_param("sssss" , $data['MiejscowoscZameldowanie'], $data['UlicaNrDomuZameldowanie'], $data['KodPocztowyZameldowanie'], $data['GminaZameldowanie'], $data['PocztaZameldowanie']);
    $pdo->execute();
    $idZameldowanie = $pdo->insert_id;
}

//opiekuni
//matka
var_dump($data);
 ?>