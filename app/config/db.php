<?php
$username = 'root';
$password = 'password';
$db = new PDO( 'mysql:host=localhost;dbname=cruds;charset=utf8', $username, $password );
$db->exec("SET CHARACTER SET utf8"); 
?>