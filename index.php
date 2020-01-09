<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="opmaak.css">
</head>
<body class="index">

<nav class="fixed-top navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="d-flex flex-grow-1">
        <span class="w-100 d-lg-none d-block"></span>
        <a class="navbar-logo" href="#">DINGES</a>
        <div class="w-100 text-right">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#myNavbar7">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
    <div class="collapse navbar-collapse flex-grow-1" id="myNavbar7">
        <ul class="navbar-nav ml-auto flex-nowrap">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="over.html">Over ons</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact</a>
            </li>
        </ul>
    </div>
</nav>

<div class="jumbotron text-center ">
    <img class="hambur" src="images/hamburger.jpg" alt="hamburger">
    <h1 class="centered">Cafetaria-Lunchroom Dinges</h1>
    <p class="centered1">Familie/vrienden samen eten? gemakkelijk bij ons te reserveren!</p>
</div>

<div class="container">
    <div class="row inleiding">
        <div class="col-sm-4">
            <h4>Reserveren</h4>
            <p>Een tafel reserveren kan nu online!. Hieronder zie u een reserveringsformulier.
                Wil je gezellig met je vrienden en je families uiteten bij ons en wil je niet wachten op lange rijen?
                Dat kan nu! Vul het reserveringsformulier in en binnen enkele dagen krijgt u een bevestigingsmail terug.
                <br>LET OP:  reserveren op minimaal 4 personen tot maximaal 8 personen.
            </p>
            <a href="#res"> <button type="button" class="btn btn-dark">Nu reserveren</button></a>
        </div>
        <div class="col-sm-4">
            <h4>Over ons</h4>
            <p>Zoek u een restaurant om uit te gaan eten met je familie en je vrienden maar u weet nog niet zeker of dit bij u past?
                Bekijk onze over ons pagina voor meer informatie over het restaurant. Pas dit bij u! reserveer snel hieronder want vol = vol.
            </p>
            <a href="over.html"><button type="button" class="btn btn-dark">Over ons pagina</button></a>
        </div>
        <div class="col-sm-4">
            <h4>Contact</h4>
            <p id="res">Heb je nog vragen? Weet je niet hoe je moet reserveren? Maak snel contact met ons op! Binnen 2 werkdagen wordt uw vraag beantwoord.
                Ga naar het contact pagina voor meer contactgegevens over het restaurant, voor openingstijden en locatie kom je hier!
            </p>
            <a href="contact.html"><button type="button" class="btn btn-dark">Contactpagina</button></a>
        </div>
    </div>
</div>

<div class="container reserveren">
    <h2 >Tafel reserveren</h2>
    <p>*Geen eror na het verzenden? dan is uw reservering binnen. U wordt binnenkort gebeld of gemaild voor wijzigingen.</p>
    <div class="row formulier">
        <div class="col-lg-6 col-sm-12">
            <?php
            //Check if Post isset, else do nothing
            if (isset($_POST['submit'])) {
                //Require database in this file & image helpers
                require_once "includes/database.php";

                //Postback with the data showed to the user, first retrieve data from 'Super global'
                //    $artist = mysqli_real_escape_string($db, $_POST['artist']);
                $voornaam   = mysqli_escape_string($db, htmlentities($_POST['voornaam']));
                $achternaam = mysqli_escape_string($db,htmlentities( $_POST['achternaam']));
                $email  = mysqli_escape_string($db, htmlentities($_POST['email']));
                $telefoonnummer  = mysqli_escape_string($db, htmlentities($_POST['telefoonnummer']));
                $personen = mysqli_escape_string($db, htmlentities($_POST['personen']));
                $datum = mysqli_escape_string($db,htmlentities($_POST['datum']));
                $tijd = mysqli_escape_string($db, htmlentities($_POST['tijd']));

                //Require the form validation handling
                require_once "includes/form-validation.php";

                if (empty($errors)) {

                    //Save the record to the database
                    $query = "INSERT INTO tafelreserveren (voornaam, achternaam, email, telefoonnummer, personen, datum, tijd)
                      VALUES ('$voornaam', '$achternaam', '$email', '$telefoonnummer', '$personen', '$datum', '$tijd')";
                    $result = mysqli_query($db, $query)
                    or die('Error: '.$query);

                    if ($result) {
                        header('Location: index.php');
                        echo '<div class="wrong">wrong</div>';
                        exit;
                    } else {
                        $errors[] = 'Something went wrong in your database query: ' . mysqli_error($db);
                    }

                    //Close connection
                    mysqli_close($db);
                }
            }
            ?>
            <!-- enctype="multipart/form-data" no characters will be converted -->
            <form class="tafelres" action="" method="post" enctype="multipart/form-data">
                <div class="data-field">
                    <label for="voornaam">Voornaam:</label>
                    <input id="voornaam" type="text" name="voornaam" value="<?= isset($voornaam) ? $voornaam : '' ?>"/>
                    <span class="errors"><?= isset($errors['voornaam']) ? $errors['voornaam'] : '' ?></span>
                </div>
                <div class="data-field">
                    <label for="achternaam">Achternaam:</label>
                    <input id="achternaam" type="text" name="achternaam" value="<?= isset($achternaam) ? $achternaam : '' ?>"/>
                    <span class="errors"><?= isset($errors['achternaam']) ? $errors['achternaam'] : '' ?></span>
                </div>
                <div class="data-field">
                    <label for="email">Email:</label>
                    <input id="email" type="email" name="email" value="<?= isset($email) ? $email : '' ?>"/>
                    <span class="errors"><?= isset($errors['email']) ? $errors['email'] : '' ?></span>
                </div>
                <div class="data-field">
                    <label for="telefoonnummer">Telefoonnummer:</label>
                    <input id="telefoonnummer" type="tel" name="telefoonnummer" value="<?= isset($telefoonnummer) ? $telefoonnummer : '' ?>"/>
                    <span class="errors"><?= isset($errors['telefoonnummer']) ? $errors['telefoonnummer'] : '' ?></span>
                </div>
                <div class="data-field">
                    <label for="personen">Personen:</label>
                    <input id="personen" type="number" name="personen" value="<?= isset($personen) ? $personen : '' ?>"/>
                    <span class="errors"><?= isset($errors['personen']) ? $errors['personen'] : '' ?></span>
                </div>
            </div>
            <div class="col-lg-6 col-sm-12">
                <div class="data-field">
                    <label for="datum">Datum:</label>
                    <input id="datum" type="date" name="datum" value="<?= isset($datum) ? $datum : '' ?>"/>
                    <span class="errors"><?= isset($errors['datum']) ? $errors['datum'] : '' ?></span>
                </div>
                <div class="data-field">
                    <label for="tijd">Tijd:</label>
                    <input id="tijd" type="time" name="tijd" value="<?= isset($tijd) ? $tijd : '' ?>"/>
                    <span class="errors"><?= isset($errors['tijd']) ? $errors['tijd'] : '' ?></span>
                </div>
            </div>
            <div class="data-submit">
                <input type="submit" name="submit" value="verzenden"/>
            </div>
        </form>
    </div>
</div>
<div class="container">
    <div class="row foto">
        <div class="col-sm-6">
           <img src="images/IMG_8213.jpg">
        </div>
        <div class="col-sm-6">
            <img src="images/IMG_8109.jpg">
        </div>
    </div>
</div>
<!--<img src="images/folder.jpg">-->
<div class="footer-main bg-dark py-5 small">
    <div class="footer container">
        <p>© Cafetaria-Lunchroom Dinges 2019</p>
        <a href="inlog.php">Admin</a>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

<script>
    $(document).ready(function () {
        if($(window).width() > 768) {
            $("#myNavbar7").addClass("text-right");
        }else{
            $("#myNavbar7").addClass("text-left");
        }
    });
</script>
</body>
</html>
