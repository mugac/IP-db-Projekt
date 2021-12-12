<?php
    include("db.php");
    include("functions.php");

    $mistnostId = filter_input(INPUT_GET,'mistnostId');
    $stmt = $pdo->prepare("SELECT no, name, phone FROM room r WHERE r.room_id=?");
    $stmt->execute([$mistnostId]);
    $title = "";
    if(ErrorCheck($stmt, $mistnostId))
    {
        $validni = true;
        $mistnost = $stmt->fetch();
        $title = $mistnost["name"];
    }
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title><?php echo $title; ?></title>
</head>
<body class = "container">
    <a href="index.php">Zpět do databáze</a></br>
    <a href="mistnosti.php">Zpět do seznamu místností</a>
    <?php
        if($validni)
        {
            echo "<h1>Karta místnosti: ". $mistnost["name"]. "</h1>";
            echo "<table>";
            echo "<tr><th>Číslo: </th><td>". $mistnost["no"]. "</td></tr>";
            echo "<tr><th>Název: </th><td>". $mistnost["name"]. "</td></tr>";
            echo "<tr><th>Telefon: </th><td>". $mistnost["phone"]. "</td></tr>";

            $zamestnanci = $pdo->prepare("SELECT employee_id, name, surname FROM employee WHERE room=?");
            $zamestnanci->execute([$mistnostId]);
            $i = 0;
            while ($row = $zamestnanci->fetch()) {
                if($i == 0)
                {
                    echo "<tr><th>Zaměstnanci: </th><td><a href='zamestnanec.php?zamestnanecId={$row['employee_id']}'>". $row['surname']. "</a></td></tr>";
                }
                else
                {
                    echo "<tr><th></th><td><a href='zamestnanec.php?zamestnanecId={$row['employee_id']}'>". $row['surname']. "</a></td></tr>";
                }
              $i++;
            }

            $prumwage = $pdo->prepare("SELECT ROUND(AVG(wage),0) AS wage FROM employee WHERE room=?");
            $prumwage->execute([$mistnostId]);
            $wage = $prumwage->fetch();
            echo "<tr><th>Průměrná mzda: </th><td>". $wage['wage']. "-Kč</td></tr>";

            $keys = $pdo->prepare("SELECT e.employee_id, e.name AS ename, e.surname FROM `key` k INNER JOIN employee e ON e.employee_id=k.employee WHERE k.room =?");
            $keys->execute([$mistnostId]);
            $j = 0;
            while ($row = $keys->fetch()) {
                if($j == 0)
                {
                    echo "<tr><th>Klíče: </th><td><a href='zamestnanec.php?zamestnanecId={$row['employee_id']}'>". $row['surname']. "</a><td>";
                }
                else
                {
                    echo "<tr><th></th><td><a href='zamestnanec.php?zamestnanecId={$row['employee_id']}'>". $row['surname']. "</a><td>";
                }
              $j++;
            }
            
            echo "</table>";
        }
    ?>
</body>
</html>