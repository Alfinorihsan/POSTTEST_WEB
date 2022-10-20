<?php
session_start();
include('./functions.php');

$result = delete("pesanan", $_GET['id']);

header("location:index.php");