<?php
session_start();
require "../models/requeteTests.php";

$tests = implode(" ", $_POST["tests"]);
