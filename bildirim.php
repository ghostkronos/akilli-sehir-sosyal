<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorun Bildir - Akıllı Şehir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
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
                    <span>Sorun Bildirim Masası</span>
                </div>
            </div>
            <nav class="nav-links d-none d-lg-flex">
                <a href="index.php">Anasayfa</a>
                <a href="yontem.php">Yöntem</a>
                <a href="bildirim.php" class="active">Sorun Bildir</a>
                <a href="iletisim.php ">İletişim</a>
                <a href="giris.php">Personel Portalı</a>
                <div class="nav-indicator"></div>
            </nav>
        </div>
    </header>

    <main class="container my-5">
        <h2 class="section-title text-center mb-5">Yeni Arıza Kaydı Oluştur</h2>
        
        <div id="formArea" class="content-block mx-auto" style="max-width: 800px;">
            <p class="text-muted mb-4">Lütfen sorunlu bölgeyi haritadan seçiniz. Konumunuzu otomatik bulmak için harita üzerindeki 🎯 ikonuna tıklayabilirsiniz.</p>
            
            <form action="sorun-kaydet.php" method="post" enctype="multipart/form-data">
                
                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="form-label">Adınız Soyadınız:</label>
                        <input type="text" name="adsoyad" class="form-control" placeholder="Örn: Ayşe Yılmaz" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">İletişim E-posta:</label>
                        <input type="email" name="email" class="form-control" placeholder="ornek@email.com" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Sorun Türü:</label>
                    <select name="sorun_turu" class="form-select">
                        <option value="Yol / Asfalt Bozukluğu">Yol / Asfalt Bozukluğu</option>
                        <option value="Çöp ve Temizlik">Çöp ve Temizlik</option>
                        <option value="Park ve Peyzaj">Park ve Peyzaj</option>
                        <option value="Sokak Aydınlatma">Sokak Aydınlatma</option>
                        <option value="Su ve Kanalizasyon">Su ve Kanalizasyon</option>
                        <option value="Diğer">Diğer</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Olay Konumunu Seçiniz:</label>
                    <div class="map-container mb-2">
                        <div id="map"></div>
                        <button type="button" class="btn-gps" onclick="konumBul()" title="Konumumu Bul">
                            <svg viewBox="0 0 24 24"><path d="M12 8c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4zm8.94 3c-.46-4.17-3.77-7.48-7.94-7.94V1h-2v2.06C6.83 3.52 3.52 6.83 3.06 11H1v2h2.06c.46 4.17 3.77 7.48 7.94 7.94V23h2v-2.06c4.17-.46 7.48-3.77 7.94-7.94H23v-2h-2.06zM12 19c-3.87 0-7-3.13-7-7s3.13-7 7-7 7 3.13 7 7-3.13 7-7 7z"/></svg>
                        </button>
                    </div>
                    <small id="konum-bilgi" class="fw-bold text-secondary"></small>
                    <input type="hidden" id="enlem" name="enlem" required>
                    <input type="hidden" id="boylam" name="boylam" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Fotoğraf Yükle:</label>
                    <input type="file" name="dosya" class="form-control" accept="image/*">
                </div>

                <div class="mb-4">
                    <label class="form-label">Detaylı Açıklama:</label>
                    <textarea name="aciklama" class="form-control" rows="4" placeholder="Sorunu detaylı açıklayınız..."></textarea>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="kvkk" id="kvkk" required> 
                    <label class="form-check-label" for="kvkk">KVKK kapsamında verilerimin işlenmesini kabul ediyorum.</label>
                </div>

                <button type="submit" class="btn-submit">Bildirimi Gönder</button>
            </form>
        </div>

        <div id="successMsg" class="content-block mx-auto text-center border-start border-success border-5" style="display: none; max-width: 800px;">
            <div class="display-1 text-success mb-3">✅</div>
            <h2 class="text-dark mb-2">Bildiriminiz Alındı!</h2>
            <div class="bg-light d-inline-block px-5 py-3 rounded mb-4">
                <span class="d-block small text-muted">Takip Numaranız</span>
                <strong id="takipNo" class="display-5 text-warning" style="letter-spacing: 2px;">---</strong>
            </div>
            <p class="lead text-muted mb-4">Lütfen bu numarayı kaydedin. Anasayfadaki "Sorun Durumu" alanından başvurunuzu bu numara ile takip edebilirsiniz.</p>
            <div class="d-flex gap-3 justify-content-center">
                <a href="bildirim.php" class="btn btn-secondary px-4 py-2">Yeni Bildirim</a>
                <a href="index.php" class="btn btn-dark px-4 py-2">Anasayfaya Dön</a>
            </div>
        </div>
        

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map', { scrollWheelZoom: false }).setView([38.4192, 27.1287], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);

        var marker;
        function setMarker(lat, lng) {
            if (marker) map.removeLayer(marker);
            marker = L.marker([lat, lng]).addTo(map);
            document.getElementById('enlem').value = lat;
            document.getElementById('boylam').value = lng;
            var bilgi = document.getElementById('konum-bilgi');
            bilgi.innerHTML = "✅ Seçilen Konum: " + lat.toFixed(5) + ", " + lng.toFixed(5);
            bilgi.classList.replace('text-secondary', 'text-success');
        }

        map.on('click', function(e) { setMarker(e.latlng.lat, e.latlng.lng); });

        function konumBul() {
            var bilgi = document.getElementById("konum-bilgi");
            if (navigator.geolocation) {
                bilgi.innerHTML = "⏳ Konum alınıyor...";
                navigator.geolocation.getCurrentPosition(function(pos) {
                    var lat = pos.coords.latitude;
                    var lng = pos.coords.longitude;
                    map.setView([lat, lng], 16);
                    setMarker(lat, lng);
                }, function(err) { bilgi.innerHTML = "❌ Konum alınamadı."; });
            }
        }

        document.addEventListener('DOMContentLoaded', function(){
            const urlParams = new URLSearchParams(window.location.search);
            if(urlParams.get('status') === 'success'){
                document.getElementById('formArea').style.display = 'none';
                const msgDiv = document.getElementById('successMsg');
                msgDiv.style.display = 'block';
                if(urlParams.get('id')) document.getElementById('takipNo').textContent = urlParams.get('id');
                msgDiv.scrollIntoView({ behavior: 'smooth' });
            }
        });
    </script>
</body>
</html>