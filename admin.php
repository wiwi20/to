<?php
require_once 'session.php';
?>
<?php
//Require DB settings with connection variable
require_once "includes/database.php";

//Get the result set from the database with a SQL query
$query = "SELECT * FROM tafelreserveren";
$result = mysqli_query($db, $query) or die ('Error: ' . $query );

//Loop through the result to create a custom array
$tafelreserveren = [];
while ($row = mysqli_fetch_assoc($result)) {
    $tafelreserveren[] = $row;
}

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="opmaak.css"/>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>id</th>
        <th>voornaam</th>
        <th>achternaam</th>
        <th>email</th>
        <th>telefoonnummer</th>
        <th colspan="3"></th>
    </tr>
    </thead>
    <tfoot>
    <tr>
        <td colspan="10">&copy; alle reservering</td>
    </tr>
    </tfoot>
    <tbody>
    <?php foreach ($tafelreserveren as $tafelreserveren) { ?>
        <tr>
            <td><?= $tafelreserveren['id'] ?></td>
            <td><?= $tafelreserveren['voornaam'] ?></td>
            <td><?= $tafelreserveren['achternaam'] ?></td>
            <td><?= $tafelreserveren['email'] ?></td>
            <td><?= $tafelreserveren['telefoonnummer'] ?></td>
            <td><a href="details.php?id=<?= $tafelreserveren['id'] ?>">Details</a></td>
            <td><a href="edit.php?id=<?= $tafelreserveren['id'] ?>">Edit</a></td>
            <td><a href="delete.php?id=<?= $tafelreserveren['id'] ?>">Delete</a></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<a href="logui.php"> Log uit </a>
</body>
</html>

