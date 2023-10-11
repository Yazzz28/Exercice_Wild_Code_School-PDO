<?php

require './connect.php';
$pdo = new \PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);
$freindsArray = $statement->fetchAll(PDO::FETCH_ASSOC);


$firstname = trim($_POST['firstname']);
$lastname = trim($_POST['lastname']);
$query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
$statement = $pdo->prepare($query);

$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);
$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);

$statement->execute();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste freinds</title>
</head>
<body>
    <?php foreach($freindsArray as $friend) {?>
        <ul>
            <li> <?php echo $friend['firstname'] . ' ' . $friend['lastname']; ?> </li>
        </ul>
        <?php }?>

        <form action=""method="post">
            <label for="firstname">firstname</label>
            <input type="text" id="firstname" name="firstname" require>
            <label for="lastname">lastname</label>
            <input type="text" name="lastname" id="lastname" require>
            <button type="submit">Envoyé</button>
        </form>
    </body>
    </html>