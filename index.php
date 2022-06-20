<?php

echo 'Here the index file';

try {
    $dbh = new PDO('mysql:host=db;port=3306;dbname=dienpq', 'root', 'root');
    $dbh->exec('CREATE TABLE users
    (
        id int PRIMARY KEY AUTO_INCREMENT,
        mail VARCHAR(255),
        name VARCHAR(255),
        password VARCHAR(255),
        phone VARCHAR(20),
        address VARCHAR(255),
        created_at date,
        updated_at date
    );');
    echo '<br>';
    echo 'Conection success';
} catch (PDOException $e) {
    echo 'Error!:';
    echo '</br>';
    echo $e;
    die();
}


