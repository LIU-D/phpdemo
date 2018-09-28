<?php

header('content-type:text/html;charset=utf-8');
require './MySQLDB.class.php';

$params = array(
	'user' => 'root',
	'pwd' => '741258o'
);

$mysql = MySQLDB::getInstance($params);

$mysql2 = MySQLDB::getInstance($params);


echo '<pre>';

var_dump($mysql,$mysql2);