
<?php
require '_connec.php';

try
{
    $bdd = new PDO(DSN, USER, PASS);
    echo "tous vas bien";
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$pdo = new \PDO(DSN, USER, PASS);

$sql = "SELECT * FROM friend";
$statement = $pdo->query($sql);
$friends = $statement->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $sql = "INSERT INTO friend (firstname, lastname) VALUES ('$firstname', '$lastname')";
    $statement = $pdo->exec($sql);
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form method="post">
    <div>
        <label for="firstname">Enter your firstname: </label>
        <input type="text" name="firstname" id="firstname" required>
    </div>
    <div>
        <label for="lastname">Enter your lastname: </label>
        <input type="text" name="lastname" id="lastname" required>
    </div>
    <div>
        <input type="submit" value="Submit">
    </div>
</form>
<?php if (empty($friends)): ?>
<p>No data</p>
<?php  else: ?>
<?php foreach ($friends as $friend): ?>
<li><?= htmlspecialchars($friend['firstname']).' '.htmlspecialchars($friend['lastname']); ?></li>
<?php endforeach ?>
<?php endif;?>

</body>
</html>
