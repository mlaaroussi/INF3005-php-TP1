<?php

session_start();
unset($_SESSION['user']);
unset($_SESSION['login']);
unset($_SESSION['email']);
session_destroy();
header("location:index.php");

