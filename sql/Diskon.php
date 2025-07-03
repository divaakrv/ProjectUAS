<?php
// File: models/Diskon.php

require_once __DIR__ . '/../config/koneksi.php';

function getAllDiskon()
{
    global $conn;
    $sql = "SELECT * FROM diskon";
    $result = mysqli_query($conn, $sql);

    $diskon = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $diskon[] = $row;
    }

    return $diskon;
}

function getDiskonById($id)
{
    global $conn;
    $sql = "SELECT * FROM diskon WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    return mysqli_fetch_assoc($result);
}
