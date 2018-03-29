<?php
// https://github.com/paragonie/easydb
require_once('vendor/autoload.php');

$db = \ParagonIE\EasyDB\Factory::create('mysql:host=localhost;dbname=registration', 'root', '');