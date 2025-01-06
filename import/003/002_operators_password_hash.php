<?php

$pdo = new PDO('mysql:host=localhost;dbname=cinergie', '', '');
// select all username, passwords from the table
// use PDO to fetch the data
$stmt = $pdo->query("SELECT username FROM kadro_operator");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
// loop through the data
foreach ($rows as $row) {
    // get the username
    echo "Processing user: " . $row['username'] . PHP_EOL;

    $username = $row['username'];
    // create a new password
    $password = password_hash($username, PASSWORD_DEFAULT);
    // update the password in the database, disable the users as the password is not yet changed
    $update = "UPDATE kadro_operator SET active=0, password = :password WHERE username = :username";
    $stmt = $pdo->prepare($update);
    $stmt->execute(['password' => $password, 'username' => $username]);
}
