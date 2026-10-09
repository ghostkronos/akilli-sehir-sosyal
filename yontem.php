<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yöntem ve Süreç - Akıllı Şehir</title>
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
                    <span>Teknik Altyapı</span>
                </div>
            </div>
            <nav class="nav-links d-none d-lg-flex">
                <a href="index.php">Anasayfa</a>
                <a href="yontem.php" class="active">Yöntem</a>
                <a href="bildirim.php">Sorun Bildir</a>
                <a href="iletisim.php ">İletişim</a>
                <a href="giris.php">Personel Portalı</a>
                <div class="nav-indicator"></div>
            </nav>
        </div>
    </header>

    <main class="container my-5">
        <h2 class="section-title text-center mb-5">Proje Yöntemi ve Mimari</h2>
        
        <div class="content-block mb-5 text-center">
            <p class="mb-0">
                Akıllı Şehir Yönetim Sistemi; Analiz, Tasarım, Geliştirme, Test ve Pilot Uygulama olmak üzere 5 temel fazda geliştirilmektedir. 
                Sistem mimarisi modern web teknolojileri (React, Node.js, PostgreSQL) üzerine kuruludur.
            </p>
        </div>

        <h3 class="text-primary mb-4 text-center text-lg-start">Geliştirme Aşamaları (In Progress)</h3>
        <div class="row g-4 mb-5">
            
            <div class="col-md-6 col-lg-3">
                <div class="feature-box h-100 text-start" style="border-top-color: #3498db;">
                    <h4>1. Analiz ve Tasarım</h4>
                    <p class="mb-0">Kullanıcı senaryolarının oluşturulması. Veritabanı şemasının (ER Diyagramı) hazırlanması.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-box h-100 text-start" style="border-top-color: #9b59b6;">
                    <h4>2. Backend Geliştirme</h4>
                    <p class="mb-0"><b>PostgreSQL</b> ve <b>Node.js</b> kullanılarak REST API servislerinin yazılması.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-box h-100 text-start" style="border-top-color: #2ecc71;">
                    <h4>3. Frontend ve Mobil</h4>
                    <p class="mb-0"><b>React Native</b> ile mobil uygulama ve web yönetim panelinin kodlanması.</p>
                </div>
            </div>

            <div class="col-md-6 col-lg-3">
                <div class="feature-box h-100 text-start" style="border-top-color: #e74c3c;">
                    <h4>4. Yapay Zeka Entegrasyonu</h4>
                    <p class="mb-0">TensorFlow Lite ile yüklenen fotoğrafların otomatik sınıflandırılması.</p>
                </div>
            </div>
        </div>

        <div class="content-block">
            <h3 class="mb-4">📅 Öngörülen Çalışma Takvimi</h3>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Aşama</th>
                            <th>Süre (Ay)</th>
                            <th>Beklenen Çıktı</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Analiz ve Tasarım</td>
                            <td>1 Ay</td>
                            <td>Sistem Mimarisi, Veritabanı Şeması</td>
                        </tr>
                        <tr>
                            <td>Yazılım Geliştirme</td>
                            <td>4 Ay</td>
                            <td>Mobil Uygulama, API, Web Panel</td>
                        </tr>
                        <tr>
                            <td>Test ve Pilot</td>
                            <td>2 Ay</td>
                            <td>Hata Raporları, Kullanıcı Geri Bildirimi</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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
    <script>
    const indicator = document.querySelector('.nav-indicator');
    const items = document.querySelectorAll('.nav-links a');

    function setActivePage() {
        const currentPath = window.location.pathname.split("/").pop() || "yontem.php";
        items.forEach(item => {
            if (item.getAttribute('href') === currentPath) item.classList.add('active');
            else item.classList.remove('active');
        });
    }
    setActivePage();

    const activeItem = document.querySelector('.nav-links a.active');
    function handleIndicator(el) {
        if (!el) return;
        indicator.style.width = `${el.offsetWidth}px`;
        indicator.style.left = `${el.offsetLeft}px`;
        indicator.style.backgroundColor = "#e67e22";
    }
    if (activeItem) {
        indicator.style.transition = 'none';
        handleIndicator(activeItem);
        setTimeout(() => indicator.style.transition = 'left 0.4s ease, width 0.4s ease', 50);
    }
    items.forEach(item => {
        item.addEventListener('mouseenter', (e) => handleIndicator(e.target));
        item.addEventListener('mouseleave', () => { if(activeItem) handleIndicator(activeItem); });
    });
    </script>
</body>
</html>