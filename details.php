<?php
require_once 'session.php';
?>
<?php
// redirect when uri does not contain a id
if(!isset($_GET['id'])) {
    // redirect to db_connection.php
    header('Location: admin.php');
    exit;
}

//Require database in this file
require_once "includes/database.php";

//Retrieve the GET parameter from the 'Super global'
$Id = $_GET['id'];

//Get the record from the database result
$query = "SELECT * FROM tafelreserveren WHERE id = " . mysqli_escape_string($db, $Id);
$result = mysqli_query($db, $query)
or die ('Error: ' . $query );

if(mysqli_num_rows($result) == 1)
{
    $tafelreserveren = mysqli_fetch_assoc($result);
}
else {
    // redirect when db returns no result
    header('Location: admin.php');
    exit;
}

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Details</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="opmaak.css"/>
</head>
<body>
<h1>Detail</h1>
    <h2><?= $tafelreserveren['voornaam'] . '  ' . $tafelreserveren['achternaam'] ?></h2>
<ul>
    <li>Email:  <?= $tafelreserveren['email'] ?></li>
    <li>Telefoonnummer:   <?= $tafelreserveren['telefoonnummer'] ?></li>
    <li>Personen: <?= $tafelreserveren['personen'] ?>
    <li>Datum:   <?= $tafelreserveren['datum'] ?></li>
    <li>Tijd: <?= $tafelreserveren['tijd'] ?></li>
</ul>
<div>
    <a href="admin.php">Terug naar de Admin pagina</a>
</div>
</body>
</html>
