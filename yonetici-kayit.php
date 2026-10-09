<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici Kayıt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
</head>
<body>
    <header>
        <div class="container d-flex justify-content-between align-items-center py-2">
            <div class="logo-area d-flex align-items-center gap-3">
                <svg viewBox="0 0 100 100">
                    <circle cx="50" cy="50" r="45" fill="none" stroke="#e67e22" stroke-width="5" />
                    <path d="M50,15 C36,15 25,26 25,40 C25,58 50,85 50,85 C50,85 75,58 75,40 C75,26 64,15 50,15 Z" fill="#2c3e50"/>
                </svg>
                <div class="logo-text">
                    <h1>AKILLI ŞEHİR</h1>
                    <span>Personel Portalı</span>
                </div>
            </div>
            <nav class="nav-links d-none d-lg-flex">
                <a href="index.php">Anasayfa</a>
                <a href="yontem.php">Yöntem</a>
                <a href="bildirim.php">Sorun Bildir</a>
                <a href="iletisim.php ">İletişim</a>
                <a href="giris.php" class="active">Personel Portalı</a>
                <div class="nav-indicator"></div>
            </nav>
        </div>
    </header>

    <main class="container my-5 d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        
        <div class="content-block text-center w-100" style="max-width: 500px;">
            <div class="mb-3">
                <svg viewBox="0 0 24 24" width="60" height="60" fill="#2c3e50">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
            <h2 class="text-primary mb-2">Yönetici Kayıt</h2>
            <p class="text-muted small mb-4">Yetkili personel iseniz kayıt olun.</p>
            
            <form action="register.php" method="post" class="text-start">
                <div class="alert alert-warning py-2 px-3 small mb-4 text-secondary border-0" style="background-color: #fff3cd;">
                    Bu kayıt yalnızca yetkili yöneticiler içindir. Lütfen gerçek sicil numaranız ve yönetici doğrulama koduyla kayıt olun.
                </div>

                <div class="mb-3">
                    <label class="form-label">Ad Soyad</label>
                    <input type="text" name="ad_soyad" class="form-control" required placeholder="Adınız ve Soyadınız">
                </div>

                <div class="mb-3">
                    <label class="form-label">Sicil No / Kullanıcı Adı</label>
                    <input type="text" name="kullanici_adi" class="form-control" required placeholder="Sicil No veya Kullanıcı Adı">
                </div>

                <div class="mb-3">
                    <label class="form-label">E-posta (kurumsal)</label>
                    <input type="email" name="email" class="form-control" required placeholder="isim@kurum.gov.tr">
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-sm-6">
                        <label class="form-label">Şifre</label>
                        <input type="password" name="sifre" class="form-control" required placeholder="En az 8 karakter">
                    </div>
                    <div class="col-sm-6">
                        <label class="form-label">Şifre (Tekrar)</label>
                        <input type="password" name="sifre_tekrar" class="form-control" required placeholder="Tekrar girin">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Yönetici Doğrulama Kodu</label>
                    <input type="text" name="admin_kodu" class="form-control" required placeholder="İdare tarafından verilen kod">
                    <div class="form-text text-muted small mt-1">Bu alan, kurumunuz tarafından sağlanan özel kodu doğrulamak içindir.</div>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="accept_rules" name="accept_rules" required>
                    <label class="form-check-label small" for="accept_rules">
                        Kurallar ve gizlilik politikasını okudum, kabul ediyorum.
                    </label>
                </div>

                <button type="submit" class="btn-submit text-uppercase fw-bold" style="background-color: var(--secondary-color);">Kayıt Ol</button>

                <div class="mt-4 text-center">
                    <a href="giris.php" class="text-decoration-none small fw-bold" style="color: var(--accent-color);">Zaten hesabınız var mı? Giriş yap</a>
                </div>
            </form>
        </div>

    </main>

    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <h3>Akıllı Şehir Projesi</h3>
                    <p class="small">Bu proje, şehir altyapı sorunlarını vatandaş katılımı ve modern teknolojilerle (CBS, Yapay Zekâ) çözmeyi amaçlayan akademik bir çalışmadır.</p>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3>Site Haritası</h3>
                    <ul class="list-unstyled">
                        <li><a href="index.php">› Anasayfa</a></li>
                        <li><a href="yontem.php">› Yöntem</a></li>
                        <li><a href="bildirim.php">› Sorun Bildir</a></li>
                        <li><a href="giris.php">› Personel Portalı</a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3>İletişim</h3>
                    <ul class="list-unstyled">
                        <li>📍 Cumhuriyet Meydanı No:1, Konak / İzmir</li>
                        <li>📞 444 1 123</li>
                        <li>📧 destek@akillisehir.bel.tr</li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3>Bize Yazın</h3>
                    <form action="feedback.php" method="post">
                        <div class="mb-2">
                            <input type="text" name="feedback_name" class="form-control form-control-sm" placeholder="Adınız">
                        </div>
                        <div class="mb-2">
                            <textarea name="feedback_message" class="form-control form-control-sm" placeholder="Mesajınız..." required style="height: 60px; resize: none;"></textarea>
                        </div>
                        <button type="submit" class="btn-submit py-1 text-uppercase" style="font-size: 0.85rem;">Gönder</button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-5 pt-3 border-top border-secondary">
                <p class="mb-0 small">&copy; 2025 Akıllı Şehir Yönetim Sistemi Projesi. Tüm hakları saklıdır.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>