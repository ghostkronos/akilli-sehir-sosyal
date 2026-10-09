<?php
// 1. Olası boşluk ve uyarıların JSON yapısını bozmasını engellemek için tamponlamayı başlat
ob_start();
session_start();

// 2. API dosyalarında ekrana HTML/Metin hata mesajı basılmasını kapat (Saf veri için)
error_reporting(0);
ini_set('display_errors', 0);

require 'db.php';

// 3. db.php dahil edildikten sonra farkında olmadan ekrana basılan gizli boşlukları temizle
ob_end_clean();

// 4. İçeriğin saf JSON olduğunu tarayıcıya bildir
header('Content-Type: application/json; charset=utf-8');

$method = $_SERVER['REQUEST_METHOD'];

// Gizlilik: giriş yapmamış kullanıcılara vatandaşın e-posta ve adı gönderilmez
function publicIssue($row) {
    if (!$row || isset($_SESSION['admin_id'])) return $row;
    unset($row['email'], $row['ad_soyad']);
    return $row;
}

// GET İŞLEMLERİ (Listeleme)
if ($method == 'GET') {
    
    // A) Mesajları Getir
    if (isset($_GET['type']) && $_GET['type'] == 'feedback') {
        if (!isset($_SESSION['admin_id'])) {
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }
        $stmt = $pdo->query("SELECT * FROM feedback ORDER BY created_at DESC");
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        exit;
    }

    // B) Tek bir sorunu getir (Sorgulama ekranı)
    if (isset($_GET['id'])) {
        $stmt = $pdo->prepare("SELECT * FROM issues WHERE id = ?");
        $stmt->execute([$_GET['id']]);
        echo json_encode(publicIssue($stmt->fetch(PDO::FETCH_ASSOC)));
        exit;
    }

    // C) Harita ve panel için TÜM sorunları getir
    $stmt = $pdo->query("SELECT * FROM issues ORDER BY created_at DESC");
    echo json_encode(array_map('publicIssue', $stmt->fetchAll(PDO::FETCH_ASSOC)));
    exit;
}

// POST İŞLEMLERİ (Güncelleme / Silme)
if ($method == 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    // Güvenlik: Giriş yapmayanlar işlem yapamasın
    if (!isset($_SESSION['admin_id'])) {
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
        exit;
    }

    // Durum güncelleme
    if (isset($data['action']) && $data['action'] == 'update_status') {
        $stmt = $pdo->prepare("UPDATE issues SET status = ? WHERE id = ?");
        $stmt->execute([$data['status'], $data['id']]);
        echo json_encode(['success' => true]);
        exit;
    }
    
    // Arıza kaydı silme
    if (isset($data['action']) && $data['action'] == 'delete') {
        $stmt = $pdo->prepare("DELETE FROM issues WHERE id = ?");
        $stmt->execute([$data['id']]);
        echo json_encode(['success' => true]);
        exit;
    }

    // Geri bildirim silme
    if (isset($data['action']) && $data['action'] == 'delete_feedback') {
        $stmt = $pdo->prepare("DELETE FROM feedback WHERE id = ?");
        $stmt->execute([$data['id']]);
        echo json_encode(['success' => true]);
        exit;
    }
    
    // Yanlış bir işlem gelirse
    echo json_encode(['error' => 'Geçersiz işlem']);
    exit;
}