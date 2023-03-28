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

$pdo = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[Miejscowosc]' AND `Ulica` = '$data[UlicaNrDomu]' AND `Kod pocztowy` = '$data[kodPocztowy]' AND `Gmina` = '$data[Gmina]' AND `Poczta` = '$data[Poczta]'");
$pdo->execute();
if($pdo->num_rows() >= 1) {
    $result = $pdo->fetch();
    $idAdres = $result['ID'];
    $pdo->close();
} else {
    $pdo->close();
    $pdo = $link->prepare("INSERT INTO `adres`(`Miejscowosc`, `Ulica`, `Kod pocztowy`, `Gmina`, `Poczta`) VALUES ( ?, ?, ?, ?, ?)");
    $pdo->bind_param("sssss" , $data['Miejscowosc'], $data['UlicaNrDomu'], $data['kodPocztowy'], $data['Gmina'], $data['Poczta']);
    $pdo->execute();
    $idAdres = $pdo->insert_id;
    $pdo->close();
}

//zameldowanie
$pdo = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[MiejscowoscZameldowanie]' AND `Ulica` = '$data[UlicaNrDomuZameldowanie]' AND `Kod pocztowy` = '$data[kodPocztowyZameldowanie]' AND `Gmina` = '$data[GminaZameldowanie]' AND `Poczta` = '$data[PocztaZameldowanie]'");
$pdo->execute();
if($pdo->num_rows() >= 1) {
    $result = $pdo->fetch();
    $idZameldowanie = $result['ID'];
    $pdo->close();
} else {
    $pdo->close();
    $pdo = $link->prepare("INSERT INTO `adres`(`Miejscowosc`, `Ulica`, `Kod pocztowy`, `Gmina`, `Poczta`) VALUES ( ?, ?, ?, ?, ?)");
    $pdo->bind_param("sssss" , $data['MiejscowoscZameldowanie'], $data['UlicaNrDomuZameldowanie'], $data['kodPocztowyZameldowanie'], $data['GminaZameldowanie'], $data['PocztaZameldowanie']);
    $pdo->execute();
    $idZameldowanie = $pdo->insert_id;
    $pdo->close();
}

//opiekuni
//matka
if(!empty($data['KodMatki'])) {
    $pdo = $link->prepare("SELECT * FROM `opiekun` WHERE `Nazwisko` = '$data[NazwiskoMatki]' AND `Imie` = '$data[ImieMatki]' AND `Numer telefonu` = '$data[NumerTelefonuMatki]' AND `Mail` = '$data[MailMatki]'");
    if($pdo->num_rows() >= 1) {
        $idMatki = $pdo->fetch()['ID'];
        $pdo->close();
    } else {
    $pdo->close();
    $pdo = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[MiejscowoscMatki]' AND `Ulica` = '$data[UlicaMatki]' AND `Kod pocztowy` = '$data[KodMatki]' AND `Gmina` = NULL AND `Poczta` = NULL");
    $pdo->execute();
if($pdo->num_rows() >= 1) {
    $result = $pdo->fetch();
    $idAdresMatki = $result['ID'];
    $pdo->close();
} else {
    $pdo->close();
    $pdo = $link->prepare("INSERT INTO `adres`(`Miejscowosc`, `Ulica`, `Kod pocztowy`) VALUES ( ?, ?, ?)");
    $pdo->bind_param("sss" , $data['MiejscowoscMatki'], $data['UlicaMatki'], $data['KodMatki']);
    $pdo->execute();
    $idAdresMatki = $pdo->insert_id;
}
$pdo->close();
$pdo = $link->prepare("INSERT INTO `opiekun`(`Nazwisko`, `Imie`, `Numer telefonu`, `Mail`, `ID Adres`) VALUES (?, ?, ?, ?, ?)");
$pdo->bind_param("ssssi", $data['NazwiskoMatki'], $data['ImieMatki'], $data['NumerTelefonuMatki'], $data['MailMatki'], $idAdresMatki);
$pdo->execute();
$idMatki = $pdo->insert_id;
}
}

//ojciec
if(!empty($data['KodOjca'])) {
    $pdo->close();
    $pdo = $link->prepare("SELECT * FROM `opiekun` WHERE `Nazwisko` = '$data[NazwiskoOjca]' AND `Imie` = '$data[ImieOjca]' AND `Numer telefonu` = '$data[NumerTelefonuOjca]' AND `Mail` = '$data[MailOjca]'");
    if($pdo->num_rows() >= 1) {
        $idOjca = $pdo->fetch()['ID'];
    } else {
        $pdo->close();
    $pdo = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[MiejscowoscOjca]' AND `Ulica` = '$data[UlicaOjca]' AND `Kod pocztowy` = '$data[KodOjca]' AND `Gmina` = NULL AND `Poczta` = NULL");
    $pdo->execute();
if($pdo->num_rows() >= 1) {
    $result = $pdo->fetch();
    $idAdresOjca = $result['ID'];
} else {
    $pdo->close();
    $pdo = $link->prepare("INSERT INTO `adres`(`Miejscowosc`, `Ulica`, `Kod pocztowy`) VALUES ( ?, ?, ?)");
    $pdo->bind_param("sssss" , $data['MiejscowoscOjca'], $data['UlicaOjca'], $data['KodOjca']);
    $pdo->execute();
    $idAdresOjca = $pdo->insert_id;
}
$pdo->close();
$pdo = $link->prepare("INSERT INTO `opiekun`(`Nazwisko`, `Imie`, `Numer telefonu`, `Mail`, `ID Adres`) VALUES (?, ?, ?, ?, ?)");
$pdo->bind_param("sssss", $data['NazwiskoOjca'], $data['ImieOjca'], $data['NumerTelefonuOjca'], $data['MailOjca'], $idAdresOjca);
$idOjca = $pdo->insert_id;
}
}
//opiekun
if(!empty($data['KodOpiekuna'])) {
    $pdo->close();
    $pdo = $link->prepare("SELECT * FROM `opiekun` WHERE `Nazwisko` = '$data[NazwiskoOpiekuna]' AND `Imie` = '$data[ImieOpiekuna]' AND `Numer telefonu` = '$data[NumerTelefonuOpiekuna]' AND `Mail` = '$data[MailOpiekuna]'");
    if($pdo->num_rows() >= 1) {
        $idMOpiekuna = $pdo->fetch()['ID'];
    } else {
        $pdo->close();
    $pdo = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[MiejscowoscOpiekuna]' AND `Ulica` = '$data[UlicaOpiekuna]' AND `Kod pocztowy` = '$data[KodOpiekuna]' AND `Gmina` = NULL AND `Poczta` = NULL");
    $pdo->execute();
if($pdo->num_rows() >= 1) {
    $result = $pdo->fetch();
    $idAdresOpiekuna = $result['ID'];
} else {
    $pdo->close();
    $pdo = $link->prepare("INSERT INTO `adres`(`Miejscowosc`, `Ulica`, `Kod pocztowy`) VALUES ( ?, ?, ?)");
    $pdo->bind_param("sssss" , $data['MiejscowoscOpiekuna'], $data['UlicaOpiekuna'], $data['KodOpiekuna']);
    $pdo->execute();
    $idAdresOpiekuna = $pdo->insert_id;
}
$pdo->close();
$pdo = $link->prepare("INSERT INTO `opiekun`(`Nazwisko`, `Imie`, `Numer telefonu`, `Mail`, `ID Adres`) VALUES (?, ?, ?, ?, ?)");
$pdo->bind_param("sssss", $data['NazwiskoOpiekuna'], $data['ImieOpiekuna'], $data['NumerTelefonuOpiekuna'], $data['MailOpiekuna'], $idAdresOpiekuna);
$idOpiekuna = $pdo->insert_id;
}
}

//kandydat

//opieka

//punkty

//wniosek


$pdo->close();
$link->close();
 ?>