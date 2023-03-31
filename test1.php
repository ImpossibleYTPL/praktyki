<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./Assets/dist/css/bootstrap.css">
    <title>Document</title>
    
</head>
<body>
  <form action="" method="GET">
    <div class="form-floating m-5">
        <select onchange="this.form.submit();" name="kierunek" id="kierunek" class="form-select">
          <option value=""></option>
          <optgroup label="Liceum">
          <option>Liceum o profilu mundurowym</option>
          <option>Liceum o profilu dietetyka i aktywność fizyczna</option>
          </optgroup>
          <optgroup label="Technikum">
          <option>TECHNIK GRAFIKI I POLIGRAFII CYFROWEJ</option>
          <option>TECHNIK ORGANIZACJI TURYSTYKI</option>
          <option>TECHNIK ŻYWIENIA I USŁUG GASTRONOMICZNYCH</option>
          <option>TECHNIK HOTELARSTWA</option>
          <option>TECHNIK INFORMATYK</option>
        </optgroup>
        <optgroup label="Szkoła branżowa I stopnia">
          <option>Pracownik obsługi hotelowej</option>
          <option>Mechanik - monter maszyn i urządzeń Monter kadłubów jednostek pływających</option>
          <option>Kucharz</option>
        </optgroup>
        </select>
        <label for="kierunek" class="form-label">Kierunek</label>
      </div>

  </form>
      <?php
        require_once "DataBase.php";
        // require_once './vendor/autoload.php';
        // use PhpOffice\PhpSpreadsheet\Spreadsheet;
        // use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


        $link = new mysqli($servername, $username, $password, $dbname);

        if(!isset($_GET['kierunek'])) die();
        if($_GET['kierunek'] == "TECHNIK GRAFIKI I POLIGRAFII CYFROWEJ" || $_GET['kierunek'] == "TECHNIK INFORMATYK") {
          $stmt = $link->prepare("SELECT kandydat.`Imie`, kandydat.`Nazwisko`, oceny.`Egzamin polski`, oceny.`Egzamin matematyka`, oceny.`Egzamin jezyk obcy`, oceny.`Polski`, oceny.`Matematyka`, oceny.`Jezyk obcy`, oceny.`Geografia`, oceny.`Informatyka`, oceny.`Zachowanie`, wniosek.Kierunek1, wniosek.Kierunek2, wniosek.Kierunek3, wniosek.`Punkty informatyka`, 
          wniosek.`Punkty geografia`, osiagniecia.wyroznienie1 AS 'Pasek', osiagniecia.wyroznienie2 AS 'Wolontariat', osiagniecia.wyroznienie3 + osiagniecia.wyroznienie4 +
          osiagniecia.wyroznienie5 + osiagniecia.wyroznienie6 + osiagniecia.wyroznienie7 + osiagniecia.wyroznienie8 + osiagniecia.wyroznienie9 + osiagniecia.wyroznienie10 +
          osiagniecia.wyroznienie11 + osiagniecia.wyroznienie12 + osiagniecia.wyroznienie13 + osiagniecia.wyroznienie14 + osiagniecia.wyroznienie15 + osiagniecia.wyroznienie16 +
          osiagniecia.wyroznienie17 + osiagniecia.wyroznienie18 + osiagniecia.wyroznienie19 + osiagniecia.wyroznienie20 + osiagniecia.wyroznienie21 + osiagniecia.wyroznienie22 AS
          'Punkty osiagniecia'
          FROM `kandydat`
          INNER JOIN wniosek ON kandydat.ID = wniosek.`ID Kandydat`
          INNER JOIN oceny ON kandydat.`ID Oceny` = oceny.ID
          INNER JOIN osiagniecia ON `kandydat`.`ID Osiagniecia` = osiagniecia.ID
          WHERE wniosek.Kierunek1 = ? OR wniosek.Kierunek2 = ? OR wniosek.Kierunek3 = ?;");
          $stmt->bind_param("sss", $_GET['kierunek'], $_GET['kierunek'], $_GET['kierunek']);
          $stmt->execute();
          $result = $stmt->get_result();
          $rows = $result->fetch_all(MYSQLI_ASSOC);
          echo "<div class='h2 mb-4 ms-3'>".$_GET['kierunek']."</div>";
          echo "<table class='table table-striped table-sm'><tr><th>Imie</th><th>Nazwisko</th><th>Egzamin polski</th><th>Egzamin matematyka</th><th>Egzamin Język obcy</th><th>Polski</th><th>Matematyka</th><th>Język obcy</th><th>Informatyka</th><th>Zachowanie</th><th>Pasek</th><th>Wolontariat</th><th>Osiagniecia</th><th>Punkty</th></tr>";
          if($stmt->errno) die($stmt->errno);
          foreach($rows as $row) {
            echo "<tr>";
            echo "<td>".$row['Imie']."</td>";
            echo "<td>".$row['Nazwisko']."</td>";
            echo "<td>".$row['Egzamin polski']."</td>";
            echo "<td>".$row['Egzamin matematyka']."</td>";
            echo "<td>".$row['Egzamin jezyk obcy']."</td>";
            echo "<td>".$row['Polski']."</td>";
            echo "<td>".$row['Matematyka']."</td>";
            echo "<td>".$row['Jezyk obcy']."</td>";
            echo "<td>".$row['Informatyka']."</td>";
            echo "<td>".$row['Zachowanie']."</td>";
            echo "<td>".$row['Pasek']."</td>";
            echo "<td>".$row['Wolontariat']."</td>";
            echo "<td>".$row['Punkty osiagniecia']."</td>";
            echo "<td>".$row['Punkty informatyka']."</td>";
            echo "</tr>";
          }
          echo "</table>";
          $stmt->close();
        } else {
          $stmt = $link->prepare("SELECT kandydat.`Imie`, kandydat.`Nazwisko`, oceny.`Egzamin polski`, oceny.`Egzamin matematyka`, oceny.`Egzamin jezyk obcy`, oceny.`Polski`, oceny.`Matematyka`, oceny.`Jezyk obcy`, oceny.`Geografia`, oceny.`Informatyka`, oceny.`Zachowanie`, wniosek.Kierunek1, wniosek.Kierunek2, wniosek.Kierunek3, wniosek.`Punkty informatyka`, 
          wniosek.`Punkty geografia`, osiagniecia.wyroznienie1 AS 'Pasek', osiagniecia.wyroznienie2 AS 'Wolontariat', COALESCE(osiagniecia.wyroznienie3, 0) + COALESCE(osiagniecia.wyroznienie4, 0) + COALESCE(osiagniecia.wyroznienie5, 0) + COALESCE(osiagniecia.wyroznienie6, 0) + COALESCE(osiagniecia.wyroznienie7, 0) + COALESCE(osiagniecia.wyroznienie8, 0)
          + COALESCE(osiagniecia.wyroznienie9, 0) + COALESCE(osiagniecia.wyroznienie10, 0) + COALESCE(osiagniecia.wyroznienie11, 0) + COALESCE(osiagniecia.wyroznienie12, 0) + COALESCE(osiagniecia.wyroznienie13, 0) + COALESCE(osiagniecia.wyroznienie14, 0) + COALESCE(osiagniecia.wyroznienie15, 0) + COALESCE(osiagniecia.wyroznienie16, 0) + COALESCE(osiagniecia.wyroznienie17, 0)
          + COALESCE(osiagniecia.wyroznienie18, 0) + COALESCE(osiagniecia.wyroznienie19, 0) + COALESCE(osiagniecia.wyroznienie20, 0) + COALESCE(osiagniecia.wyroznienie21, 0) + COALESCE(osiagniecia.wyroznienie22, 0) AS
          'Punkty osiagniecia'
          FROM `kandydat`
          INNER JOIN wniosek ON kandydat.ID = wniosek.`ID Kandydat`
          INNER JOIN oceny ON kandydat.`ID Oceny` = oceny.ID
          INNER JOIN osiagniecia ON `kandydat`.`ID Osiagniecia` = osiagniecia.ID
          WHERE wniosek.Kierunek1 = ? OR wniosek.Kierunek2 = ? OR wniosek.Kierunek3 = ?;");
          $stmt->bind_param("sss", $_GET['kierunek'], $_GET['kierunek'], $_GET['kierunek']);
          $stmt->execute();
          $result = $stmt->get_result();
          $rows = $result->fetch_all(MYSQLI_ASSOC);
          echo "<div class='h2 mb-4 ms-3'>".$_GET['kierunek']."</div>";
          echo "<table class='table table-striped table-sm'><tr><th>Imie</th><th>Nazwisko</th><th>Egzamin polski</th><th>Egzamin matematyka</th><th>Egzamin Język obcy</th><th>Polski</th><th>Matematyka</th><th>Język obcy</th><th>Geografia</th><th>Zachowanie</th><th>Pasek</th><th>Wolontariat</th><th>Osiagniecia</th><th>Punkty</th></tr>";
          if($stmt->errno) die($stmt->errno);
          foreach($rows as $row) {
            if($row['Punkty osiagniecia'] > 18) $row['Punkty osiagniecia'] = 18;
            echo "<tr>";
            echo "<td>".$row['Imie']."</td>";
            echo "<td>".$row['Nazwisko']."</td>";
            echo "<td>".$row['Egzamin polski']."</td>";
            echo "<td>".$row['Egzamin matematyka']."</td>";
            echo "<td>".$row['Egzamin jezyk obcy']."</td>";
            echo "<td>".$row['Polski']."</td>";
            echo "<td>".$row['Matematyka']."</td>";
            echo "<td>".$row['Jezyk obcy']."</td>";
            echo "<td>".$row['Geografia']."</td>";
            echo "<td>".$row['Zachowanie']."</td>";
            echo "<td>".$row['Pasek']."</td>";
            echo "<td>".$row['Wolontariat']."</td>";
            echo "<td>".$row['Punkty osiagniecia']."</td>";
            echo "<td>".$row['Punkty geografia']."</td>";
            echo "</tr>";
          }
          echo "</table>";
          $stmt->close();
        }

// // Tworzenie nowego pliku Excel
// $spreadsheet = new Spreadsheet();
// $sheet = $spreadsheet->getActiveSheet();

// // Wstawienie nagłówków kolumn
// $sheet->setCellValue('A1', 'ID');
// $sheet->setCellValue('B1', 'Imię');
// $sheet->setCellValue('C1', 'Nazwisko');
// $sheet->setCellValue('D1', 'E-mail');

// // Wstawienie danych użytkowników
// $i = 2;
// foreach ($rows as $row) {
//     $sheet->setCellValue('A' . $i, $row['Imie']);
//     $sheet->setCellValue('B' . $i, $row['Nazwisko']);
//     $sheet->setCellValue('C' . $i, $row['Egzamin polski']);
//     $sheet->setCellValue('D' . $i, $row['Egzamin matematyka']);
//     $i++;
// }

// // Ustawienie nagłówka Content-Disposition, aby przeglądarka nie otwierała pliku Excel, ale zapytała użytkownika o pobranie go
// header('Content-Disposition: attachment; filename="kandydaci.xlsx"');
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
// header('Cache-Control: max-age=0');

// // Zapisanie pliku Excel
// $writer = new Xlsx($spreadsheet);
// $writer->save('php://output');
  ?>
</body>
</html>