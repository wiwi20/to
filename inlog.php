<?php
//als het formulier is verstuurd
if(isset($_POST['inlog']))
{
    //voeg de databaseconnectie toe
    require_once "includes/database1.php";

    //lees de gegevens uit
    $adminnummer = $_POST['adminnummer'];
    $wachtwoord	= md5($_POST['wachtwoord']);

    //maak de query
    $opdracht = "SELECT* FROM admin
	WHERE adminnummer ='$adminnummer'
	AND wachtwoord = '$wachtwoord'";

    //voer de query uit en vang het resultaat op
    $resultaat = mysqli_query($db,$opdracht);

    //controleer of het resultaat een rij(user) heeft opgeleverd
    if(mysqli_num_rows($resultaat) > 0)
    {	session_start();
        //haal de user uit het resultaat
        $user = mysqli_fetch_array($resultaat);
        // zet de gebruikersnaam en wachteoord in 2 verschillende sessions
        $_SESSION['adminnummer'] = $user['adminnummer'];
        $_SESSION['wachtwoord'] = $user['wachtwoord'];

        echo "<p class='container text-center'> $adminnummer , u ben ingelogt! Klik op de button om verder te gaan<br>";
        echo "<a href='admin.php'>Naar overzicht</a></p>";
    }

    else
    {
        echo "<p class='container text-center'>$adminnummer Er is iets fout gegaan bij het inloggen.<br>";
        echo "Uw naam en/of wachtwoord is onjuist.<br>";
        echo "<a href='inlog.php'>Opnieuw proberen</a></p>";
    }
}
else
{
    ?>
    <div class="container text-center">
        <div class="row content">
            <div class="col-sm-12 text-left">
                <h3>INLOG</h3>
                <p>Log in en bekijk de overzichtpagina van de reservering</p>
                <form method= "post" action="">
                    <table border="0">
                        <tr>
                            <td>Gebruikersnaam:</td>
                            <td><input type="text" name="adminnummer"/></td>
                        </tr>
                        <tr>
                            <td>Wachtwoord:</td>
                            <td><input type="password" name="wachtwoord"/></td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td><input type="submit" name="inlog" value="Inloggen"></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <?php
}
?>