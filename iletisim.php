<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>İletişim - Akıllı Şehir</title>
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
                    <span>7/24 Çözüm Merkezi</span>
                </div>
            </div>
            <nav class="nav-links d-none d-lg-flex">
                <a href="index.php">Anasayfa</a>
                <a href="yontem.php">Yöntem</a>
                <a href="bildirim.php">Sorun Bildir</a>
                <a href="iletisim.php" class="active">İletişim</a>
                <a href="giris.php">Personel Portalı</a>
                <div class="nav-indicator"></div>
            </nav>
        </div>
    </header>

    <main class="container my-5">
        <h2 class="section-title text-center mb-4">Bize Ulaşın</h2>
        <p class="text-center text-muted mx-auto mb-5" style="max-width: 600px;">
            Öneri, şikayet veya iş birlikleri için aşağıdaki kanallardan bize ulaşabilirsiniz. Çağrı merkezimiz 7/24 hizmet vermektedir.
        </p>

        <div class="row g-4 mb-5">
            <div class="col-md-4">
                <div class="feature-box h-100">
                    <div style="font-size: 2.5rem; margin-bottom: 10px;">📍</div>
                    <h3>Adres</h3>
                    <p class="mb-0">Cumhuriyet Meydanı No:1,<br>Konak / İzmir</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box h-100">
                    <div style="font-size: 2.5rem; margin-bottom: 10px;">📞</div>
                    <h3>Çağrı Merkezi</h3>
                    <p style="font-size: 1.2rem; font-weight: bold; color: var(--secondary-color);" class="mb-1">444 1 123</p>
                    <p class="mb-0"><small class="text-muted">7 Gün 24 Saat</small></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-box h-100">
                    <div style="font-size: 2.5rem; margin-bottom: 10px;">📧</div>
                    <h3>E-Posta</h3>
                    <p class="mb-1"><a href="mailto:destek@akillisehir.bel.tr" class="text-primary text-decoration-none">destek@akillisehir.bel.tr</a></p>
                    <p class="mb-0"><small class="text-muted">Ortalama yanıt süresi: 2 saat</small></p>
                </div>
            </div>
        </div>

        <div class="content-block text-center">
            <h3 class="mb-3">Ulaşım ve Lokasyon</h3>
            <p class="mb-0">Belediye binamız Konak Meydanı'nda, Saat Kulesi'nin hemen arkasında yer almaktadır. Metro, Tramvay ve Vapur iskelelerine yürüme mesafesindedir.</p>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 col-md-6">
                    <h3>Akıllı Şehir Projesi</h3>
                    <p class="small mb-0">Bu proje, şehir altyapı sorunlarını vatandaş katılımı ve modern teknolojilerle (CBS, Yapay Zekâ) çözmeyi amaçlayan akademik bir çalışmadır.</p>
                </div>
                <div class="col-lg-4 col-md-6">
                    <h3>Site Haritası</h3>
                    <ul class="list-unstyled mb-0">
                        <li><a href="index.php">› Anasayfa</a></li>
                        <li><a href="yontem.php">› Yöntem</a></li>
                        <li><a href="bildirim.php">› Sorun Bildir</a></li>
                        <li><a href="giris.php">› Personel Portalı</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12">
                    <h3>İletişim</h3>
                    <ul class="list-unstyled mb-0">
                        <li>📍 Cumhuriyet Meydanı No:1, Konak / İzmir</li>
                        <li>📞 444 1 123</li>
                        <li>📧 destek@akillisehir.bel.tr</li>
                    </ul>
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
        const currentPath = window.location.pathname.split("/").pop() || "iletisim.php";
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