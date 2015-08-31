<?php 

require_once 'vendor/autoload.php';

use \application\models\User;

$config = array();
$core = new \vlad\Core($config);

$core = new User();