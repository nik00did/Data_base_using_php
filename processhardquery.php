<?php

session_start();

$mysqli = new mysqli('localhost', 'root', '', 'travel_agency') or die(mysqli_error($mysqli));