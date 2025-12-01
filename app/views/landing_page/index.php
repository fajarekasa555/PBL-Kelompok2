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

        .riset-subtitle {
            display: block;
            font-size: 0.95rem;
            color: #555;
            margin-bottom: 15px;
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

        .section-tim .team-card {
            position: relative;
        }

        .section-tim .team-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(76, 175, 80, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 15px;
            pointer-events: none;
        }

        .section-tim .team-card:hover::before {
            opacity: 1;
        }

        .section-tim .team-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 50px rgba(0,0,0,0.3) !important;
        }

        .section-tim .team-card:hover img {
            transform: scale(1.05);
        }

        /* Ketua card special styling */
        .section-tim .ketua-card {
            border: 2px solid var(--accent-color);
        }

        .section-tim .ketua-card:hover {
            border-color: var(--secondary-color);
            box-shadow: 0 20px 50px rgba(76, 175, 80, 0.3) !important;
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

        /* Search box styling */
        .search-box {
            position: relative;
        }

        .search-box i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            z-index: 1;
        }

        #searchPublikasi:focus,
        #filterYear:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(76, 175, 80, 0.25);
        }

        #resetFilter:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
        }

        /* Pagination styling */
        .pagination .page-item .page-link {
            color: var(--primary-color);
            border: 2px solid #e0e0e0;
            margin: 0 3px;
            border-radius: 8px;
            padding: 0.5rem 0.75rem;
            font-weight: 600;
            transition: all 0.3s;
        }

        .pagination .page-item.active .page-link {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }

        .pagination .page-item .page-link:hover {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
            transform: translateY(-2px);
        }

        .pagination .page-item.disabled .page-link {
            color: #ccc;
            border-color: #e0e0e0;
        }

        /* Animation for filtered items */
        .publikasi-item {
            transition: all 0.3s ease;
        }

        .publikasi-item.hiding {
            opacity: 0;
            transform: scale(0.9);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .publikasi-controls .col-md-6,
            .publikasi-controls .col-md-3 {
                width: 100%;
            }
            
            #searchPublikasi {
                font-size: 14px;
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
                    <li class="nav-item"><a class="nav-link" href="#matkul">MATA KULIAH</a></li>
                    <!-- <li class="nav-item">
                        <button class="btn btn-login">LOGIN</button>
                    </li> -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="container">
            <div class="row align-items-center hero-content">
                <div class="col-lg-6">
                    <h1 class="hero-title"><?= $lab_information['hero_title'] ?? '' ?></h1>
                    <p class="hero-subtitle"><?= $lab_information['hero_subtitle'] ?? '' ?></p>
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
                    <h2 class="section-title"><?= $lab_information['about_title'] ?? '' ?></h2>
                    <h3 class="section-subtitle"><?= $lab_information['about_subtitle'] ?? '' ?></h3>
                    <p style="font-size: 1.1rem; line-height: 1.8;">
                        <span class="highlight-text"><?= $lab_information['about_highlight'] ?? '' ?></span> <?= $lab_information['about_description'] ?? '' ?>
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
            <h2 class="section-title text-center scroll-animate" style="color: white;"><?= $lab_information['visi_title'] ?? '' ?></h2>
            <p class="text-center mb-5 scroll-animate" style="font-size: 1.2rem;"><?= $lab_information['visi_subtitle'] ?? '' ?></p>
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
                <?php if(isset($research_focuses)) { 
                    $research_icons = ['fa-brain', 'fa-network-wired', 'fa-robot', 'fa-chart-line', 'fa-database', 'fa-code'];
                    $icon_index = 0;
                    foreach($research_focuses as $research) { 
                        $icon = $research_icons[$icon_index % count($research_icons)];
                        $icon_index++;
                ?>
                    <div class="col-md-4">
                        <div class="riset-card scroll-scale">
                            <div class="riset-icon"><i class="fas <?= $icon ?>"></i></div>
                            <h5 class="riset-title"><?= htmlspecialchars($research['title']) ?></h5>
                            <b class="riset-subtitle"><?= htmlspecialchars($research['field']) ?></b>
                            <p><?= htmlspecialchars($research['description']) ?></p>
                        </div>
                    </div>
                <?php } ?>
            <?php } ?>
        </div>
    </section>

    <!-- Kegiatan Section -->
    <section id="kegiatan" class="section-kegiatan">
        <div class="container">
            <h2 class="section-title text-center scroll-animate">Kegiatan dan Proyek</h2>
            <h3 class="section-subtitle text-center mb-5 scroll-animate">Laboratorium</h3>
            <div class="row">
                <?php if(isset($activities)) { 
                    foreach($activities as $activity) {
                ?>

                <div class="col-md-4">
                    <div class="card activity-card scroll-scale">
                        <img src="public/<?= htmlspecialchars($activity['documentation']) ?>" alt="Data Analysis">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--primary-color); font-weight: 600;"><?= htmlspecialchars($activity['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($activity['description']) ?></p>
                        </div>
                    </div>
                </div>
                <?php }
                } ?>
                <?php if(isset($projects)) { 
                    foreach($projects as $project) {
                ?>
                <div class="col-md-4">
                    <div class="card activity-card scroll-scale">
                        <img src="public/<?= htmlspecialchars($project['documentation']) ?>" alt="Research">
                        <div class="card-body">
                            <h5 class="card-title" style="color: var(--primary-color); font-weight: 600;"><?= htmlspecialchars($project['name']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($project['description']) ?></p>
                        </div>
                    </div>
                </div>
                <?php }
                } ?>
            </div>
        </div>
    </section>

    <!-- Tim Section -->
    <section id="tim" class="section-tim">
        <div class="container">
            <!-- Section Header -->
            <h2 class="section-title text-center scroll-animate" style="color: white;">Anggota Tim</h2>
            <p class="text-center mb-5 scroll-animate" style="font-size: 1.2rem;">Tim ahli dan peneliti kami</p>

            <?php 
            $ketua = null;
            $anggota = [];

            foreach ($members as $m) {
                if (strtolower($m['jabatan']) === 'ketua') {
                    $ketua = $m;
                } else {
                    $anggota[] = $m;
                }
            }
            ?>

            <!-- Ketua Card -->
            <?php if ($ketua): ?>
            <div class="row justify-content-center mb-5">
                <div class="col-lg-4 col-md-6">
                    <div class="team-card ketua-card scroll-scale">
                        <!-- Badge Ketua -->
                        <div style="
                            position: absolute;
                            top: 15px;
                            right: 15px;
                            background: var(--accent-color);
                            color: white;
                            padding: 0.4rem 1rem;
                            border-radius: 20px;
                            font-size: 0.85rem;
                            font-weight: 600;
                            z-index: 5;
                            box-shadow: 0 4px 10px rgba(76, 175, 80, 0.4);
                        ">
                            <i class="fas fa-star mr-1"></i>KETUA
                        </div>

                        <!-- Photo -->
                        <img src="public/<?= htmlspecialchars($ketua['photo']) ?>" alt="<?= htmlspecialchars($ketua['name']) ?>">

                        <!-- Info -->
                        <div class="team-info">
                            <h4 class="team-name" style="font-size: 1.4rem; font-weight: 600;">
                                <?= htmlspecialchars($ketua['title_prefix']) . ' ' . htmlspecialchars($ketua['name']) . ' ' . htmlspecialchars($ketua['title_suffix']) ?>
                            </h4>
                            <p class="team-position" style="font-weight: 500;">
                                <?= htmlspecialchars($ketua['jabatan']) ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Anggota Cards -->
            <div class="row justify-content-center">
                <?php foreach ($anggota as $member): ?>
                <div class="col-md-4">
                    <div class="team-card scroll-scale">
                        <img src="public/<?= htmlspecialchars($member['photo']) ?>" alt="<?= htmlspecialchars($member['name']) ?>">
                        <div class="team-info">
                            <h5 class="team-name"><?= htmlspecialchars($member['title_prefix']) . ' ' . htmlspecialchars($member['name']) . ' ' . htmlspecialchars($member['title_suffix']) ?></h5>
                            <p class="team-position"><?= htmlspecialchars($member['jabatan']) ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
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
        <?php foreach ($facilities as $key => $facility) { ?>
            <div class="facility-item scroll-scale">
                <img src="public/<?= htmlspecialchars($facility['image']) ?>" alt="<?= htmlspecialchars($facility['slug']) ?>">
                <div class="facility-overlay">
                    <div class="facility-number"><?= str_pad($key + 1, 2, '0', STR_PAD_LEFT) ?></div>
                    <h5><?= htmlspecialchars($facility['slug']) ?></h5>
                    <p><?= htmlspecialchars($facility['description']) ?></p>
                </div>
            </div>
        <?php } ?>
        </div>
    </section>

    <!-- Publikasi Section -->
    <section id="publikasi" class="section-publikasi">
        <div class="container">
            <h2 class="section-title text-center scroll-animate">Sorotan</h2>
            <h3 class="section-subtitle text-center mb-5 scroll-animate">Publikasi</h3>
            
            <!-- Filter & Search Section -->
            <div class="publikasi-controls mb-4">
                <div class="row align-items-center">
                    <!-- Search Box -->
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input 
                                type="text" 
                                id="searchPublikasi" 
                                class="form-control" 
                                placeholder="Cari publikasi berdasarkan judul atau deskripsi..."
                                style="
                                    padding-left: 45px;
                                    border: 2px solid #e0e0e0;
                                    border-radius: 25px;
                                    transition: all 0.3s;
                                "
                            >
                        </div>
                    </div>
                    
                    <!-- Year Filter -->
                    <div class="col-md-3 mb-3 mb-md-0">
                        <select 
                            id="filterYear" 
                            class="form-control"
                            style="
                                border: 2px solid #e0e0e0;
                                border-radius: 25px;
                                padding: 0.5rem 1rem;
                                transition: all 0.3s;
                            "
                        >
                            <option value="">Semua Tahun</option>
                            <?php
                            // Get unique years from publications
                            $years = array_unique(array_map(function($pub) {
                                return date('Y', strtotime($pub['date']));
                            }, $publications));
                            rsort($years);
                            foreach ($years as $year):
                            ?>
                            <option value="<?= $year ?>"><?= $year ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <!-- Reset Button -->
                    <div class="col-md-3">
                        <button 
                            id="resetFilter" 
                            class="btn btn-block"
                            style="
                                background: var(--accent-color);
                                color: white;
                                border-radius: 25px;
                                border: none;
                                padding: 0.5rem 1rem;
                                font-weight: 600;
                                transition: all 0.3s;
                            "
                        >
                            <i class="fas fa-redo mr-2"></i>Reset Filter
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Publications Grid -->
            <div class="row" id="publikasiContainer">
                <?php foreach ($publications as $key => $publication): ?>
                <div class="col-md-6 publikasi-item" 
                    data-year="<?= date('Y', strtotime($publication['date'])) ?>"
                    data-title="<?= strtolower(htmlspecialchars($publication['title'])) ?>"
                    data-desc="<?= strtolower(htmlspecialchars($publication['description'])) ?>">
                    <div class="publikasi-card <?php if ($key % 2 == 0) { echo 'scroll-slide-left'; } else { echo 'scroll-slide-right'; } ?>">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <span class="badge-custom"><?= htmlspecialchars(strtoupper($publication['type'])) ?></span>
                            <span style="color: #999; font-size: 0.9rem;">
                                <i class="far fa-calendar-alt mr-1"></i>
                                <?= date('d M Y', strtotime($publication['date'])) ?>
                            </span>
                        </div>
                        <h5 style="color: var(--primary-color); font-weight: 600; margin-bottom: 1rem;">
                            <?= htmlspecialchars($publication['title']) ?>
                        </h5>
                        <p style="color: #666;">
                            <?= htmlspecialchars($publication['description']) ?>
                        </p>
                        <a href="<?= htmlspecialchars($publication['link']) ?>" 
                        style="color: var(--accent-color); font-weight: 600;" 
                        target="_blank" 
                        rel="noopener">
                            Baca selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- No Results Message -->
            <div id="noResults" class="text-center" style="display: none; padding: 3rem 0;">
                <i class="fas fa-search" style="font-size: 4rem; color: #ddd; margin-bottom: 1rem;"></i>
                <h4 style="color: #999;">Tidak ada publikasi yang ditemukan</h4>
                <p style="color: #bbb;">Coba ubah filter atau kata kunci pencarian</p>
            </div>
            
            <!-- Pagination -->
            <nav id="paginationNav" class="mt-5">
                <ul class="pagination justify-content-center" id="pagination" style="flex-wrap: wrap;"></ul>
            </nav>
        </div>
    </section>

    <!-- Mata Kuliah Section -->
    <section id="matkul" class="section-matkul">
        <div class="container">
            <h2 class="section-title text-center scroll-animate">Mata Kuliah</h2>
            <h3 class="section-subtitle text-center mb-5 scroll-animate">Terkait</h3>
            <div class="row">
                <?php foreach ($courses as $course): ?>
                <div class="col-md-4">
                    <div class="riset-card scroll-scale">
                        <div class="riset-icon"><i class="fas fa-code"></i></div>
                        <h5 class="riset-title"><?= htmlspecialchars($course['name']) ?></h5>
                        <p><?= htmlspecialchars($course['description']) ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row footer-content">
                <div class="col-md-4">
                    <h5 class="d-flex align-items-center gap-2">
                        <i> 
                            <img src="<?= $lab_information['logo'] ?>" width="35" height="35" alt="" srcset="" style="object-fit: contain;">
                        </i>
                        DataTech
                    </h5>
                    <p><?= $lab_information['site_name'] ?></p>
                    <p style="font-size: 0.9rem; opacity: 0.8;"><?= $lab_information['tagline'] ?></p>
                </div>
                <div class="col-md-4">
                    <h5>Kontak</h5>
                    <p><i class="fas fa-map-marker-alt mr-2"></i><?= $lab_information['address'] ?></p>
                    <p><i class="fas fa-phone mr-2"></i><?= $lab_information['phone'] ?></p>
                    <p><i class="fas fa-envelope mr-2"></i><?= $lab_information['email'] ?></p>
                </div>
                <div class="col-md-4">
                    <h5>Ikuti Kami</h5>
                    <div class="social-icons">
                        <a href="<?= htmlspecialchars($lab_information['facebook']) ?>" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a>
                        <a href="<?= htmlspecialchars($lab_information['twitter']) ?>" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a>
                        <a href="<?= htmlspecialchars($lab_information['linkedin']) ?>" target="_blank" rel="noopener"><i class="fab fa-linkedin-in"></i></a>
                        <a href="<?= htmlspecialchars($lab_information['instagram']) ?>" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="text-center" style="opacity: 0.7; font-size: 0.9rem;">
                &copy; 2025 Laboratorium Data & Teknologi. All rights reserved.
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
        document.addEventListener('DOMContentLoaded', function() {
            const itemsPerPage = 6;
            let currentPage = 1;
            let filteredItems = [];
            
            const searchInput = document.getElementById('searchPublikasi');
            const yearFilter = document.getElementById('filterYear');
            const resetBtn = document.getElementById('resetFilter');
            const container = document.getElementById('publikasiContainer');
            const noResults = document.getElementById('noResults');
            const pagination = document.getElementById('pagination');
            const paginationNav = document.getElementById('paginationNav');
            
            // Get all publication items
            function getAllItems() {
                return Array.from(document.querySelectorAll('.publikasi-item'));
            }
            
            // Filter publications
            function filterPublications() {
                const searchTerm = searchInput.value.toLowerCase();
                const selectedYear = yearFilter.value;
                const allItems = getAllItems();
                
                filteredItems = allItems.filter(item => {
                    const title = item.dataset.title;
                    const desc = item.dataset.desc;
                    const year = item.dataset.year;
                    
                    const matchesSearch = title.includes(searchTerm) || desc.includes(searchTerm);
                    const matchesYear = !selectedYear || year === selectedYear;
                    
                    return matchesSearch && matchesYear;
                });
                
                currentPage = 1;
                displayPublications();
            }
            
            // Display publications with pagination
            function displayPublications() {
                const allItems = getAllItems();
                
                // Hide all items first
                allItems.forEach(item => {
                    item.style.display = 'none';
                    item.classList.remove('hiding');
                });
                
                if (filteredItems.length === 0) {
                    noResults.style.display = 'block';
                    paginationNav.style.display = 'none';
                    return;
                }
                
                noResults.style.display = 'none';
                paginationNav.style.display = 'block';
                
                // Calculate pagination
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const itemsToShow = filteredItems.slice(startIndex, endIndex);
                
                // Show items for current page
                itemsToShow.forEach((item, index) => {
                    setTimeout(() => {
                        item.style.display = 'block';
                        // Trigger reflow
                        void item.offsetWidth;
                    }, index * 50);
                });
                
                renderPagination();
            }
            
            // Render pagination
            function renderPagination() {
                const totalPages = Math.ceil(filteredItems.length / itemsPerPage);
                pagination.innerHTML = '';
                
                if (totalPages <= 1) {
                    paginationNav.style.display = 'none';
                    return;
                }
                
                paginationNav.style.display = 'block';
                
                // Previous button
                const prevLi = document.createElement('li');
                prevLi.className = `page-item ${currentPage === 1 ? 'disabled' : ''}`;
                prevLi.innerHTML = `<a class="page-link" href="#publikasi"><i class="fas fa-chevron-left"></i></a>`;
                if (currentPage > 1) {
                    prevLi.querySelector('a').onclick = (e) => {
                        e.preventDefault();
                        currentPage--;
                        displayPublications();
                        scrollToSection();
                    };
                }
                pagination.appendChild(prevLi);
                
                // Page numbers
                for (let i = 1; i <= totalPages; i++) {
                    if (
                        i === 1 || 
                        i === totalPages || 
                        (i >= currentPage - 1 && i <= currentPage + 1)
                    ) {
                        const li = document.createElement('li');
                        li.className = `page-item ${i === currentPage ? 'active' : ''}`;
                        li.innerHTML = `<a class="page-link" href="#publikasi">${i}</a>`;
                        li.querySelector('a').onclick = (e) => {
                            e.preventDefault();
                            currentPage = i;
                            displayPublications();
                            scrollToSection();
                        };
                        pagination.appendChild(li);
                    } else if (
                        i === currentPage - 2 || 
                        i === currentPage + 2
                    ) {
                        const li = document.createElement('li');
                        li.className = 'page-item disabled';
                        li.innerHTML = `<a class="page-link">...</a>`;
                        pagination.appendChild(li);
                    }
                }
                
                // Next button
                const nextLi = document.createElement('li');
                nextLi.className = `page-item ${currentPage === totalPages ? 'disabled' : ''}`;
                nextLi.innerHTML = `<a class="page-link" href="#publikasi"><i class="fas fa-chevron-right"></i></a>`;
                if (currentPage < totalPages) {
                    nextLi.querySelector('a').onclick = (e) => {
                        e.preventDefault();
                        currentPage++;
                        displayPublications();
                        scrollToSection();
                    };
                }
                pagination.appendChild(nextLi);
            }
            
            // Scroll to section
            function scrollToSection() {
                document.getElementById('publikasi').scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start' 
                });
            }
            
            // Reset filter
            function resetFilter() {
                searchInput.value = '';
                yearFilter.value = '';
                filterPublications();
            }
            
            // Event listeners
            searchInput.addEventListener('input', filterPublications);
            yearFilter.addEventListener('change', filterPublications);
            resetBtn.addEventListener('click', resetFilter);
            
            // Initialize
            filteredItems = getAllItems();
            displayPublications();
        });
    </script>
</body>
</html>