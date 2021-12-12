<?php
    include("db.php");
    include("functions.php");
    
    $zamestnanecId = filter_input(INPUT_GET,"zamestnanecId");
    $stmt = $pdo->prepare("SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, r.name AS rname, r.room_id FROM employee e INNER JOIN room r ON e.room=r.room_id WHERE e.employee_id=?");
    $stmt->execute([$zamestnanecId]);
    $title = "";
    if(ErrorCheck($stmt, $zamestnanecId))
    {
        $validni = true;
        $zamestnanec = $stmt->fetch();
        $title = $zamestnanec["surname"];
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
    <a href="zamestnanci.php">Zpět do seznamu zaměstnanců</a>
    <?php
        if($validni)
        {
            echo "<h1>Karta zaměstnance: ". $zamestnanec["surname"]. "</h1>";
            echo "<table>";
            echo "<tr><th>Jméno: </th><td>". $zamestnanec["ename"]. "</td></tr>";
            echo "<tr><th>Příjmení: </th><td>". $zamestnanec["surname"]. "</td></tr>";
            echo "<tr><th>Pozice: </th><td>". $zamestnanec["job"]. "</td></tr>";
            echo "<tr><th>Mzda: </th><td>". $zamestnanec["wage"]. "-Kč</td></tr>";
            echo "<tr><th>Místnost: </th><td><a href='mistnost.php?mistnostId={$zamestnanec['room_id']}'>". $zamestnanec['rname']. "</a></td></tr>";

            $keys = $pdo->prepare("SELECT r.name AS name, r.room_id AS room_id FROM `key` k INNER JOIN room r ON k.room=r.room_id WHERE employee=?");
            $keys->execute([$zamestnanecId]);
            $i = 0;
            while ($row = $keys->fetch()) {
                if($i == 0)
                {
                    echo "<tr><th>Klíče: </th><td><a href='mistnost.php?mistnostId={$row['room_id']}'>". $row['name']. "</a><td>";
                }
                else
                {
                    echo "<tr><th></th><td><a href='mistnost.php?mistnostId={$row['room_id']}'>". $row['name']. "</a><td>";
                }
              $i++;
            }

            echo "</table>";
        }
    ?>
</body>
</html>