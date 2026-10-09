<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personel Portalı Girişi</title>
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
                <a href="iletisim.php">İletişim</a>
                <a href="giris.php" class="active">Personel Portalı</a>
                <div class="nav-indicator"></div>
            </nav>
        </div>
    </header>

    <main class="container my-5 d-flex justify-content-center align-items-center" style="min-height: 70vh;">
        <div class="content-block text-center w-100" style="max-width: 450px;">
            <div class="mb-3">
                <svg viewBox="0 0 24 24" width="60" height="60" fill="#2c3e50">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                </svg>
            </div>
            <h2 class="text-primary mb-2">Yönetici Girişi</h2>
            <p class="text-muted small mb-4">Yetkili personel hesabınızla oturum açın.</p>

            <form action="login.php" method="post" class="text-start">
                <div class="mb-3">
                    <label class="form-label">Kullanıcı Adı</label>
                    <input type="text" name="kullanici_adi" class="form-control" required placeholder="Sicil No veya Kullanıcı Adı">
                </div>
                <div class="mb-4">
                    <label class="form-label">Şifre</label>
                    <input type="password" name="sifre" class="form-control" required placeholder="••••••••">
                </div>

                <button type="submit" class="btn-submit">Giriş Yap</button>

                <div class="mt-4 text-center">
                    <a href="yonetici-kayit.php" class="text-decoration-none small fw-bold" style="color: var(--accent-color);">Kayıt Ol (Sadece Yönetici)</a>
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
        <script>
    const indicator = document.querySelector('.nav-indicator');
    const items = document.querySelectorAll('.nav-links a');

    function setActivePage() {
        const currentPath = window.location.pathname.split("/").pop() || "index.php";

        const portalPages = ['giris.php','yonetici-kayit.php','admin-panel.php'];

        items.forEach(item => {
            const href = item.getAttribute('href');
            let isActive = false;

            if (portalPages.includes(currentPath) && href === 'giris.php') {
                isActive = true;
            } else if (href === currentPath) {
                isActive = true;
            }

            if (isActive) {
                item.classList.add('active');
            } else {
                item.classList.remove('active');
            }
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

        setTimeout(() => {
            indicator.style.transition = 'left 0.4s ease, width 0.4s ease';
        }, 50);
    }

    items.forEach(item => {
        item.addEventListener('mouseenter', (e) => {
            handleIndicator(e.target);
            e.target.style.color = "#e67e22";
        });

        item.addEventListener('mouseleave', (e) => {
            if (!e.target.classList.contains('active')) {
                e.target.style.color = "#2c3e50";
            }
        });
    });

    document.querySelector('.nav-links').addEventListener('mouseleave', () => {
        if (activeItem) {
            handleIndicator(activeItem);
        }
    });
    
    window.addEventListener('resize', () => {
        if (activeItem) {
            
            indicator.style.transition = 'none';
            handleIndicator(activeItem);
            setTimeout(() => {
                indicator.style.transition = 'left 0.4s ease, width 0.4s ease';
            }, 50);
        }
    });
</script>
</body>
</html>