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
    if($key == "kodPocztowy" || $key == "KodMatki" || $key == "KodOjca" || $key == "KodOpeikuna" || $key == "kodPocztowyZameldowanie") {$data[$key] = $value; continue;}
    $value = str_replace([';','-'],'',$value);
    $value = trim($value);
    $value = strtolower($value);
    $value = ucfirst($value);
    $data[$key] = $value;
    if(str_contains($key, 'wyroznienie')) $osiagniecia[$key] = $value;
}

//sprawdzenie czy kandydat jest w bazie danych
$stmt = $link->prepare("SELECT * FROM `kandydat` WHERE `PESEL` = ?");
$stmt->bind_param("i", $data['Pesel']);
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows >= 1) {
    die("Pesel kandydata został już zarejestrowany");
}

//wprowadzenie osiagniec do bazy
$osiagniecia = array();
foreach($data as $key => $value) {
    if(str_contains($key, "wyroznienie")){
        $osiagniecia[$key] = $value;
    }
}

if(count($osiagniecia) != 0) {
$sql = "INSERT INTO `osiagniecia`(";
$keys = "";
$values = 'VALUES(';

foreach($osiagniecia as $key => $value) {
    $keys .= "`".$key."`" . ", ";
    $values .= $value . ", ";
}
$sql .= substr($keys, 0, -2).") ".substr($values, 0, -2).")";
$stmt = $link->prepare($sql);
$stmt ->execute();

$idOsiagniec = $stmt->insert_id;
echo $sql." id: ".$idOsiagniec;

} else $idOsiagniec = NULL;

//oceny
$zachowanie = $data['ocenaZachowanie'];

$egzPol = $data['EgzPol'];
$egzMat = $data['EgzMat'];
$egzAng = $data['EgzAng'];

$polski = $data['oceny1Polski'];
$matematyka = $data['oceny1Matematyka'];
$obcy = $data['oceny1Obcy'];

if(isset($data['oceny1Informatyka'])){ $informatyka = $data['oceny1Informatyka']; $geografia = NULL;}
else if(isset($data['oceny1Geografia'])){$geografia = $data['oceny1Geografia']; $informatyka = NULL;}

if($geografia == NULL) {
    if(isset($data['oceny2Geografia'])) $geografia = $data['oceny2Geografia'];
    if(isset($data['oceny3Geografia'])) $geografia = $data['oceny3Geografia'];
}
if($informatyka == NULL) {
    if(isset($data['oceny2Informatyka'])) $informatyka = $data['oceny2Informatyka'];
    if(isset($data['oceny3Informatyka'])) $informatyka = $data['oceny3Informatyka'];
}

$stmt = $link->prepare("INSERT INTO `oceny`(`Zachowanie`, `Egzamin polski`, `Egzamin matematyka`, `Egzamin jezyk obcy`,
 `Polski`, `Matematyka`, `Jezyk obcy`, `Geografia`, `Informatyka`)
 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("siiiiiiii", $zachowanie, $egzPol, $egzMat, $egzAng, $polski, $matematyka, $obcy, $geografia, $informatyka);
$stmt->execute();
$idOceny = $stmt->insert_id;
$stmt->close();


//adres

$stmt = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[Miejscowosc]' AND `Ulica` = '$data[UlicaNrDomu]' AND `Kod pocztowy` = '$data[kodPocztowy]' AND `Gmina` = '$data[Gmina]' AND `Poczta` = '$data[Poczta]'");
$stmt->execute();
$stmt->store_result();
echo $stmt->num_rows;
if($stmt->num_rows >= 1) {
    $stmt = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[Miejscowosc]' AND `Ulica` = '$data[UlicaNrDomu]' AND `Kod pocztowy` = '$data[kodPocztowy]' AND `Gmina` = '$data[Gmina]' AND `Poczta` = '$data[Poczta]'");
    $stmt->execute();
    $idAdres = $stmt->get_result()->fetch_array()[0];
    $stmt->close();
    
} else {
    
    $stmt = $link->prepare("INSERT INTO `adres`(`Miejscowosc`, `Ulica`, `Kod pocztowy`, `Gmina`, `Poczta`) VALUES ( ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss" , $data['Miejscowosc'], $data['UlicaNrDomu'], $data['kodPocztowy'], $data['Gmina'], $data['Poczta']);
    $stmt->execute();
    $idAdres = $stmt->insert_id;
    $stmt->close();
    
}

//zameldowanie
$stmt = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[MiejscowoscZameldowanie]' AND `Ulica` = '$data[UlicaNrDomuZameldowanie]' AND `Kod pocztowy` = '$data[kodPocztowyZameldowanie]' AND `Gmina` = '$data[GminaZameldowanie]' AND `Poczta` = '$data[PocztaZameldowanie]'");
$stmt->execute();
$stmt->store_result();
if($stmt->num_rows >= 1) {
    $stmt = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[MiejscowoscZameldowanie]' AND `Ulica` = '$data[UlicaNrDomuZameldowanie]' AND `Kod pocztowy` = '$data[kodPocztowyZameldowanie]' AND `Gmina` = '$data[GminaZameldowanie]' AND `Poczta` = '$data[PocztaZameldowanie]'");
    $stmt->execute();
    $idZameldowanie = $stmt->get_result()->fetch_array()[0];
    $stmt->close();
    
} else {
    
    $stmt = $link->prepare("INSERT INTO `adres`(`Miejscowosc`, `Ulica`, `Kod pocztowy`, `Gmina`, `Poczta`) VALUES ( ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss" , $data['MiejscowoscZameldowanie'], $data['UlicaNrDomuZameldowanie'], $data['kodPocztowyZameldowanie'], $data['GminaZameldowanie'], $data['PocztaZameldowanie']);
    $stmt->execute();
    $idZameldowanie = $stmt->insert_id;
    $stmt->close();
    
}

//opiekuni
//matka
if(!empty($data['KodMatki'])) {
    $stmt = $link->prepare("SELECT * FROM `opiekun` WHERE `Nazwisko` = '$data[NazwiskoMatki]' AND `Imie` = '$data[ImieMatki]' AND `Numer telefonu` = '$data[NumerTelefonuMatki]' AND `Mail` = '$data[MailMatki]'");
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows >= 1) {
        $stmt = $link->prepare("SELECT * FROM `opiekun` WHERE `Nazwisko` = '$data[NazwiskoMatki]' AND `Imie` = '$data[ImieMatki]' AND `Numer telefonu` = '$data[NumerTelefonuMatki]' AND `Mail` = '$data[MailMatki]'");
        $stmt->execute();
        $idMatki = $stmt->get_result()->fetch_array()[0];
        $stmt->close();
        
    } else {
    
    $stmt = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[MiejscowoscMatki]' AND `Ulica` = '$data[UlicaMatki]' AND `Kod pocztowy` = '$data[KodMatki]'");
    $stmt->execute();
    $stmt->store_result();
if($stmt->num_rows >= 1) {
    $stmt = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[MiejscowoscMatki]' AND `Ulica` = '$data[UlicaMatki]' AND `Kod pocztowy` = '$data[KodMatki]'");
    $stmt->execute();
    $idAdresMatki = $stmt->get_result()->fetch_array()[0];
    $stmt->close();
    
} else {
    
    $stmt = $link->prepare("INSERT INTO `adres`(`Miejscowosc`, `Ulica`, `Kod pocztowy`) VALUES ( ?, ?, ?)");
    $stmt->bind_param("sss" , $data['MiejscowoscMatki'], $data['UlicaMatki'], $data['KodMatki']);
    $stmt->execute();
    $idAdresMatki = $stmt->insert_id;
    $stmt->close();
}

$stmt = $link->prepare("INSERT INTO `opiekun`(`Nazwisko`, `Imie`, `Numer telefonu`, `Mail`, `ID Adres`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssssi", $data['NazwiskoMatki'], $data['ImieMatki'], $data['NumerTelefonuMatki'], $data['MailMatki'], $idAdresMatki);
$stmt->execute();
$idMatki = $stmt->insert_id;
$stmt->close();
}
}

//ojciec
if(!empty($data['KodOjca'])) {
    
    $stmt = $link->prepare("SELECT * FROM `opiekun` WHERE `Nazwisko` = '$data[NazwiskoOjca]' AND `Imie` = '$data[ImieOjca]' AND `Numer telefonu` = '$data[NumerTelefonuOjca]' AND `Mail` = '$data[MailOjca]'");
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows >= 1) {
        $idOjca = $stmt->get_result()->fetch_array()[0];
        $stmt->close();
        
    } else {
    
    $stmt = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[MiejscowoscOjca]' AND `Ulica` = '$data[UlicaOjca]' AND `Kod pocztowy` = '$data[KodOjca]'");
    $stmt->execute();
    $stmt->store_result();
if($stmt->num_rows >= 1) {
    $stmt = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[MiejscowoscOjca]' AND `Ulica` = '$data[UlicaOjca]' AND `Kod pocztowy` = '$data[KodOjca]'");
    $stmt->execute();
    $idAdresOjca = $stmt->get_result()->fetch_array()[0];
    $stmt->close();
} else {
    
    $stmt = $link->prepare("INSERT INTO `adres`(`Miejscowosc`, `Ulica`, `Kod pocztowy`) VALUES ( ?, ?, ?)");
    $stmt->bind_param("sss" , $data['MiejscowoscOjca'], $data['UlicaOjca'], $data['KodOjca']);
    $stmt->execute();
    $idAdresOjca = $stmt->insert_id;
    $stmt->close();
}

$stmt = $link->prepare("INSERT INTO `opiekun`(`Nazwisko`, `Imie`, `Numer telefonu`, `Mail`, `ID Adres`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $data['NazwiskoOjca'], $data['ImieOjca'], $data['NumerTelefonuOjca'], $data['MailOjca'], $idAdresOjca);
$idOjca = $stmt->insert_id;
$stmt->close();
}
}
//opiekun
if(!empty($data['KodOpiekuna'])) {
    
    $stmt = $link->prepare("SELECT * FROM `opiekun` WHERE `Nazwisko` = '$data[NazwiskoOpiekuna]' AND `Imie` = '$data[ImieOpiekuna]' AND `Numer telefonu` = '$data[NumerTelefonuOpiekuna]' AND `Mail` = '$data[MailOpiekuna]'");
    $stmt->execute();
    $stmt->store_result();
    if($stmt->num_rows >= 1) {
        $stmt = $link->prepare("SELECT * FROM `opiekun` WHERE `Nazwisko` = '$data[NazwiskoOpiekuna]' AND `Imie` = '$data[ImieOpiekuna]' AND `Numer telefonu` = '$data[NumerTelefonuOpiekuna]' AND `Mail` = '$data[MailOpiekuna]'");
        $stmt->execute();
        $idMOpiekuna = $stmt->get_result()->fetch_array()[0];
        $stmt->close();
    } else {
    
    $stmt = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[MiejscowoscOpiekuna]' AND `Ulica` = '$data[UlicaOpiekuna]' AND `Kod pocztowy` = '$data[KodOpiekuna]'");
    $stmt->execute();
    $stmt->store_result();
if($stmt->num_rows >= 1) {
    $stmt = $link->prepare("SELECT * FROM `adres` WHERE `Miejscowosc` = '$data[MiejscowoscOpiekuna]' AND `Ulica` = '$data[UlicaOpiekuna]' AND `Kod pocztowy` = '$data[KodOpiekuna]'");
    $stmt->execute();
    $idAdresOpiekuna = $stmt->get_result()->fetch_array()[0];
    $stmt->close();
} else {
    
    $stmt = $link->prepare("INSERT INTO `adres`(`Miejscowosc`, `Ulica`, `Kod pocztowy`) VALUES ( ?, ?, ?)");
    $stmt->bind_param("sssss" , $data['MiejscowoscOpiekuna'], $data['UlicaOpiekuna'], $data['KodOpiekuna']);
    $stmt->execute();
    $idAdresOpiekuna = $stmt->insert_id;
    $stmt->close();
}

$stmt = $link->prepare("INSERT INTO `opiekun`(`Nazwisko`, `Imie`, `Numer telefonu`, `Mail`, `ID Adres`) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $data['NazwiskoOpiekuna'], $data['ImieOpiekuna'], $data['NumerTelefonuOpiekuna'], $data['MailOpiekuna'], $idAdresOpiekuna);
$idOpiekuna = $stmt->insert_id;
$stmt->close();
}
}

//kandydat


$stmt = $link->prepare("INSERT INTO `kandydat`(`Nazwisko`, `Imie`, `Drugie imie`, `Data urodzenia`, `Miejsce urodzenia`, `PESEL`, `Numer telefonu`, `Mail`, `ID Adres`, `ID Zameldowania`, `ID Oceny`, `ID Osiagniecia`)
 VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");
$stmt->bind_param("ssssssssiiii", $data['Nazwisko'], $data['Imie'], $data['DrugieImie'], $data['DataUrodzenia'], $data['MiejsceUrodzenia'], $data['Pesel'], $data['NumerTelefonu'], $data['Mail'], $idAdres, $idZameldowanie, $idOceny, $idOsiagniec);
$stmt->execute();
$idKandydata = $stmt->insert_id;
$stmt->close();

//opieka
if(isset($idMatki)) {
    
    $stmt = $link->prepare("INSERT INTO `opieka`(`ID Kandydata`, `ID Opiekuna`) VALUES (?, ?)");
    $stmt->bind_param("ii", $idKandydata, $idMatki);
    $stmt->execute();
    $stmt->close();
}
if(isset($idOjca)) {
    
    $stmt = $link->prepare("INSERT INTO `opieka`(`ID Kandydata`, `ID Opiekuna`) VALUES (?, ?)");
    $stmt->bind_param("ii", $idKandydata, $idOjca);
    $stmt->execute();
    $stmt->close();
}
if(isset($idOpiekuna)) {
    
    $stmt = $link->prepare("INSERT INTO `opieka`(`ID Kandydata`, `ID Opiekuna`) VALUES (?, ?)");
    $stmt->bind_param("ii", $idKandydata, $idOpiekuna);
    $stmt->execute();
    $stmt->close();
}
//punkty

//wyroznienia
$punktyOsiagniecia = 0;
$punktySwiadectwo = 0;
foreach($osiagniecia as $key => $value) {
    if(str_contains($key, '1') || str_contains($key, '2'))
    $punktySwiadectwo += $value;
    else
    $punktyOsiagniecia += $value;
}
if($punktyOsiagniecia > 18) $punktyOsiagniecia = 18;
$punktyOsiagniecia += $punktySwiadectwo;


$punktyEgzamin = 0;

$punktyEgzamin = ($egzPol * 0.35) + ($egzMat * 0.35) + ($egzAng * 0.30);

if(isset($informatyka))
$punktyInformatyka = GetPointValue($polski) + GetPointValue($matematyka) + GetPointValue($obcy) +GetPointValue($informatyka) + $punktyEgzamin;
else $punktyInformatyka = NULL;
if(isset($geografia))
$punktyGeografia = GetPointValue($polski) + GetPointValue($matematyka) + GetPointValue($obcy) +GetPointValue($geografia) + $punktyEgzamin;
else $punktyGeografia = NULL;

function GetPointValue($ocena){
    switch($ocena) {
        case 0:
            return null;
            break;
        case 1:
            return null;
            break;
        case 2:
            return 2;
            break;
        case 3:
            return 8;
            break;
        case 4:
            return 14;
            break;
        case 5:
            return 17;
            break;
        case 6:
            return 18;
            break;
        default:
            return null;
    }
}

//wniosek

$stmt = $link->prepare("INSERT INTO `wniosek`(`Kierunek1`, `Kierunek2`, `Kierunek3`, `Szkola`, `ID Kandydat`,
                    `Punkty informatyka`, `Punkty geografia`) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssiii", $data['kierunek1'], $data['kierunek2'], $data['kierunek3'], $data['szkola'], $idKandydata, $punktyInformatyka, $punktyGeografia);
$stmt->execute();

$stmt->close();
$link->close();
header("Location: https://pzsklanino.edu.pl/");
 ?>