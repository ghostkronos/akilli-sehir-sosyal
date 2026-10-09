<?php
session_start();
// İzinsiz girişi engelle, giriş yapılmadıysa giris.php'ye yönlendir
if (!isset($_SESSION['admin_id'])) { 
    header('Location: giris.php'); 
    exit; 
}
$admin_name = htmlspecialchars($_SESSION['admin_name'] ?? '');
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yönetici Paneli - Akıllı Şehir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="icon" type="image/png" href="assets/logo.png">
    <style>
        .tab-btn { background: #dfe6e9; color: #7f8c8d; }
        .tab-btn:hover { background: #b2bec3; color: white; }
        .tab-btn.active { background: var(--primary-color); color: white; box-shadow: 0 4px 10px rgba(44, 62, 80, 0.3); }
        .msg-item { border-left: 5px solid #3498db; transition: transform 0.2s; }
        .msg-item:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important; }
    </style>
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
                    <span>Yönetici Paneli</span>
                </div>
            </div>
            <nav class="nav-links d-none d-lg-flex">
                <a href="index.php">Anasayfa</a>
                <a href="admin-panel.php" class="active">Panel</a>
                <a href="logout.php">Çıkış Yap</a>
                <div class="nav-indicator"></div>
            </nav>
        </div>
    </header>

    <main class="container-fluid py-4" style="max-width: 1400px;">

        <div class="d-flex justify-content-between align-items-center mb-4 px-3">
            <div class="text-muted">Hoşgeldiniz, <strong class="text-dark"><?php echo $admin_name; ?></strong></div>
        </div>

        <div class="row mb-4 px-3">
            <div class="col-12 d-flex gap-2">
                <button class="btn tab-btn active flex-grow-1 py-3 fw-bold border-0 rounded" onclick="switchTab('issues')">
                    🗺️ Saha Sorunları & Harita
                </button>
                <button class="btn tab-btn flex-grow-1 py-3 fw-bold border-0 rounded" onclick="switchTab('feedback')">
                    💬 Gelen Kutusu (Mesajlar)
                </button>
            </div>
        </div>

        <div id="tab-issues" class="row px-3">
            <aside class="col-lg-4 mb-4">
                <div class="content-block h-100 d-flex flex-column">
                    <h3 class="text-primary mt-0">Sorun Bildirimleri</h3>
                    <p class="text-muted small mb-3">Sorun ID ile takip yapabilirsiniz.</p>

                    <div class="mb-3">
                        <input type="text" id="searchBox" class="form-control mb-2" placeholder="Ara... (ID, adres, açıklama)" />
                        <div class="d-flex gap-3 flex-wrap small">
                            <div class="form-check"><input class="form-check-input filterStatus" type="checkbox" value="new" id="f1" checked><label class="form-check-label" for="f1">Yeni</label></div>
                            <div class="form-check"><input class="form-check-input filterStatus" type="checkbox" value="in_progress" id="f2" checked><label class="form-check-label" for="f2">İnceleniyor</label></div>
                            <div class="form-check"><input class="form-check-input filterStatus" type="checkbox" value="solved" id="f3" checked><label class="form-check-label" for="f3">Çözüldü</label></div>
                        </div>
                        <button id="btnReset" class="btn btn-outline-secondary btn-sm mt-3 w-100">Filtreleri Sıfırla</button>
                    </div>

                    <div id="issuesList" class="flex-grow-1 overflow-auto pe-2" style="max-height: 500px;"></div>
                </div>
            </aside>

            <section class="col-lg-8">
                <div class="content-block p-0 overflow-hidden h-100" style="min-height: 600px;">
                    <div id="map"></div>
                </div>
            </section>
        </div>

        <div id="tab-feedback" class="container" style="display: none; max-width: 900px;">
            <div class="content-block">
                <h3 class="text-primary border-bottom pb-3">📥 Vatandaş Görüş ve Önerileri</h3>
                <div id="feedbackList" class="mt-4">
                    <p class="text-center text-muted">Mesajlar yükleniyor...</p>
                </div>
            </div>
        </div>

        <div id="imgModal" class="img-modal" style="display:none;">
            <div class="img-modal-content">
                <button id="imgModalClose" class="btn btn-dark">Kapat</button>
                <img id="imgModalImg" src="" alt="Fotoğraf" />
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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
    let map, markers;
    let issues = [];

    document.addEventListener('DOMContentLoaded', function(){
        initMap();
        loadIssues();
    });

    // Sekmeler Arası Geçiş
    window.switchTab = function(tabName) {
        document.getElementById('tab-issues').style.display = 'none';
        document.getElementById('tab-feedback').style.display = 'none';
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));

        if(tabName === 'issues') {
            document.getElementById('tab-issues').style.display = 'flex';
            document.querySelector("button[onclick=\"switchTab('issues')\"]").classList.add('active');
            setTimeout(() => { map.invalidateSize(); }, 100);
        } else {
            document.getElementById('tab-feedback').style.display = 'block';
            document.querySelector("button[onclick=\"switchTab('feedback')\"]").classList.add('active');
            loadFeedback();
        }
    }

    // Harita Başlatma
    function initMap() {
        map = L.map('map', {
            scrollWheelZoom: false, doubleClickZoom: false, boxZoom: false, 
            keyboard: false, zoomControl: true, dragging: true          
        }).setView([38.4192, 27.1287], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { maxZoom: 19 }).addTo(map);
        markers = L.layerGroup().addTo(map);
    }

    // Sorunları Veritabanından Çekme
    async function loadIssues() {
        try {
            // Önbellek sorununu aşmak için ?t=Date.now() ekledik
            const response = await fetch('api.php?t=' + Date.now());
            const data = await response.json();
            
            if(data.error) {
                document.getElementById('issuesList').innerHTML = `<p class="text-danger text-center">${data.error}</p>`;
                return;
            }
            
            issues = Array.isArray(data) ? data : [];
            renderMarkers();
            renderList();
        } catch (error) { 
            console.error('Hata:', error); 
        }
    }

    function statusColor(s){ return s==='new'?'#e74c3c':(s==='in_progress'?'#f39c12':'#2ecc71'); }
    function statusText(s){ return s==='new'?'Yeni':(s==='in_progress'?'Devam Ediyor':'Çözüldü'); }
    function esc(s){ return (s||'').toString().replace(/[&<>\"]/g,c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c])); }

    // Haritaya İşaretçileri Ekleme
    function renderMarkers(){ 
        markers.clearLayers(); 
        const activeFilters = Array.from(document.querySelectorAll('.filterStatus:checked')).map(n=>n.value);
        
        issues.filter(it => activeFilters.includes(it.status)).forEach(it=>{
            if(!it.lat) return;
            const m = L.circleMarker([it.lat,it.lng],{radius:10,color:statusColor(it.status),fillColor:statusColor(it.status),fillOpacity:0.9}).addTo(markers);
            
            const photoHtml = it.foto_yolu ? `<div class="mt-2"><img src="${it.foto_yolu}" class="img-fluid rounded" style="cursor:pointer;" onclick="showImage('${it.foto_yolu}')"></div>` : '';
            
            m.bindPopup(`
                <div style="max-width:260px">
                    <strong>#${it.id} - ${esc(it.sorun_turu)}</strong>
                    <div class="small mt-1">${esc(it.aciklama)}</div>
                    ${photoHtml}
                    <div class="mt-2 d-flex gap-1 align-items-center">
                        <select onchange="updateStatus(${it.id}, this.value)" class="form-select form-select-sm" style="padding:2px 5px; font-size:0.85rem;">
                            <option value="new" ${it.status=='new'?'selected':''}>Yeni</option>
                            <option value="in_progress" ${it.status=='in_progress'?'selected':''}>İnceleniyor</option>
                            <option value="solved" ${it.status=='solved'?'selected':''}>Çözüldü</option>
                        </select>
                        <button onclick="deleteIssue(${it.id})" class="btn btn-danger btn-sm" style="font-size:0.85rem; padding:2px 8px;">Sil</button>
                    </div>
                </div>
            `);
        });
    }

    // Kenar Çubuğuna Listeleme
    function renderList(){ 
        const container = document.getElementById('issuesList'); 
        container.innerHTML='';
        const activeFilters = Array.from(document.querySelectorAll('.filterStatus:checked')).map(n=>n.value);
        const q = (document.getElementById('searchBox').value||'').toLowerCase().trim();

        issues.filter(it => 
            activeFilters.includes(it.status) && 
            (esc(it.sorun_turu).toLowerCase().includes(q) || esc(it.aciklama).toLowerCase().includes(q) || (it.id||'').toString().includes(q))
        ).forEach(it=>{
            const div = document.createElement('div'); div.className='issue-item';
            div.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <strong class="text-primary">#${it.id} ${esc(it.sorun_turu)}</strong>
                    <span class="status-pill ${it.status==='new'?'status-new':it.status==='in_progress'?'status-progress':'status-solved'}" style="color: inherit; font-size:0.8rem; padding:3px 8px;">${statusText(it.status)}</span>
                </div>
                <div class="small text-muted mb-2">${esc(it.aciklama)}</div>
                <div><button class="btn btn-outline-secondary btn-sm" onclick="focusMap(${it.lat}, ${it.lng})">Konuma Git</button></div>
            `;
            container.appendChild(div);
        });
    }

    // Gelen Mesajları Yükleme
    async function loadFeedback() {
        const container = document.getElementById('feedbackList');
        container.innerHTML = '<p class="text-center text-muted">Mesajlar yükleniyor...</p>';
        try {
            const res = await fetch('api.php?type=feedback&t=' + Date.now());
            const messages = await res.json();
            container.innerHTML = '';
            
            if(messages.error) {
                container.innerHTML = `<p class="text-danger text-center">${messages.error}</p>`;
                return;
            }
            
            if(messages.length === 0) {
                container.innerHTML = '<div class="text-center p-4 text-muted">📭 Henüz hiç mesaj yok.</div>';
                return;
            }
            
            messages.forEach(msg => {
                const div = document.createElement('div');
                div.className = 'msg-item card p-3 mb-3 bg-white border-0 shadow-sm';
                div.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2 small text-muted">
                        <div><span style="font-size:1.1rem;">👤</span> <strong class="text-dark">${esc(msg.ad)}</strong></div>
                        <div>📅 ${msg.created_at}</div>
                    </div>
                    <div class="text-dark mb-3" style="font-size:1rem; line-height:1.5;">${esc(msg.mesaj)}</div>
                    <div class="text-end">
                        <button class="btn btn-danger btn-sm px-3" onclick="deleteFeedback(${msg.id})">🗑️ Mesajı Sil</button>
                    </div>
                `;
                container.appendChild(div);
            });
        } catch (e) { container.innerHTML = '<p class="text-danger text-center">Hata oluştu.</p>'; }
    }

    // API İstekleri (Güncelle, Sil, Odaklan)
    window.deleteFeedback = async (id) => {
        if(confirm('Bu mesajı kalıcı olarak silmek istediğinize emin misiniz?')) {
            await fetch('api.php', { method: 'POST', body: JSON.stringify({ action: 'delete_feedback', id: id }) });
            loadFeedback();
        }
    };
    window.focusMap = (lat, lng) => { 
        if(window.innerWidth < 900) window.scrollTo({top:0, behavior:'smooth'});
        map.setView([lat, lng], 16); 
    };
    window.updateStatus = async (id, newStatus) => {
        await fetch('api.php', { method: 'POST', body: JSON.stringify({ action: 'update_status', id: id, status: newStatus }) });
        loadIssues(); map.closePopup();
    };
    window.deleteIssue = async (id) => {
        if(confirm('Silmek istediğinize emin misiniz?')) {
            await fetch('api.php', { method: 'POST', body: JSON.stringify({ action: 'delete', id: id }) });
            loadIssues();
        }
    };
    window.showImage = (src) => { document.getElementById('imgModalImg').src=src; document.getElementById('imgModal').style.display='flex'; };

    // Event Listeners (Tıklamalar ve Aramalar)
    document.getElementById('imgModalClose').addEventListener('click', ()=>document.getElementById('imgModal').style.display='none');
    document.getElementById('searchBox').addEventListener('input', ()=>renderList());
    document.querySelectorAll('.filterStatus').forEach(cb=>cb.addEventListener('change', ()=>{ renderList(); renderMarkers(); }));
    document.getElementById('btnReset').addEventListener('click', ()=>{ 
        document.getElementById('searchBox').value=''; 
        document.querySelectorAll('.filterStatus').forEach(cb=>cb.checked=true); 
        renderList(); renderMarkers(); 
    });
    </script>
</body>
</html>