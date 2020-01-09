
<?php
//start de sesions
session_start();
// verwijder alle sessions
session_destroy();
//stuur de gebruiker naar de inlogpagina
header("location:index.php");
?><?php
