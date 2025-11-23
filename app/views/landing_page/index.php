<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorium Data & Teknologi</title>
	<link rel="icon" type="image/png" href="public/assets/img/logo/logo-icon.png" />
    <link rel="stylesheet" href="public/assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --primary-color: #0a4275;
            --secondary-color: #7cb342;
            --accent-color: #4caf50;
            --dark-blue: #001a33;
            --light-gray: #f8f9fa;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow-x: hidden;
        }
        
        /* Navbar */
        .navbar-custom {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-blue));
            padding: 1rem 0;
            box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: white !important;
        }
        
        .navbar-custom .nav-link {
            color: rgba(255,255,255,0.9) !important;
            margin: 0 0.5rem;
            transition: all 0.3s;
        }
        
        .navbar-custom .nav-link:hover {
            color: var(--accent-color) !important;
            transform: translateY(-2px);
        }
        
        .btn-login {
            background: var(--accent-color);
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            transition: all 0.3s;
        }
        
        .btn-login:hover {
            background: var(--secondary-color);
            transform: scale(1.05);
        }
        
        /* Hero Section */
        .hero-section {
            background: linear-gradient(rgba(10, 66, 117, 0.85), rgba(0, 26, 51, 0.9)), url('https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1920&h=1080&fit=crop');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: white;
            padding: 120px 0 100px;
            position: relative;
            overflow: hidden;
        }
        
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.05)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            opacity: 0.3;
        }
        
        .hero-content {
            position: relative;
            z-index: 2;
        }
        
        .hero-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            animation: fadeInUp 1s ease;
        }
        
        .hero-subtitle {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0.9;
            animation: fadeInUp 1.2s ease;
        }
        
        .hero-image {
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            animation: fadeInRight 1.5s ease;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        /* Section Tentang */
        .section-tentang {
            padding: 100px 0;
            background: var(--light-gray);
        }
        
        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        .section-subtitle {
            color: var(--accent-color);
            font-size: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .highlight-text {
            color: var(--accent-color);
            font-weight: 600;
        }
        
        /* Visi Misi */
        .section-visi-misi {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary-color), var(--dark-blue));
            color: white;
        }
        
        .visi-misi-card {
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255,255,255,0.2);
            transition: all 0.3s;
        }
        
        .visi-misi-card:hover {
            background: rgba(255,255,255,0.15);
            transform: scale(1.02);
        }
        
        /* Fokus Riset */
        .section-riset {
            padding: 100px 0;
            background: var(--light-gray);
        }
        
        .riset-card {
            background: white;
            border-radius: 15px;
            padding: 2.5rem 2rem;
            text-align: center;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            height: 100%;
            border: 2px solid transparent;
        }
        
        .riset-card:hover {
            border-color: var(--accent-color);
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
        }
        
        .riset-icon {
            font-size: 3rem;
            color: var(--accent-color);
            margin-bottom: 1.5rem;
        }
        
        .riset-title {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }
        
        /* Kegiatan Section */
        .section-kegiatan {
            padding: 100px 0;
            background: white;
        }
        
        .activity-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            margin-bottom: 2rem;
        }
        
        .activity-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.2);
        }
        
        .activity-card img {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }
        
        /* Tim Section */
        .section-tim {
            padding: 100px 0;
            background: linear-gradient(135deg, var(--primary-color), var(--dark-blue));
            color: white;
        }
        
        .team-card {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.2);
            transition: all 0.3s;
            margin-bottom: 2rem;
        }
        
        .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        }
        
        .team-card img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        
        .team-info {
            padding: 1.5rem;
            text-align: center;
        }
        
        .team-name {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }
        
        .team-position {
            color: var(--accent-color);
            font-size: 0.95rem;
        }
        
        /* Fasilitas */
        .section-fasilitas {
            padding: 0;
            background: var(--light-gray);
        }
        
        .facility-header {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-blue));
            padding: 4rem 2rem;
            text-align: center;
            color: white;
        }
        
        .facility-header h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .facility-header p {
            font-size: 1.2rem;
            opacity: 0.9;
            margin: 0;
        }
        
        .facility-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
            margin: 0;
        }
        
        .facility-item {
            position: relative;
            overflow: hidden;
            cursor: pointer;
            height: 350px;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .facility-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
            filter: brightness(0.85);
        }
        
        .facility-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(10, 66, 117, 0.98) 0%, rgba(0, 26, 51, 0.95) 100%);
            color: white;
            padding: 2rem;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            transform: translateY(calc(100% - 80px));
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .facility-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--accent-color);
            transform: scaleX(0);
            transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .facility-number {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 4rem;
            font-weight: 700;
            color: rgba(255, 255, 255, 0.1);
            line-height: 1;
            opacity: 0;
            transform: translateY(-20px);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1) 0.1s;
        }
        
        .facility-icon {
            font-size: 2.5rem;
            color: var(--accent-color);
            margin-bottom: 1rem;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1) 0.2s;
        }
        
        .facility-overlay h5 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            position: relative;
            z-index: 2;
        }
        
        .facility-overlay p {
            font-size: 0.95rem;
            margin: 0;
            opacity: 0;
            line-height: 1.6;
            transform: translateY(20px);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1) 0.3s;
        }
        
        .facility-specs {
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1) 0.4s;
        }
        
        .facility-specs span {
            display: inline-block;
            background: rgba(76, 175, 80, 0.2);
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
        
        /* Hover Effects */
        .facility-item:hover {
            z-index: 10;
            transform: scale(1.05);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }
        
        .facility-item:hover img {
            transform: scale(1.15);
            filter: brightness(0.6);
        }
        
        .facility-item:hover .facility-overlay {
            transform: translateY(0);
        }
        
        .facility-item:hover .facility-overlay::before {
            transform: scaleX(1);
        }
        
        .facility-item:hover .facility-number,
        .facility-item:hover .facility-icon,
        .facility-item:hover .facility-overlay p,
        .facility-item:hover .facility-specs {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Publikasi */
        .section-publikasi {
            padding: 100px 0;
            background: white;
        }
        
        .publikasi-card {
            background: white;
            border: 2px solid var(--accent-color);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            transition: all 0.3s;
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .publikasi-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }
        
        .badge-custom {
            background: var(--accent-color);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 1rem;
            display: inline-block;
        }
        
        /* Mata Kuliah */
        .section-matkul {
            padding: 100px 0;
            background: var(--light-gray);
        }
        
        /* Scroll Animations */
        .scroll-animate {
            opacity: 0;
            transform: translateY(30px);
        }
        
        .scroll-animate.active {
            opacity: 1;
            transform: translateY(0);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        
        .scroll-fade-in {
            opacity: 0;
        }
        
        .scroll-fade-in.active {
            opacity: 1;
            transition: opacity 1s ease;
        }
        
        .scroll-slide-left {
            opacity: 0;
            transform: translateX(-50px);
        }
        
        .scroll-slide-left.active {
            opacity: 1;
            transform: translateX(0);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        
        .scroll-slide-right {
            opacity: 0;
            transform: translateX(50px);
        }
        
        .scroll-slide-right.active {
            opacity: 1;
            transform: translateX(0);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        
        .scroll-scale {
            opacity: 0;
            transform: scale(0.8);
        }
        
        .scroll-scale.active {
            opacity: 1;
            transform: scale(1);
            transition: opacity 0.8s ease, transform 0.8s ease;
        }
        
        /* Pastikan hover tetap berfungsi setelah animasi scroll */
        .scroll-scale.active:hover {
            transform: scale(1.05) !important;
        }
        
        .activity-card.scroll-scale.active {
            transition: all 0.3s ease;
        }
        
        .team-card.scroll-scale.active {
            transition: all 0.3s ease;
        }
        
        .riset-card.scroll-scale.active {
            transition: all 0.3s ease;
        }
        
        .facility-item.scroll-scale.active {
            transition: all 0.3s ease;
        }
        
        /* Footer */
        .footer {
            background: linear-gradient(135deg, var(--dark-blue), var(--primary-color));
            color: white;
            padding: 3rem 0 1rem;
        }
        
        .footer-content {
            margin-bottom: 2rem;
        }
        
        .footer h5 {
            color: var(--accent-color);
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .footer a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .footer a:hover {
            color: var(--accent-color);
            padding-left: 5px;
        }
        
        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            text-align: center;
            line-height: 40px;
            margin-right: 10px;
            transition: all 0.3s;
        }
        
        .social-icons a:hover {
            background: var(--accent-color);
            transform: translateY(-3px);
        }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .facility-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .hero-title {
                font-size: 2rem;
            }
            
            .hero-subtitle {
                font-size: 1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .facility-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .facility-item {
                height: 300px;
            }
            
            .facility-header h2 {
                font-size: 2rem;
            }
            
            .facility-overlay {
                padding: 1.5rem;
            }
            
            .facility-number {
                font-size: 3rem;
                top: 1rem;
                right: 1rem;
            }
        }
        
        @media (max-width: 480px) {
            .facility-grid {
                grid-template-columns: 1fr;
            }
            
            .facility-item {
                height: 250px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-custom fixed-top">
        <div class="container">
           <a class="navbar-brand d-flex align-items-center gap-2" href="#">
                <img 
                    src="public/assets/img/logo/logo-icon.png" 
                    alt="DataLab Logo" 
                    width="36" 
                    height="36"
                    style="object-fit: contain;"
                >
                <span class="font-weight-bold" style="font-size: 1.2rem; letter-spacing: .5px;">
                    DataTech
                </span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" style="background: rgba(255,255,255,0.2);">
                <i class="fas fa-bars" style="color: white;"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">HOME</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tentang">TENTANG</a></li>
                    <li class="nav-item"><a class="nav-link" href="#visi-misi">VISI & MISI</a></li>
                    <li class="nav-item"><a class="nav-link" href="#riset">RISET</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kegiatan">KEGIATAN</a></li>
                    <li class="nav-item"><a class="nav-link" href="#tim">TIM</a></li>
                    <li class="nav-item"><a class="nav-link" href="#fasilitas">FASILITAS</a></li>
                    <li class="nav-item"><a class="nav-link" href="#publikasi">PUBLIKASI</a></li>
                    <li class="nav-item">
                        <button class="btn btn-login">LOGIN</button>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center hero-content">
                <div class="col-lg-6">
                    <h1 class="hero-title">Laboratorium Data & Teknologi</h1>
                    <p class="hero-subtitle">Membangun masa depan dengan inovasi teknologi dan analisis data</p>
                    <button class="btn btn-login btn-lg">
                        <i class="fas fa-arrow-right mr-2"></i>Pelajari Lebih Lanjut
                    </button>
                </div>
                <div class="col-lg-6">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=800&h=600&fit=crop" alt="Lab Team" class="img-fluid hero-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang Section -->
    <section id="tentang" class="section-tentang">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 scroll-slide-left">
                    <h2 class="section-title">Tentang</h2>
                    <h3 class="section-subtitle">Laboratorium Data & Teknologi</h3>
                    <p style="font-size: 1.1rem; line-height: 1.8;">
                        <span class="highlight-text">Laboratorium Data & Teknologi</span> adalah laboratorium yang 
                        berfokus pada pengembangan kapasitas mahasiswa dalam bidang analisis data, teknologi informasi, 
                        dan inovasi digital. Kami berkomitmen untuk menciptakan lingkungan pembelajaran yang mendukung 
                        riset dan pengembangan teknologi terkini.
                    </p>
                </div>
                <div class="col-lg-6 scroll-slide-right">
                    <img src="https://images.unsplash.com/photo-1531482615713-2afd69097998?w=600&h=400&fit=crop" alt="Lab Activities" class="img-fluid rounded shadow-lg">
                </div>
            </div>
        </div>
    </section>

    <!-- Visi Misi Section -->
    <section id="visi-misi" class="section-visi-misi">
        <div class="container">
            <h2 class="section-title text-center scroll-animate" style="color: white;">Visi & Misi</h2>
            <p class="text-center mb-5 scroll-animate" style="font-size: 1.2rem;">Arah dan tujuan kami dalam mengembangkan teknologi dan pendidikan</p>
            <div class="row">
                <div class="col-md-12">
                    <?php foreach ($visions as $vision): ?>
                    <div class="visi-misi-card scroll-slide-left">
                        <h4 style="color: var(--accent-color); margin-bottom: 1rem;"><i class="fas fa-eye mr-2"></i>Visi</h4>
                        <p style="line-height: 1.8;"><?= htmlspecialchars($vision['vision']) ?></p>
                    </div>
                    <?php endforeach; ?>
                </div>
                <div class="col-md-12">
                    <div class="visi-misi-card scroll-slide-right">
                        <h4 style="color: var(--accent-color); margin-bottom: 1rem;"><i class="fas fa-bullseye mr-2"></i>Misi</h4>
                        <ul style="line-height: 2;">
                            <?php foreach ($missions as $mission): ?>
                            <li><?= htmlspecialchars($mission['mission']) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fokus Riset Section -->
    <section id="riset" class="section-riset">
        <div class="container">
            <h2 class="section-title text-center scroll-animate">Fokus Riset</h2>
            <h3 class="section-subtitle text-center mb-5 scroll-animate">Laboratorium</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="riset-card scroll-scale">
                        <div class="riset-icon"><i class="fas fa-brain"></i></div>
                        <h5 class="riset-title">Machine Learning</h5>
                        <p>Pengembangan algoritma pembelajaran mesin untuk berbagai aplikasi</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="riset-card scroll-scale">
                        <div class="riset-icon"><i class="fas fa-chart-line"></i></div>
                        <h5 class="riset-title">Big Data Analytics</h5>
                        <p>Analisis data berskala besar untuk insight bisnis dan riset</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="riset-card scroll-scale">
                        <div class="riset-icon"><i class="fas fa-network-wired"></i></div>
                        <h5 class="riset-title">IoT & Smart Systems</h5>
                        <p>Pengembangan sistem cerdas berbasis Internet of Things</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Kegiatan Section -->
    <section id="kegiatan" class="section-kegiatan">
        <div class="container">
            <h2 class="section-title text-center scroll-animate">Kegiatan dan Proyek</h2>
            <h3 class="section-subtitle text-center mb-5 scroll-animate">Laboratorium</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="card activity-card scroll-scale">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=400&h=250&fit=crop" alt="Data Analysis">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--primary-color); font-weight: 600;">Analisis Data</h5>
                            <p class="card-text">Workshop dan pelatihan analisis data menggunakan tools modern</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card activity-card scroll-scale">
                        <img src="https://images.unsplash.com/photo-1504384308090-c894fdcc538d?w=400&h=250&fit=crop" alt="Research">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--primary-color); font-weight: 600;">Riset & Pengembangan</h5>
                            <p class="card-text">Proyek riset bersama dosen dan mahasiswa dalam teknologi terkini</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card activity-card scroll-scale">
                        <img src="https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?w=400&h=250&fit=crop" alt="Collaboration">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--primary-color); font-weight: 600;">Kolaborasi</h5>
                            <p class="card-text">Kerjasama dengan industri dan institusi pendidikan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tim Section -->
    <section id="tim" class="section-tim">
        <div class="container">
            <h2 class="section-title text-center scroll-animate" style="color: white;">Anggota Tim</h2>
            <p class="text-center mb-5 scroll-animate" style="font-size: 1.2rem;">Tim ahli dan peneliti kami</p>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="team-card scroll-scale">
                        <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?w=300&h=250&fit=crop" alt="Team Member">
                        <div class="team-info">
                            <h5 class="team-name">Dr. Ahmad Wijaya</h5>
                            <p class="team-position">Kepala Laboratorium</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-card scroll-scale">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?w=300&h=250&fit=crop" alt="Team Member">
                        <div class="team-info">
                            <h5 class="team-name">Sarah Putri, M.Kom</h5>
                            <p class="team-position">Koordinator Riset</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="team-card scroll-scale">
                        <img src="https://images.unsplash.com/photo-1556157382-97eda2d62296?w=300&h=250&fit=crop" alt="Team Member">
                        <div class="team-info">
                            <h5 class="team-name">Budi Santoso, M.T</h5>
                            <p class="team-position">Asisten Peneliti</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Fasilitas Section -->
    <section id="fasilitas" class="section-fasilitas">
        <div class="facility-header">
            <h2>Fasilitas Lab</h2>
            <p>Infrastruktur modern untuk pembelajaran dan riset</p>
        </div>
        
        <div class="facility-grid">
            <!-- Facility 1 -->
            <div class="facility-item scroll-scale">
                <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=600&h=400&fit=crop" alt="Lab Komputer">
                <div class="facility-overlay">
                    <div class="facility-number">01</div>
                    <h5>Lab Komputer</h5>
                    <p>Ruang komputer dengan 40 unit PC high-performance untuk analisis data, programming, dan simulasi.</p>
                </div>
            </div>
            
            <!-- Facility 2 -->
            <div class="facility-item scroll-scale">
                <img src="https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=600&h=400&fit=crop" alt="Server Room">
                <div class="facility-overlay">
                    <div class="facility-number">02</div>
                    <h5>Server Room</h5>
                    <p>Infrastruktur server modern dengan kapasitas besar untuk cloud computing dan big data processing.</p>
                </div>
            </div>
            
            <!-- Facility 3 -->
            <div class="facility-item scroll-scale">
                <img src="https://images.unsplash.com/photo-1518770660439-4636190af475?w=600&h=400&fit=crop" alt="IoT Lab">
                <div class="facility-overlay">
                    <div class="facility-number">03</div>
                    <!-- <div class="facility-icon"><i class="fas fa-server"></i></div> -->
                    <h5>IoT Laboratory</h5>
                    <p>Lab khusus Internet of Things dengan berbagai sensor, microcontroller, dan perangkat embedded systems.</p>
                </div>
            </div>
            
            <!-- Facility 4 -->
            <div class="facility-item scroll-scale">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=400&fit=crop" alt="Collaboration Space">
                <div class="facility-overlay">
                    <div class="facility-number">04</div>
                    <h5>Ruang Kolaborasi</h5>
                    <p>Area diskusi dan kolaborasi modern dengan whiteboard digital untuk tim project dan brainstorming.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Publikasi Section -->
    <section id="publikasi" class="section-publikasi">
        <div class="container">
            <h2 class="section-title text-center scroll-animate">Sorotan</h2>
            <h3 class="section-subtitle text-center mb-5 scroll-animate">Publikasi</h3>
            <div class="row">
                <div class="col-md-6">
                    <div class="publikasi-card scroll-slide-left">
                        <span class="badge-custom">JURNAL</span>
                        <h5 style="color: var(--primary-color); font-weight: 600; margin-bottom: 1rem;">Implementasi Deep Learning untuk Prediksi Cuaca</h5>
                        <p style="color: #666;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a href="#" style="color: var(--accent-color); font-weight: 600;">Baca selengkapnya <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="publikasi-card scroll-slide-right">
                        <span class="badge-custom">KONFERENSI</span>
                        <h5 style="color: var(--primary-color); font-weight: 600; margin-bottom: 1rem;">Optimasi Algoritma Clustering untuk Big Data</h5>
                        <p style="color: #666;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                        <a href="#" style="color: var(--accent-color); font-weight: 600;">Baca selengkapnya <i class="fas fa-arrow-right ml-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mata Kuliah Section -->
    <section id="matkul" class="section-matkul">
        <div class="container">
            <h2 class="section-title text-center scroll-animate">Mata Kuliah</h2>
            <h3 class="section-subtitle text-center mb-5 scroll-animate">Terkait</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="riset-card scroll-scale">
                        <div class="riset-icon"><i class="fas fa-database"></i></div>
                        <h5 class="riset-title">Struktur Data</h5>
                        <p>3 SKS - Semester 3</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="riset-card scroll-scale">
                        <div class="riset-icon"><i class="fas fa-code"></i></div>
                        <h5 class="riset-title">Algoritma & Pemrograman</h5>
                        <p>4 SKS - Semester 2</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="riset-card scroll-scale">
                        <div class="riset-icon"><i class="fas fa-robot"></i></div>
                        <h5 class="riset-title">Kecerdasan Buatan</h5>
                        <p>3 SKS - Semester 6</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row footer-content">
                <div class="col-md-4">
                    <h5><i class="fas fa-flask mr-2"></i>DataLab</h5>
                    <p>Laboratorium Data & Teknologi</p>
                    <p style="font-size: 0.9rem; opacity: 0.8;">Membangun masa depan dengan inovasi teknologi dan analisis data yang berkelanjutan.</p>
                </div>
                <div class="col-md-4">
                    <h5>Kontak</h5>
                    <p><i class="fas fa-map-marker-alt mr-2"></i>Jl. Universitas No. 123, Jakarta</p>
                    <p><i class="fas fa-phone mr-2"></i>+62 21 1234 5678</p>
                    <p><i class="fas fa-envelope mr-2"></i>info@datalab.ac.id</p>
                </div>
                <div class="col-md-4">
                    <h5>Ikuti Kami</h5>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center" style="opacity: 0.7; font-size: 0.9rem;">
                &copy; 2024 Laboratorium Data & Teknologi. All rights reserved.
            </div>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="public/assets/plugins/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    
    <script>
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver(function(entries) {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        document.addEventListener('DOMContentLoaded', function() {
            const animatedElements = document.querySelectorAll(
                '.scroll-animate, .scroll-fade-in, .scroll-slide-left, .scroll-slide-right, .scroll-scale'
            );
            
            animatedElements.forEach(el => {
                observer.observe(el);
            });

            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });
        });
    </script>
</body>
</html>