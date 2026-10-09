# Akıllı Şehir Sosyal

Vatandaşların şehirdeki sorunları (yol bozukluğu, çöp, aydınlatma vb.) harita üzerinde konum ve fotoğrafla bildirebildiği, belediye personelinin ise bu bildirimleri yönetebildiği bir web uygulaması.

## Özellikler

- Harita üzerinden konum seçerek fotoğraflı sorun bildirimi
- Bildirim numarası ile durum sorgulama (Yeni / İnceleniyor / Çözüldü)
- Yönetici paneli: harita, filtreleme, arama, durum güncelleme ve silme
- Vatandaş geri bildirim formu ve yönetici mesaj kutusu
- Şifreler `password_hash` ile saklanır, tüm sorgular PDO hazırlanmış ifadeleriyle çalışır

## Teknolojiler

PHP 8, MySQL / MariaDB (PDO), Bootstrap 5, Leaflet, JavaScript

## Kurulum

### Gereksinimler
XAMPP, WAMP veya MAMP gibi bir PHP + MySQL sunucusu (önerilen: PHP 8.0 ve üzeri).

### Adımlar

1. Projeyi `htdocs` klasörünün içine kopyalayın (ör. `C:\xampp\htdocs\akilli_sehir_sosyal`).
2. XAMPP'tan **Apache** ve **MySQL** servislerini başlatın.
3. [phpMyAdmin](http://localhost/phpmyadmin) üzerinden `akilli_sehir` adında bir veritabanı oluşturun.
4. Bu veritabanını seçip **İçe Aktar** sekmesinden `akilli_sehir.sql` dosyasını yükleyin.
5. `config.example.php` dosyasını `config.php` olarak kopyalayın ve veritabanı bilgilerinizi ve `admin_code` değerini düzenleyin.
6. Tarayıcıdan açın: <http://localhost/akilli_sehir_sosyal/index.php>

### Demo yönetici hesabı

Veritabanıyla birlikte yalnızca deneme amaçlı bir hesap gelir:

| Kullanıcı adı | Şifre |
|---|---|
| `admin` | `Demo1234!` |

> **Uyarı:** Gerçek bir sunucuda kullanmadan önce bu hesabı silin veya şifresini değiştirin ve `config.php` içindeki `admin_code` değerini değiştirin. Yeni yöneticiler `yonetici-kayit.php` sayfasından, bu doğrulama koduyla eklenir.

## Proje yapısı

| Dosya | Açıklama |
|---|---|
| `index.php` | Ana sayfa ve bildirim sorgulama |
| `bildirim.php` / `sorun-kaydet.php` | Sorun bildirim formu / kaydı |
| `giris.php`, `login.php`, `logout.php` | Personel girişi |
| `yonetici-kayit.php` / `register.php` | Yönetici kaydı |
| `admin-panel.php` | Yönetici paneli |
| `api.php` | JSON API (liste, sorgu, güncelleme, silme) |
| `feedback.php` | Geri bildirim kaydı |
| `db.php`, `config.example.php` | Veritabanı bağlantısı ve ayar şablonu |
| `akilli_sehir.sql` | Veritabanı yapısı ve örnek veriler |
| `assets/`, `uploads/` | Görseller ve yüklenen fotoğraflar |

## Lisans

[MIT](LICENSE)