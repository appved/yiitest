<?php
$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
$db['dsn'] = 'mysql:host=mysql;dbname=basename';
$db['username'] = 'root';
$db['password'] = '12341234';
$db['charset'] = 'utf8';

return $db;
