<?php
$mysqli = new mysqli("localhost", "root", "", "aah_prms");

if ($mysqli->connect_error) {
  die("Connection failed: " . $mysqli->connect_error);
}
