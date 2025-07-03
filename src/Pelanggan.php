<?php
// models/Pelanggan.php

function getAllPelanggan() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM pelanggan");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}