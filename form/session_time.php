<?php

session_start();
if (!isset($_SESSION['Email'])) {
    header('location: ../signin.php');
    exit();
}
$UserEmail = $_SESSION['Email'];
$PersonalDataId = $_SESSION['pd_id'];
$UserId = $_SESSION['user_id'];

if (isset($_SESSION['Email'])) {
  if ((time() - $_SESSION['last_login_time']) > 1000) {
    header('location: ../logout.php');
  } else {
    $_SESSION['last_login_time'] = time();
  }
} else {
  header('location: ../signin.php');
}
