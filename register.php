<?php
require 'db.php';

// Hata mesajlarını Bootstrap ile göstermek için ufak bir fonksiyon
function showError($msg, $link) {
    $msg = htmlspecialchars($msg, ENT_QUOTES, 'UTF-8');
    die("<!DOCTYPE html><html lang='tr'><head><meta charset='UTF-8'><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'></head><body class='bg-light d-flex justify-content-center align-items-center vh-100'><div class='text-center'><div class='alert alert-danger shadow-sm mb-3'>$msg</div><a href='$link' class='btn btn-dark'>Geri Dön</a></div></body></html>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ad_soyad = trim($_POST['ad_soyad'] ?? '');
    $kullanici_adi = trim($_POST['kullanici_adi'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $sifre = $_POST['sifre'] ?? '';
    $sifre_tekrar = $_POST['sifre_tekrar'] ?? '';
    $admin_kodu = $_POST['admin_kodu'] ?? '';

    if ($ad_soyad === '' || $kullanici_adi === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        showError("Lütfen tüm alanları doğru doldurun.", "yonetici-kayit.php");
    }

    if (strlen($sifre) < 8) {
        showError("Şifre en az 8 karakter olmalıdır.", "yonetici-kayit.php");
    }

    if ($sifre !== $sifre_tekrar) {
        showError("Şifreler uyuşmuyor!", "yonetici-kayit.php");
    }

    if (!hash_equals((string)$config['admin_code'], (string)$admin_kodu)) {
        showError("Yönetici doğrulama kodu hatalı!", "yonetici-kayit.php");
    }

    $hashed_password = password_hash($sifre, PASSWORD_DEFAULT);

    try {
        $stmt = $pdo->prepare("INSERT INTO admins (ad_soyad, kullanici_adi, email, sifre) VALUES (?, ?, ?, ?)");
        $stmt->execute([$ad_soyad, $kullanici_adi, $email, $hashed_password]);

        // Başarılı kayıt ekranı
        echo "<!DOCTYPE html><html lang='tr'><head><meta charset='UTF-8'><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'></head><body class='bg-light d-flex justify-content-center align-items-center vh-100'><div class='text-center'><div class='alert alert-success shadow-sm mb-3'>Kayıt başarılı!</div><a href='giris.php' class='btn btn-success px-4'>Giriş Yap</a></div></body></html>";
    } catch (PDOException $e) {
        error_log('Yönetici kayıt hatası: ' . $e->getMessage());
        showError("Kayıt yapılamadı. Kullanıcı adı zaten kullanılıyor olabilir.", "yonetici-kayit.php");
    }
} else {
    header("Location: yonetici-kayit.php");
    exit;
}