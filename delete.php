<?php
require_once 'session.php';
?>
<?php
//Require music data & image helpers to use variable in this file
require_once "includes/database.php";

if (isset($_POST['submit'])) {
    // DELETE IMAGE
    // To remove the image we need to query the file name from the db.
    // Get the record from the database result
    $query = "SELECT * FROM tafelreserveren WHERE id = " . mysqli_escape_string($db, $_POST['id']);
    $result = mysqli_query($db, $query) or die ('Error: ' . $query );

    $tafelreserveren = mysqli_fetch_assoc($result);


    // DELETE DATA
    // Remove the album data from the database
    $query = "DELETE FROM tafelreserveren WHERE id = " . mysqli_escape_string($db, $_POST['id']);

    mysqli_query($db, $query) or die ('Error: '.mysqli_error($db));

    //Close connection
    mysqli_close($db);

    //Redirect to homepage after deletion & exit script
    header("Location: admin.php");
    exit;

} else if(isset($_GET['id'])) {
    //Retrieve the GET parameter from the 'Super global'
    $albumId = $_GET['id'];

    //Get the record from the database result
    $query = "SELECT * FROM tafelreserveren WHERE id = " . mysqli_escape_string($db, $albumId);
    $result = mysqli_query($db, $query) or die ('Error: ' . $query );

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
    // Id was not present in the url OR the form was not submitted

    // redirect to db_connection.php
    header('Location: admin.php');
    exit;
}
?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Delete - <?= $tafelreserveren['voornaam'] ?></title>
    </head>
    <body>
    <h2>Delete - <?= $tafelreserveren['voornaam'] ?></h2>
    <form action="" method="post">
        <p>
            Weet u zeker dat u het reservering "<?= $tafelreserveren['voornaam']?>" wilt verwijderen?
        </p>
        <input type="hidden" name="id" value="<?= $tafelreserveren['id'] ?>"/>
        <input type="submit" name="submit" value="Verwijderen"/>
    </form><br>
    <div>
        <a href="admin.php">Terug naar de Admin pagina</a>
    </div>
    </body>
    </html>
<?php
