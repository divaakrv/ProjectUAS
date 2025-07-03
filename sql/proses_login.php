<?php
require_once '../controllers/AuthController.php';

$email = $_POST['email'];
$password = $_POST['password'];

login($email, $password);
