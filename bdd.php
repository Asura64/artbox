<?php

function connexion(): PDO
{
    $hostname = getConfig('hostname', 'database');
    $port = getConfig('port', 'database');
    $username = getConfig('username', 'database');
    $password = getConfig('password', 'database');
    $database = getConfig('database', 'database');
    return new PDO("mysql:host={$hostname}:{$port};dbname={$database}", $username, $password);
}
