<?php
session_start();
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullanici_adi = trim($_POST['kullanici_adi'] ?? '');
    $sifre = $_POST['sifre'] ?? '';

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE kullanici_adi = ?");
    $stmt->execute([$kullanici_adi]);
    $user = $stmt->fetch();

    if ($user && password_verify($sifre, $user['sifre'])) {
        session_regenerate_id(true); // Session fixation koruması
        $_SESSION['admin_id'] = $user['id'];
        $_SESSION['admin_name'] = $user['ad_soyad'];
        header("Location: admin-panel.php");
        exit;
    } else {
        // Hata durumunda Bootstrap ekranı basıyoruz
        echo "<!DOCTYPE html><html lang='tr'><head><meta charset='UTF-8'><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'></head><body class='bg-light d-flex justify-content-center align-items-center vh-100'><div class='text-center'><div class='alert alert-danger shadow-sm mb-3'>Kullanıcı adı veya şifre hatalı!</div><a href='giris.php' class='btn btn-dark'>Tekrar Dene</a></div></body></html>";
    }
} else {
    header("Location: giris.php");
    exit;
}