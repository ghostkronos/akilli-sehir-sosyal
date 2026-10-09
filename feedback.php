<?php
require 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $ad = isset($_POST['feedback_name']) ? trim($_POST['feedback_name']) : '';
    $mesaj = isset($_POST['feedback_message']) ? trim($_POST['feedback_message']) : '';

    if (empty($ad) || empty($mesaj)) {
        echo "<script>alert('Lütfen adınızı ve mesajınızı yazın!'); window.history.back();</script>";
        exit;
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO feedback (ad, mesaj) VALUES (?, ?)");
        $stmt->execute([mb_substr($ad, 0, 100), $mesaj]);

        // Yönlendirme adresi sadece aynı sitedeki sayfalardan biri olabilir (XSS / open redirect önlemi)
        $izinli_sayfalar = ['index.php', 'bildirim.php', 'yontem.php', 'iletisim.php', 'giris.php', 'yonetici-kayit.php', 'admin-panel.php'];
        $geldigi_sayfa = 'index.php';
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $hedef = basename(parse_url($_SERVER['HTTP_REFERER'], PHP_URL_PATH) ?? '');
            if (in_array($hedef, $izinli_sayfalar, true)) {
                $geldigi_sayfa = $hedef;
            }
        }

        echo "<script>
            alert('Mesajınız başarıyla iletildi! Teşekkür ederiz.');
            window.location.href = " . json_encode($geldigi_sayfa) . ";
        </script>";
        exit;

    } catch (PDOException $e) {
        error_log('Geri bildirim hatası: ' . $e->getMessage());
        http_response_code(500);
        die("<!DOCTYPE html><html lang='tr'><head><meta charset='UTF-8'><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'></head><body class='bg-light p-5 d-flex justify-content-center'><div class='container' style='max-width: 600px;'><div class='alert alert-danger text-center shadow-sm'><h2 class='alert-heading'>Bir Hata Oluştu!</h2><p class='mb-3 mt-3'>Mesajınız kaydedilemedi. Lütfen daha sonra tekrar deneyin.</p><a href='index.php' class='btn btn-dark'>Anasayfaya Dön</a></div></div></body></html>");
    }

} else {
    header("Location: index.php");
    exit;
}