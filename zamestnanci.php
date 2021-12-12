<?php
    include "db.php"; 
?>
<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Zaměstnanci</title>
</head>
<body class="container">
    <a href="index.php">Zpět do databáze</a>
    <h1>zamestnanci</h1>
    <?php
        $razeni = filter_input(INPUT_GET, 'razeni');       

        echo "<table class='table'><thead><tr>
        <td>Jméno<a href='zamestnanci.php?razeni=name_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a><a href='zamestnanci.php?razeni=name_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></td>
        <td>Místnost<a href='zamestnanci.php?razeni=room_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='zamestnanci.php?razeni=room_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></td>
        <td>Telefon<a href='zamestnanci.php?razeni=phone_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='zamestnanci.php?razeni=phone_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></td>
        <td>Pozice<a href='zamestnanci.php?razeni=job_asc'><span class='glyphicon glyphicon-arrow-down' aria-hidden='true'></span></a> <a href='zamestnanci.php?razeni=job_desc'><span class='glyphicon glyphicon-arrow-up' aria-hidden='true'></span></a></td>
        </tr></thead><tbody>";
                
        
        switch($razeni){
            case "name_asc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS room, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY e.surname ASC'); break;
            case "name_desc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS room, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY e.surname DESC'); break;
            case "room_asc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS room, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY r.name ASC'); break;
            case "room_desc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS room, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY r.name DESC'); break;
            case "phone_asc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS room, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY r.phone ASC'); break;
            case "phone_desc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS room, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY r.phone DESC'); break;
            case "job_asc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS room, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY e.job ASC'); break;
            case "job_desc": $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS room, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY e.job DESC'); break;
            default: $stmt = $pdo->query('SELECT e.employee_id, e.name AS ename, e.surname, e.job, e.wage, e.room, r.no, r.name AS room, r.phone FROM employee e INNER JOIN room r ON e.room=r.room_id ORDER BY e.surname ASC'); break;
        }
        while ($row = $stmt->fetch())  {
            echo "<tr><td><a href='zamestnanec.php?zamestnanecId=" .$row['employee_id'] ."'>" . $row['surname']. " " . $row['ename'] ."</a></td><td>". $row['room'] ."</td><td>" .$row['phone'] . "</td><td>" .$row['job']. "</td></tr>";
        }

        unset($stmt);
    ?>
</body>
</html>