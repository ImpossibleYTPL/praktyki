<?php

//informacje

//kandydat

$firstname = filter_input(INPUT_POST, 'Imie', FILTER_SANITIZE_STRING);
$secondname = filter_input(INPUT_POST, 'drugie_imie', FILTER_SANITIZE_STRING);
$surname = filter_input(INPUT_POST, 'Nazwisko', FILTER_SANITIZE_STRING);
$bornDate = filter_input(INPUT_POST, 'Data_ur', FILTER_SANITIZE_STRING);
$bornLocation = filter_input(INPUT_POST, 'miejsce_ur', FILTER_SANITIZE_STRING);
$PESEL = filter_input(INPUT_POST, 'PESEL', FILTER_SANITIZE_STRING);
$tel = filter_input(INPUT_POST, 'nr_tel', FILTER_SANITIZE_STRING);
$mail = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

//adres kandydata

$KAcity = filter_input(INPUT_POST, 'miejsce_zam', FILTER_SANITIZE_STRING);
$KAstreet = filter_input(INPUT_POST, 'ulica', FILTER_SANITIZE_STRING);
$KAGMINA = filter_input(INPUT_POST, 'gmina', FILTER_SANITIZE_STRING);
$KApostcode = filter_input(INPUT_POST, 'kod_pocztowy', FILTER_SANITIZE_STRING);
$KApost = filter_input(INPUT_POST, 'poczta', FILTER_SANITIZE_STRING);

//adres zameldowania

$MAcity = (!isset($_POST['zamche'])) ? filter_input(INPUT_POST, 'miejsce_zamel', FILTER_SANITIZE_STRING) : $KAcity;
$MAstreet = (!isset($_POST['zamche'])) ? filter_input(INPUT_POST, 'ulica_zamel', FILTER_SANITIZE_STRING) : $KAstreet;
$MAGMINA = (!isset($_POST['zamche'])) ? filter_input(INPUT_POST, 'gmina_zamel', FILTER_SANITIZE_STRING) : $KAGMINA;
$MApostcode = (!isset($_POST['zamche'])) ? filter_input(INPUT_POST, 'kod_pocztowy_zamel', FILTER_SANITIZE_STRING) : $KApostcode;
$MApost = (!isset($_POST['zamche'])) ? filter_input(INPUT_POST, 'poczta', FILTER_SANITIZE_STRING) : $KApost;

//opiekunowie
//matka

$MDname = filter_input(INPUT_POST, 'Imie_matki', FILTER_SANITIZE_STRING);
$MDsurname = filter_input(INPUT_POST, 'Nazwisko_matki', FILTER_SANITIZE_STRING);
$MDcity = (!isset($_POST['MATche'])) ? filter_input(INPUT_POST, 'miejsce_zamMAT', FILTER_SANITIZE_STRING) : $KAcity;
$MDstreet = (!isset($_POST['MATche'])) ? filter_input(INPUT_POST, 'ulicaMAT', FILTER_SANITIZE_STRING) : $KAstreet;
$MDGMINA = (!isset($_POST['MATche'])) ? filter_input(INPUT_POST, 'gminaMAT', FILTER_SANITIZE_STRING) : $KAGMINA;
$MDpostcode = (!isset($_POST['MATche'])) ? filter_input(INPUT_POST, 'kod_pocztowyMAT', FILTER_SANITIZE_STRING) : $KApostcode;
$MDpost = (!isset($_POST['MATche'])) ? filter_input(INPUT_POST, 'pocztaMAT', FILTER_SANITIZE_STRING) : $KApost;
$MDtel = filter_input(INPUT_POST, 'nr_tel_matki', FILTER_SANITIZE_STRING);
$MDmail = filter_input(INPUT_POST, 'email_matki', FILTER_SANITIZE_EMAIL);

//ojciec

$FDname = filter_input(INPUT_POST, 'Imie_ojca', FILTER_SANITIZE_STRING);
$FDsurname = filter_input(INPUT_POST, 'Nazwisko_ojca', FILTER_SANITIZE_STRING);
// ojciec
$FDcity = (!isset($_POST['OJCAche'])) ? filter_input(INPUT_POST, 'miejsce_zOJCA', FILTER_SANITIZE_STRING) : $KAcity;
$FDstreet = (!isset($_POST['OJCAche'])) ? filter_input(INPUT_POST, 'ulicaOJCA', FILTER_SANITIZE_STRING) : $KAstreet;
$FDGMINA = (!isset($_POST['OJCAche'])) ? filter_input(INPUT_POST, 'gminaOJCA', FILTER_SANITIZE_STRING) : $KAGMINA;
$FDpostcode = (!isset($_POST['OJCAche'])) ? filter_input(INPUT_POST, 'kod_pocztowyOJCA', FILTER_SANITIZE_STRING) : $KApostcode;
$FDpost = (!isset($_POST['OJCAche'])) ? filter_input(INPUT_POST, 'pocztaOJCA', FILTER_SANITIZE_STRING) : $KApost;
$FDtel = filter_input(INPUT_POST, 'nr_tel_ojca', FILTER_SANITIZE_STRING);
$FDmail = filter_input(INPUT_POST, 'email_ojca', FILTER_SANITIZE_EMAIL);

// opiekun
$GDname = filter_input(INPUT_POST, 'Imie_op', FILTER_SANITIZE_STRING);
$GDsurname = filter_input(INPUT_POST, 'Nazwisko_op', FILTER_SANITIZE_STRING);
$GDcity = filter_input(INPUT_POST, 'miejsce_zGD', FILTER_SANITIZE_STRING);
$GDstreet = filter_input(INPUT_POST, 'ulicaGD', FILTER_SANITIZE_STRING);
$GDGMINA = filter_input(INPUT_POST, 'gminaGD', FILTER_SANITIZE_STRING);
$GDpostcode = filter_input(INPUT_POST, 'kod_pocztowyGD', FILTER_SANITIZE_STRING);
$GDpost = filter_input(INPUT_POST, 'pocztaGD', FILTER_SANITIZE_STRING);
$GDtel = filter_input(INPUT_POST, 'nr_tel_op', FILTER_SANITIZE_STRING);
$GDmail = filter_input(INPUT_POST, 'email_op', FILTER_SANITIZE_EMAIL);

// wniosek
$date = filter_input(INPUT_POST, 'data', FILTER_SANITIZE_STRING);
$time = filter_input(INPUT_POST, 'godz', FILTER_SANITIZE_STRING);

// profile
$profil1 = filter_input(INPUT_POST, 'profil', FILTER_SANITIZE_STRING);
$profil2 = filter_input(INPUT_POST, 'profil2', FILTER_SANITIZE_STRING);
$profil3 = filter_input(INPUT_POST, 'profil3', FILTER_SANITIZE_STRING);


require_once "DataBase.php";

$link = new mysqli($servername, $username, $password, $dbname);

if($link->errno != 0) die("Blad polaczenia z baza");

$result = $link->prepare("SELECT PESEL FROM `kandydat` Where `Pesel` = ?");
$result->bind_param('s', $PESEL);
$result->execute();
$result->bind_result($ok);

if($result->num_rows >= 1) die("Ten pesel jest juz w bazie");
$result->close();
if(isset($_COOKIE['send'])) die("wysyłasz za dużo zgłoszen");
else
setcookie("send", "ok", time() + 86400);

$result = $link->prepare("SELECT `ID` FROM `adres` WHERE Miejscowosc = ? AND Ulica = ? AND Gmina = ? AND `Kod pocztowy` = ? AND Poczta = ?");
$result->bind_param('sssss', $KAcity, $KAstreet, $KAGMINA, $KApostcode, $KApost);
$result->execute();
$result->bind_result($ok);
$result->store_result();
if($result->num_rows >= 1) $adresID = $result->fetch()[0];
else{
    $result = $link->prepare("INSERT INTO `adres` VALUES(NULL, ?, ?, ?, ?, ?)");
    $result->bind_param('sssss', $KAcity, $KAstreet,$KAGMINA,$KApostcode,$KApost);
    $result->execute();
}

$result->close();
$link->close();
?>