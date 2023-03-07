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
$FDcity = (!isset($_POST['OJCAche'])) ? $_POST['miejsce_zOJCA'] : $KAcity;
$FDstreet = (!isset($_POST['OJCAche'])) ? $_POST['ulicaOJCA'] : $KAstreet;
$FDGMINA = (!isset($_POST['OJCAche'])) ? $_POST['gminaOJCA'] : $KAGMINA;
$FDpostcode = (!isset($_POST['OJCAche'])) ? $_POST['kod_pocztowyOJCA'] : $KApostcode;
$FDpost = (!isset($_POST['OJCAche'])) ? $_POST['pocztaOJCA'] : $KApost;
$FDtel = $_POST['nr_tel_ojca'];
$FDmail = $_POST['email_ojca'];

//opiekun

$GDname = $_POST['Imie_op'];
$GDsurname = $_POST['Nazwisko_op'];
$GDcity = $_POST['miejsce_zGD'];
$GDstreet = $_POST['ulicaGD'];
$GDGMINA = $_POST['gminaGD'];
$GDpostcode = $_POST['kod_pocztowyGD'];
$GDpost = $_POST['pocztaGD'];
$GDtel = $_POST['nr_tel_op'];
$GDmail = $_POST['email_op'];

//wniosek
$date = $_POST['data'];
$time = $_POST['godz'];

//Profile:

$profil1 = $_POST['profil'];
$profil2 = $_POST['profil2'];
$profil3 = $_POST['profil3'];

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
if($result->num_rows >= 1) $adresID = $result->fetch()[0];
$result->close();
$link->close();
?>