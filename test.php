<?php

//informacje

//kandydat

$firstname = $_POST['Imie'];
$secondname = $_POST['drugie_imie'];
$surname = $_POST['Nazwisko'];
$bornDate = $_POST['Data_ur'];
$bornLocation = $_POST['miejsce_ur'];
$PESEL = $_POST['PESEL'];
$tel = $_POST['nr_tel'];
$mail = $_POST['email'];

//adres kandydata

$KAcity = $_POST['miejsce_zam'];
$KAstreet = $_POST['ulica'];
$KAGMINA = $_POST['gmina'];
$KApostcode = $_POST['kod_pocztowy'];
$KApost = $_POST['poczta'];

//adres zameldowania

$MAcity = (!$_POST['zamche']) ? $_POST['miejsce_zamel'] : $KAcity;
$MAstreet = (!$_POST['zamche']) ? $_POST['ulica_zamel'] : $KAstreet;
$MAGMINA = (!$_POST['zamche']) ? $_POST['gmina_zamel'] : $KAGMINA;
$MApostcode = (!$_POST['zamche']) ? $_POST['kod_pocztowy_zamel'] : $KApostcode;
$MApost = (!$_POST['zamche']) ? $_POST['poczta'] : $KApost;

//opiekunowie
//matka

$MDname = $_POST['Imie_matki'];
$MDsurname = $_POST['Nazwisko_matki'];
$MDcity = (!$_POST['MATche']) ? $_POST['miejsceMAT'] : $KAcity;
$MDstreet = (!$_POST['MATche']) ? $_POST['ulicaMAT'] : $KAstreet;
$MDGMINA = (!$_POST['MATche']) ? $_POST['gminaMAT'] : $KAGMINA;
$MDpostcode = (!$_POST['MATche']) ? $_POST['kod_pocztowyMAT'] : $KApostcode;
$MDpost = (!$_POST['MATche']) ? $_POST['pocztaMAT'] : $KApost;
$MDtel = $_POST['nr_tel_matki'];
$MDmail = $_POST['email_matki'];

//ojciec

$FDname = $_POST['Imie_ojca'];
$FDsurname = $_POST['Nazwisko_ojca'];
$FDcity = (!$_POST['OJCAche']) ? $_POST['miejscOJCA'] : $KAcity;
$FDstreet = (!$_POST['OJCAche']) ? $_POST['ulicaOJCA'] : $KAstreet;
$FDGMINA = (!$_POST['OJCAche']) ? $_POST['gminaOJCA'] : $KAGMINA;
$FDpostcode = (!$_POST['OJCAche']) ? $_POST['kod_pocztowyOJCA'] : $KApostcode;
$FDpost = (!$_POST['OJCAche']) ? $_POST['pocztaOJCA'] : $KApost;
$FDtel = $_POST['nr_tel_ojca'];
$FDmail = $_POST['email_ojca'];

//opiekun

$GDname = $_POST['Imie_op'];
$GDsurname = $_POST['Nazwisko_op'];
$GDcity = $_POST['miejsce_zGD'];
$GDstreet = $_POST['ulicaGD'];
$GDGMINA = $_POST['gmidaGD'];
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

?>