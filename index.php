<?php
error_reporting(E_ALL);

require_once("sendmail.php");
$sendmail = new Sendmail;
$sendmail->init();
