<?php
session_start();
$isAdmin = isset($_SESSION['admin_id']);
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anasayfa - Akıllı Şehir Yönetim Sistemi</title>
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
                    <span>Yönetim Platformu</span>
                </div>
            </div>
            <nav class="nav-links d-none d-lg-flex">
                <a href="index.php" class="active">Anasayfa</a>
                <a href="yontem.php">Yöntem</a>
                <a href="bildirim.php">Sorun Bildir</a>
                <a href="iletisim.php ">İletişim</a>
                <a href="giris.php">Personel Portalı</a>
                <?php if ($isAdmin): ?>
                    <a href="admin-panel.php">Admin Panel</a>
                <?php endif; ?>
                <div class="nav-indicator"></div>
            </nav>
        </div>
    </header>

    <div class="hero-header">
        <h1>Şehrinizin Sorunlarına<br>Dijital Çözüm</h1>
        <p>Altyapı, çevre ve kentsel yaşam kalitesine dair sorunları saniyeler içinde belediyeye iletin. Birlikte daha yaşanabilir bir şehir kuralım.</p>
        <a href="bildirim.php" class="btn-cta mt-3">Hemen Sorun Bildir 📢</a>
    </div>

    <main class="container my-5">
        
        <div class="content-block mb-5">
            <h2 class="section-title text-center">Projenin Amacı</h2>
            <p class="text-center mt-4">
                Günümüz şehirleri, hızla artan nüfus ve altyapı yoğunluğu nedeniyle sürekli bakım gerektiren karmaşık sistemlerdir. 
                Manuel bildirim yöntemlerinin yarattığı gecikmeleri ortadan kaldırmak amacıyla, 
                <b>Akıllı Şehir Yönetimi</b> yaklaşımı doğrultusunda bu proje geliştirilmiştir.
            </p>
        </div>

        <h2 class="section-title text-center mb-5">Temel Özellikler</h2>
        <div class="row g-4 mb-5">
            <div class="col-md-6 col-lg-3">
                <div class="feature-box h-100">
                    <div style="font-size:3rem;">🌍</div>
                    <h3>Konum Tabanlı (CBS)</h3>
                    <p>GPS verisi entegrasyonu ile sorunların tam konumu anlık olarak harita üzerinde tespit edilir.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-box h-100">
                    <div style="font-size:3rem;">📱</div>
                    <h3>Mobil Entegrasyon</h3>
                    <p>Vatandaşlar cep telefonlarından fotoğraf çekerek görsel kanıtlı bildirim oluşturabilir.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-box h-100">
                    <div style="font-size:3rem;">🤖</div>
                    <h3>Yapay Zekâ</h3>
                    <p>Görüntü işleme teknikleri kullanılarak yüklenen fotoğraflardan arıza türü otomatik tahmin edilir.</p>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="feature-box h-100">
                    <div style="font-size:3rem;">📊</div>
                    <h3>Veri Analitiği</h3>
                    <p>Arıza yoğunluk haritaları oluşturularak proaktif önlemler alınır.</p>
                </div>
            </div>
        </div>

        <section id="sorun-durum" class="content-block mx-auto" style="max-width:900px;">
            <h2 class="section-title text-center">Sorun Durumu Kontrolü</h2>
            <p class="text-center text-muted small mt-3">Bildirim ID'sini (Örn: 1, 5, 20) buraya yazarak durumunu öğrenebilirsiniz.</p>
            
            <div id="statusResult" class="p-4 bg-light rounded text-center border mt-4" style="min-height: 100px; display: flex; flex-direction: column; justify-content: center; align-items: center;">
                Henüz bir ID girilmedi. Aşağıya ID yazıp <strong>Sorgula</strong> butonuna basabilirsiniz.
            </div>
            
            <div class="d-flex gap-2 mt-4">
                <input id="statusManualId" type="number" class="form-control" placeholder="Bildirim ID (Örn: 3)" />
                <button id="statusBtnLookup" class="btn btn-cta" style="padding: 12px 30px;">Sorgula</button>
            </div>
        </section>

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
    (function(){
      function translate(s){ 
          if(s==='new') return {t:'Yeni', c:'status-new'}; 
          if(s==='in_progress') return {t:'İnceleniyor', c:'status-progress'}; 
          if(s==='solved') return {t:'Çözüldü', c:'status-solved'}; 
          return {t:s, c:'status-new'} 
      }

      function renderIssue(issue){ 
          const res = document.getElementById('statusResult'); 
          res.className = 'p-4 bg-light rounded text-start border mt-4';
          res.innerHTML = ''; 

          const h = document.createElement('h3'); 
          h.textContent = issue.sorun_turu || '(Başlıksız)'; 
          h.style.color = 'var(--primary-color)';
          h.style.marginTop = '0';

          const st = translate(issue.status); 
          const pill = document.createElement('span'); 
          pill.className = 'status-pill ' + st.c; 
          pill.textContent = st.t; 
          
          const p = document.createElement('p'); 
          p.textContent = issue.aciklama || '(Açıklama yok)'; 
          p.className = 'mt-3 mb-0';

          res.appendChild(h); 
          res.appendChild(pill);
          res.appendChild(p); 
           
          if(issue.foto_yolu){ 
              const img = document.createElement('img'); 
              img.src = issue.foto_yolu; 
              img.className = 'img-fluid rounded mt-3'; 
              res.appendChild(img);
          } 

          const meta = document.createElement('div'); 
          meta.className = 'mt-3 small text-muted'; 
          meta.innerHTML = '<strong>Kayıt ID:</strong> ' + issue.id + '<br/><strong>Durum:</strong> ' + st.t; 
          res.appendChild(meta);
      } 

      function showNotFound(id){ 
          const res = document.getElementById('statusResult'); 
          res.className = 'p-4 bg-light rounded text-center border mt-4 text-danger'; 
          const safeId = String(id).replace(/[&<>"']/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[c]));
          res.innerHTML = `⚠️ <strong>${safeId}</strong> numaralı kayıt sistemde bulunamadı.<br><small class="text-muted">Lütfen ID'yi doğru girdiğinizden emin olun.</small>`; 
      }

      function lookup(id){ 
          if(!id){ 
              document.getElementById('statusResult').textContent = 'Lütfen geçerli bir ID girin.'; 
              return; 
          } 
          document.getElementById('statusResult').innerHTML = '🔍 Sorgulanıyor...';

          fetch('api.php?id=' + id)
            .then(response => response.json())
            .then(data => { if(data && data.id) renderIssue(data); else showNotFound(id); })
            .catch(error => { console.error('Hata:', error); showNotFound(id); });
      }

      document.getElementById('statusBtnLookup').addEventListener('click', () => { 
          const v = document.getElementById('statusManualId').value.trim(); 
          if(v) lookup(v); 
      });

      const urlParams = new URLSearchParams(window.location.search);
      const autoId = urlParams.get('id');
      if(autoId) { document.getElementById('statusManualId').value = autoId; lookup(autoId); }
    })();

    const indicator = document.querySelector('.nav-indicator');
    const items = document.querySelectorAll('.nav-links a');
    function setActivePage() {
        const currentPath = window.location.pathname.split("/").pop() || "index.php";
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