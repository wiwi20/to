<?php
require_once 'session.php';
?>
<?php
//Require database in this file & image helpers
require_once "includes/database.php";

//Check if Post isset, else do nothing
if (isset($_POST['submit'])) {
    //Postback with the data showed to the user, first retrieve data from 'Super global'
    $Id    = mysqli_escape_string($db, htmlentities($_POST['id']));
    $voornaam    = mysqli_escape_string($db, htmlentities($_POST['voornaam']));
    $achternaam    = mysqli_escape_string($db, htmlentities($_POST['achternaam']));
    $email    = mysqli_escape_string($db,htmlentities( $_POST['email']));
    $telefoonnummer    = mysqli_escape_string($db, htmlentities($_POST['telefoonnummer']));
    $personen   = mysqli_escape_string($db,htmlentities( $_POST['personen']));
    $datum     = mysqli_escape_string($db, htmlentities($_POST['datum']));
    $tijd     = mysqli_escape_string($db, htmlentities($_POST['tijd']));

    //Require the form validation handling
    require_once "includes/form-validation.php";

    //Save variables to array so the form won't break
    //This array is build the same way as the db result
    $tafelreserveren = [
        'voornaam'            => $voornaam,
        'achternaam'          => $achternaam,
        'email'               => $email,
        'telefoonnummer'      => $telefoonnummer,
        'personen'            => $personen,
        'datum'               => $datum,
        'tijd'                => $tijd,
    ];

    if (empty($errors)) {

        //Update the record in the database
        $query = "UPDATE tafelreserveren
                  SET voornaam = '$voornaam', achternaam = '$achternaam', email = '$email', telefoonnummer = '$telefoonnummer', personen = '$personen', datum = '$datum',tijd = '$tijd'
                  WHERE id = '$Id'";
        $result = mysqli_query($db, $query);

        if ($result) {
            header('Location: admin.php');
            exit;
        } else {
            $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
        }

    }
} else if(isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $Id = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM tafelreserveren WHERE id = " . mysqli_escape_string($db, $Id);
    $result = mysqli_query($db, $query);
    if(mysqli_num_rows($result) == 1)
    {
        $tafelreserveren = mysqli_fetch_assoc($result);
    }
    else {
        // redirect when db returns no result
        header('Location: admin.php');
        exit;
    }
} else {
    header('Location: admin.php');
    exit;
}

//Close connection
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <title>Music Collection Edit</title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" type="text/css" href="opmaak.css"/>
</head>
<body>
<h1>Edit</h1>
<h2><?= $tafelreserveren['voornaam'] . ' ' . $tafelreserveren['achternaam'] ?></h2>

<form action="" method="post" enctype="multipart/form-data">
    <div class="data-field">
        <label for="voornaam">Voornaam</label>
        <input id="voornaam" type="text" name="voornaam" value="<?= $tafelreserveren['voornaam'] ?>"/>
        <span class="errors"><?= isset($errors['voornaam']) ? $errors['voornaam'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="achternaam">Achternaam</label>
        <input id="achternaam" type="text" name="achternaam" value="<?= $tafelreserveren['achternaam'] ?>"/>
        <span class="errors"><?= isset($errors['achternaam']) ? $errors['achternaam'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="email">Email</label>
        <input id="email" type="email" name="email" value="<?= $tafelreserveren['email'] ?>"/>
        <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="telefoonnummer">Telefoonnummer</label>
        <input id="telefoonnummer" type="text" name="telefoonnummer" value="<?= $tafelreserveren['telefoonnummer'] ?>"/>
        <span class="errors"><?= isset($errors['telefoonnummer']) ? $errors['telefoonnummer'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="personen">Personen</label>
        <input id="personen" type="text" name="personen" value="<?= $tafelreserveren['personen'] ?>"/>
        <span class="errors"><?= isset($errors['personen']) ? $errors['personen'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="datum">Datum</label>
        <input id="datum" type="date" name="datum" value="<?= $tafelreserveren['datum'] ?>"/>
        <span class="errors"><?= isset($errors['datum']) ? $errors['datum'] : '' ?></span>
    </div>
    <div class="data-field">
        <label for="tijd">Tijd</label>
        <input id="tijd" type="time" name="tijd" value="<?= $tafelreserveren['tijd'] ?>"/>
        <span class="errors"><?= isset($errors['tijd']) ? $errors['tijd'] : '' ?></span>
    </div>
    <div class="data-submit ">
        <input type="hidden" name="id" value="<?= $Id ?>"/>
        <input type="submit" name="submit" value="Save"/>
    </div>
</form>
<div>
    <a href="admin.php">Terug naar de Admin pagina</a>
</div>
</body>
</html>
