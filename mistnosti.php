<?php
    include "db.php"; 

    $razeni = filter_input(INPUT_GET, 'razeni');

    switch($razeni){
        case "name_asc": $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.name ASC'); break;
        case "name_desc": $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.name DESC'); break;
        case "room_asc": $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.no ASC'); break;
        case "room_desc": $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.no DESC'); break;
        case "phone_asc": $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.phone ASC'); break;
        case "phone_desc": $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.phone DESC'); break;
        default: $stmt = $pdo->query('SELECT * FROM room r ORDER BY r.name ASC'); break;
    }
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Místnosti</title>
</head>
<body class="container">
    <a href="index.php">Zpět do databáze</a>
    <h1>Místnosti</h1>
    <?php
        echo "<table class='table'><thead><tr>
        <td>Název<a href='mistnosti.php?razeni=name_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a><a href='mistnosti.php?razeni=name_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></td>
        <td>Číslo<a href='mistnosti.php?razeni=room_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='mistnosti.php?razeni=room_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></td>
        <td>Telefon<a href='mistnosti.php?razeni=phone_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='mistnosti.php?razeni=phone_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></td>
        </tr></thead><tbody>";
        
        
        
        while ($row = $stmt->fetch())  {
            echo "<tr><td><a href='mistnost.php?mistnostId=" .$row['room_id'] ."'>". $row['name'] ."</a></td><td>". $row['no'] ."</td><td>" . $row['phone'] . "</td></tr>";
          }

        unset($stmt);
    ?>
</body>
</html>