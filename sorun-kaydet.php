<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $adsoyad = trim($_POST['adsoyad'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $sorun_turu = trim($_POST['sorun_turu'] ?? '');
    $enlem = $_POST['enlem'] ?? '';
    $boylam = $_POST['boylam'] ?? '';
    $aciklama = trim($_POST['aciklama'] ?? '');

    if ($adsoyad === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $sorun_turu === '' || $aciklama === ''
        || !is_numeric($enlem) || !is_numeric($boylam)) {
        http_response_code(400);
        die("<!DOCTYPE html><html lang='tr'><head><meta charset='UTF-8'><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'></head><body class='bg-light p-5 d-flex justify-content-center'><div class='container' style='max-width: 500px;'><div class='alert alert-danger text-center shadow-sm'><h4 class='alert-heading'>Geçersiz Bilgi</h4><p class='mb-3'>Lütfen tüm alanları doğru doldurun.</p><a href='bildirim.php' class='btn btn-dark'>Geri Dön</a></div></div></body></html>");
    }

    $foto_yolu = "";

    // Fotoğraf yükleme (yalnızca resim, en fazla 5 MB)
    if (isset($_FILES['dosya']) && $_FILES['dosya']['error'] == UPLOAD_ERR_OK) {
        $izinli = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/gif' => 'gif', 'image/webp' => 'webp'];
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($_FILES['dosya']['tmp_name']);

        if (isset($izinli[$mime]) && $_FILES['dosya']['size'] <= 5 * 1024 * 1024) {
            if (!file_exists('uploads')) { mkdir('uploads', 0755, true); }
            // Kullanıcının verdiği dosya adı kullanılmaz; rastgele ad üretilir
            $target_file = 'uploads/' . bin2hex(random_bytes(8)) . '.' . $izinli[$mime];
            if (move_uploaded_file($_FILES['dosya']['tmp_name'], $target_file)) {
                $foto_yolu = $target_file;
            }
        }
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO issues (ad_soyad, email, sorun_turu, lat, lng, aciklama, foto_yolu) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$adsoyad, $email, $sorun_turu, $enlem, $boylam, $aciklama, $foto_yolu]);

        $yeni_id = $pdo->lastInsertId();

        header("Location: bildirim.php?status=success&id=" . urlencode($yeni_id));
        exit;

    } catch (PDOException $e) {
        error_log('Sorun kaydı hatası: ' . $e->getMessage());
        http_response_code(500);
        die("<!DOCTYPE html><html lang='tr'><head><meta charset='UTF-8'><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'></head><body class='bg-light p-5 d-flex justify-content-center'><div class='container' style='max-width: 500px;'><div class='alert alert-danger text-center shadow-sm'><h4 class='alert-heading'>Kayıt Hatası</h4><p class='mb-3'>Bildiriminiz kaydedilemedi. Lütfen daha sonra tekrar deneyin.</p><a href='bildirim.php' class='btn btn-dark'>Geri Dön</a></div></div></body></html>");
    }
} else {
    header("Location: bildirim.php");
    exit;
}