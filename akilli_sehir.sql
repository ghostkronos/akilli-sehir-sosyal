-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 09 Oca 2026, 19:26:48
-- Sunucu sürümü: 10.4.32-MariaDB
-- PHP Sürümü: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `akilli_sehir`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(100) DEFAULT NULL,
  `kullanici_adi` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sifre` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `admins`
--

INSERT INTO `admins` (`id`, `ad_soyad`, `kullanici_adi`, `email`, `sifre`, `created_at`) VALUES
(1, 'Demo Yönetici', 'admin', 'admin@example.com', '$2y$10$2OYJkqyJN9xGGrgAtjC42OVDlFIBpM.kiQ1bcbnES5M7lDwysSg3G', '2025-12-24 22:50:04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `ad` varchar(100) DEFAULT NULL,
  `mesaj` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `feedback`
--

INSERT INTO `feedback` (`id`, `ad`, `mesaj`, `created_at`) VALUES
(2, 'Canan Yurt', 'Uygulamanız çok güzel olmuş, tebrik ederim. Belki ileride otobüs saatlerini de ekleyebilirsiniz.', '2025-12-24 22:00:14'),
(3, 'Burak Yıldız', 'Alo 153 hattına ulaşmakta zorlanıyoruz, lütfen çağrı merkezi sayısını artırın.', '2025-12-24 22:00:14'),
(4, 'Elif Şahin', 'Parklardaki spor aletlerinin bakımı için teşekkürler, şimdi çok daha kullanışlı oldular.', '2025-12-24 22:00:14');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `issues`
--

CREATE TABLE `issues` (
  `id` int(11) NOT NULL,
  `ad_soyad` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sorun_turu` varchar(50) DEFAULT NULL,
  `lat` decimal(10,8) DEFAULT NULL,
  `lng` decimal(11,8) DEFAULT NULL,
  `aciklama` text DEFAULT NULL,
  `foto_yolu` varchar(255) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'new',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_turkish_ci;

--
-- Tablo döküm verisi `issues`
--

INSERT INTO `issues` (`id`, `ad_soyad`, `email`, `sorun_turu`, `lat`, `lng`, `aciklama`, `foto_yolu`, `status`, `created_at`) VALUES
(4, 'Ahmet Yılmaz', 'ahmet@example.com', 'Yol / Asfalt Bozukluğu', 38.41920000, 27.12870000, 'Konak meydanındaki ana yolda büyük bir çukur var, araçlar zor geçiyor.', 'uploads/demo1.jpg', 'in_progress', '2025-12-24 22:03:14'),
(5, 'Ayşe Demir', 'ayse@example.com', 'Çöp ve Temizlik', 38.42150000, 27.13500000, 'Alsancak tarafındaki konteynerler 3 gündür boşaltılmadı, koku yapıyor.', 'uploads/demo2.jpg', 'in_progress', '2025-12-24 22:03:14'),
(6, 'Mehmet Kaya', 'mehmet@example.com', 'Sokak Aydınlatma', 38.41500000, 27.12500000, 'Parkın içindeki lambaların yarısı yanmıyor, akşamları çok karanlık oluyor.', 'uploads/demo3.jpg', 'solved', '2025-12-24 22:03:14'),
(7, 'Zeynep Çelik', 'zeynep@example.com', 'Park ve Peyzaj', 38.42500000, 27.14000000, 'Çocuk parkındaki salıncakların zincirleri kopmuş, tamir edilmesi gerekiyor.', 'uploads/demo4.jpg', 'new', '2025-12-24 22:03:14');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `kullanici_adi` (`kullanici_adi`);

--
-- Tablo için indeksler `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Tablo için AUTO_INCREMENT değeri `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
