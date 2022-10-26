<?php
session_start();
include('./functions.php');

$pesanan = find("pesanan", $_GET['id']);
$result = delete("pesanan", $_GET['id']);

unlink("./bukti-pembayaran/{$pesanan['bukti_pembayaran']}");

header("location:index.php");