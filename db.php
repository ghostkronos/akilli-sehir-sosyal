<?php
// Veritabanı bağlantısı. Ayarlar config.php dosyasından okunur.
$configFile = __DIR__ . '/config.php';
if (!file_exists($configFile)) {
    http_response_code(500);
    die('Yapılandırma dosyası bulunamadı. config.example.php dosyasını config.php olarak kopyalayın.');
}
$config = require $configFile;

try {
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_TIMEOUT            => 5,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];

    $pdo = new PDO(
        "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4",
        $config['db_user'],
        $config['db_pass'],
        $options
    );
} catch (PDOException $e) {
    // Ayrıntıyı kullanıcıya göstermeden sunucu loguna yaz
    error_log('DB bağlantı hatası: ' . $e->getMessage());
    http_response_code(500);

    if (isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false) {
        header('Content-Type: application/json; charset=utf-8');
        die(json_encode(['error' => 'Veritabanı bağlantı hatası.']));
    }
    die("<!DOCTYPE html><html lang='tr'><head><meta charset='UTF-8'><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'></head><body class='bg-light p-5 d-flex justify-content-center'><div class='container' style='max-width: 600px;'><div class='alert alert-danger text-center shadow-sm'><h2 class='alert-heading'>Veritabanı Bağlantı Hatası</h2><p class='mb-0 mt-3'>Lütfen config.php dosyasındaki ayarları kontrol edin.</p></div></div></body></html>");
}
// DİKKAT: JSON bozulmalarını önlemek için kasıtlı olarak ?> etiketi konulmamıştır.