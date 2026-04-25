<?php include 'includes/header.php'; ?>

<?php if(isset($_GET['pesan']) && $_GET['pesan'] == 'logout'): ?>
    <div class="alert alert-aesthetic animate__animated animate__fadeInDown" 
         style="background: white; border-left: 5px solid var(--dusty-pink); border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
        <div class="d-flex align-items-center p-2">
            <div class="me-3 fs-4">✨</div>
            <div>
                <h6 class="mb-0 fw-bold" style="color: var(--dark-text);">Sampai Jumpa!</h6>
                <small class="text-muted">Sesi Anda telah berakhir. Terima kasih atas kerja kerasnya!</small>
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
<?php endif; ?>

<div class="row align-items-center" style="min-height: 75vh;">
    <div class="col-lg-8 text-start">
        <span class="badge rounded-pill px-3 py-2 mb-3" style="background-color: var(--soft-pink); color: var(--dusty-pink); font-weight: 600;">✨ Rekomendasi Laundry Bekasi Terbaik</span>
        
        <h1 class="display-2 fw-bold" style="color: var(--dusty-pink); line-height: 1.1;">
            Cari Laundry <br><span style="color: var(--dark-text);">Jadi Lebih Mudah.</span>
        </h1>
        
        <p class="lead text-muted mt-4" style="font-size: 1.2rem; line-height: 1.8; max-width: 650px;">
            Bingung pilih laundry yang pas? Kami membantu Anda menemukan layanan laundry yang paling sesuai berdasarkan <strong>harga, kecepatan, dan kualitas</strong> melalui perbandingan data yang akurat.
        </p>
        
        <div class="mt-5 d-flex flex-column flex-md-row gap-3">
            <a href="pelanggan/view.php" class="btn-pink btn-lg text-decoration-none text-center shadow-lg px-5 py-3">Temukan Laundry</a>
            <a href="login.php" class="btn btn-outline-secondary btn-lg rounded-pill px-5 py-3 text-center">Akses Admin</a>
        </div>

        <div class="row mt-5 pt-4">
            <div class="col-4 col-md-3">
                <h4 class="fw-bold mb-0" style="color: var(--dusty-pink);">20+</h4>
                <p class="small text-muted">Mitra Terpercaya</p>
            </div>
            <div class="col-4 col-md-3">
                <h4 class="fw-bold mb-0" style="color: var(--dusty-pink);">Cepat</h4>
                <p class="small text-muted">Hasil Kalkulasi</p>
            </div>
            <div class="col-4 col-md-3">
                <h4 class="fw-bold mb-0" style="color: var(--dusty-pink);">Realtime</h4>
                <p class="small text-muted">Informasi Layanan</p>
            </div>
        </div>
    </div>
</div>

<hr style="border-color: var(--soft-pink); opacity: 0.5;">

<div class="py-5" id="cara-kerja">
    <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: var(--dark-text);">Hanya 3 Langkah Mudah</h2>
        <p class="text-muted">Cara kami membantu Anda mendapatkan pakaian bersih tanpa pusing.</p>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card card-aesthetic p-4 h-100 border-0 text-center shadow-sm rounded-4">
                <div class="mx-auto mb-3" style="width: 70px; height: 70px; background: var(--soft-pink); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">📱</div>
                <h5 class="fw-bold">1. Atur Prioritas</h5>
                <p class="small text-muted">Tentukan apa yang paling penting bagi Anda: Harga murah? Atau kecepatan pengerjaan?</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-aesthetic p-4 h-100 border-0 text-center shadow-sm rounded-4">
                <div class="mx-auto mb-3" style="width: 70px; height: 70px; background: var(--soft-pink); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">🔍</div>
                <h5 class="fw-bold">2. Analisis Otomatis</h5>
                <p class="small text-muted">Sistem kami membandingkan semua mitra berdasarkan kriteria yang Anda inginkan secara instan.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-aesthetic p-4 h-100 border-0 text-center shadow-sm rounded-4">
                <div class="mx-auto mb-3" style="width: 70px; height: 70px; background: var(--soft-pink); border-radius: 20px; display: flex; align-items: center; justify-content: center; font-size: 1.5rem;">✨</div>
                <h5 class="fw-bold">3. Pilih & Pesan</h5>
                <p class="small text-muted">Dapatkan daftar laundry yang paling pas, pilih favorit Anda, dan pakaian akan segera dijemput.</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-5 bg-white p-5 rounded-4 shadow-sm align-items-center mb-5">
    <div class="col-md-6">
        <h3 class="fw-bold mb-4" style="color: var(--dusty-pink);">Mengapa Memilih Kami?</h3>
        <p class="text-muted">Kami merancang platform ini untuk memastikan setiap pelanggan mendapatkan pelayanan yang sepadan dengan biayanya.</p>
        <ul class="list-unstyled">
            <li class="mb-2">✅ <strong>Personal:</strong> Hasil rekomendasi berbeda sesuai kebutuhan tiap orang.</li>
            <li class="mb-2">✅ <strong>Transparan:</strong> Semua perbandingan data dilakukan secara objektif.</li>
            <li class="mb-2">✅ <strong>Mudah:</strong> Antarmuka yang simpel dan nyaman digunakan dari ponsel.</li>
        </ul>
    </div>
    <div class="col-md-6 text-center">
        <div class="p-4 shadow-sm rounded-4" style="background: var(--cream); border: 2px dashed var(--soft-pink);">
             <p class="mb-0 fw-bold" style="color: var(--dusty-pink); font-size: 1.1rem;">
                "Menemukan laundry terbaik kini semudah menggerakkan jari."
             </p>
             <small class="text-muted mt-2 d-block">— Smart Laundry Solution</small>
        </div>
    </div>
</div>

<div class="py-5" id="testimoni"> <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: var(--dark-text);">Apa Kata Mereka?</h2>
        <p class="text-muted">Kepuasan pelanggan adalah prioritas utama mitra kami.</p>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 card-hover">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://ui-avatars.com/api/?name=Arrosyid&background=faedcd&color=d4a373" class="rounded-circle me-3" width="50">
                    <div>
                        <h6 class="fw-bold mb-0">Arrosyid</h6>
                        <small class="text-warning">⭐⭐⭐⭐⭐</small>
                    </div>
                </div>
                <p class="small text-muted mb-0">"Sangat terbantu! Biasanya bingung pilih laundry yang cepat, sekarang tinggal geser slider langsung ketemu yang pas."</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 card-hover">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://ui-avatars.com/api/?name=Uswatun+Khasanah&background=faedcd&color=d4a373" class="rounded-circle me-3" width="50">
                    <div>
                        <h6 class="fw-bold mb-0">Uswatun Khasanah</h6>
                        <small class="text-warning">⭐⭐⭐⭐⭐</small>
                    </div>
                </div>
                <p class="small text-muted mb-0">"Fitur pesan via WhatsApp-nya rapi banget. Admin laundry langsung paham apa yang saya butuhkan tanpa banyak tanya."</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 p-4 card-hover">
                <div class="d-flex align-items-center mb-3">
                    <img src="https://ui-avatars.com/api/?name=Cahyo+Handoko&background=faedcd&color=d4a373" class="rounded-circle me-3" width="50">
                    <div>
                        <h6 class="fw-bold mb-0">Cahyo Handoko</h6>
                        <small class="text-warning">⭐⭐⭐⭐⭐</small>
                    </div>
                </div>
                <p class="small text-muted mb-0">"Tampilannya cantik dan ringan di HP. Rekomendasi yang diberikan beneran akurat sesuai budget saya."</p>
            </div>
        </div>
    </div>
</div>

<div class="my-5 p-5 rounded-5 text-center shadow-lg position-relative overflow-hidden" 
     style="background: linear-gradient(135deg, var(--dusty-pink), var(--pink)); color: white;">
    <div class="position-relative" style="z-index: 2;">
        <h2 class="fw-bold mb-3">Siap Mencuci Hari Ini?</h2>
        <p class="mb-4 opacity-75">Dapatkan pengalaman laundry terbaik dengan mitra terpercaya kami di Bekasi.</p>
        <a href="pelanggan/view.php" class="btn btn-light btn-lg rounded-pill px-5 fw-bold" style="color: var(--dusty-pink);">Cari Sekarang</a>
    </div>
    <div class="position-absolute top-0 start-0 translate-middle" style="width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%;"></div>
    <div class="position-absolute bottom-0 end-0 translate-middle-y" style="width: 150px; height: 150px; background: rgba(255,255,255,0.1); border-radius: 50%; margin-right: -50px;"></div>
</div>

<hr style="border-color: var(--soft-pink); opacity: 0.5;">

<style>
#cara-kerja, #testimoni {
    scroll-margin-top: 100px;
}
.card-hover {
    transition: all 0.3s ease;
}
.card-hover:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1) !important;
}

:root {
    --pink: #e29578;
    --dusty-pink: #d4a373;
    --soft-pink: #faedcd;
}
</style>

<?php include 'includes/footer.php'; ?>