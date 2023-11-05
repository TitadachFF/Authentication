<?php
session_start();
require 'Auth.php';

$auth = new Auth();
$auth->logout();

header('Location: login.php');
