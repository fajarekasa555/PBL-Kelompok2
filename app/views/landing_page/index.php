<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratorium Data & Teknologi</title>
	<link rel="icon" type="image/png" href="public/assets/img/logo/logo-icon.png" />
    <link rel="stylesheet" href="public/assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css">
	<link href="public/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
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

        /* Publikasi - Minimal Clean Design */
        .section-publikasi {
            padding: 100px 0;
            background: #f8f9fa;
        }

        .publikasi-controls {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            margin-bottom: 3rem;
        }

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

        #searchPublikasi,
        #filterYear {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        #searchPublikasi {
            padding-left: 45px;
        }

        #searchPublikasi:focus,
        #filterYear:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }

        #resetFilter {
            background: var(--accent-color);
            color: white;
            border-radius: 12px;
            border: none;
            padding: 0.75rem 1rem;
            font-weight: 500;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        #resetFilter:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.25);
        }

        /* Publikasi - Modern Clean Design */
        .section-publikasi {
            padding: 100px 0;
            background: #f8f9fa;
        }

        .publikasi-controls {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            margin-bottom: 3rem;
        }

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

        #searchPublikasi {
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            padding-left: 45px;
            transition: all 0.3s;
            font-size: 0.95rem;
            width: 100%;
        }

        #searchPublikasi:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }

        /* Year Filter Pills */
        .year-filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            align-items: center;
        }

        .filter-label {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.9rem;
            margin-right: 0.5rem;
        }

        .year-pill {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1.25rem;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            background: white;
            color: #666;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            user-select: none;
        }

        .year-pill:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.15);
        }

        .year-pill.active {
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
            border-color: var(--accent-color);
            color: white;
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
        }

        .year-pill.active:hover {
            transform: translateY(-2px) scale(1.02);
        }

        .year-pill i {
            margin-right: 0.5rem;
            font-size: 0.85rem;
        }

        #resetFilter {
            background: var(--accent-color);
            color: white;
            border-radius: 12px;
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            transition: all 0.3s;
            font-size: 0.95rem;
        }

        #resetFilter:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.25);
        }

        #resetFilter i {
            margin-right: 0.5rem;
        }

        /* Publikasi Card - Clean & Minimal */
        .publikasi-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0,0,0,0.04);
            border: 1px solid #f0f0f0;
        }

        .publikasi-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
            border-color: var(--accent-color);
        }

        .publikasi-badge {
            display: inline-block;
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .publikasi-date {
            color: #999;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .publikasi-title {
            color: var(--primary-color);
            font-weight: 600;
            font-size: 1.25rem;
            margin: 1rem 0;
            line-height: 1.4;
        }

        .publikasi-desc {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }

        .publikasi-link {
            color: var(--accent-color);
            font-weight: 600;
            font-size: 0.9rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s;
        }

        .publikasi-link:hover {
            gap: 0.75rem;
            color: var(--secondary-color);
        }

        /* Pagination - Clean Design */
        .pagination {
            gap: 0.5rem;
        }

        .pagination .page-item .page-link {
            color: var(--primary-color);
            border: 1px solid #e0e0e0;
            border-radius: 10px;
            padding: 0.6rem 1rem;
            font-weight: 500;
            transition: all 0.3s;
            font-size: 0.9rem;
        }

        .pagination .page-item.active .page-link {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
        }

        .pagination .page-item .page-link:hover:not(.page-item.disabled .page-link) {
            background: var(--accent-color);
            border-color: var(--accent-color);
            color: white;
            transform: translateY(-2px);
        }

        .pagination .page-item.disabled .page-link {
            color: #ccc;
            border-color: #e0e0e0;
            background: #f8f9fa;
        }

        /* No Results */
        #noResults {
            display: none;
            padding: 4rem 0;
        }

        #noResults i {
            font-size: 4rem;
            color: #ddd;
            margin-bottom: 1.5rem;
        }

        #noResults h4 {
            color: #999;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        #noResults p {
            color: #bbb;
        }

        /* Animation */
        .publikasi-item {
            transition: all 0.3s ease;
        }

        .publikasi-item.hiding {
            opacity: 0;
            transform: translateY(20px);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .year-filter-container {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .year-pills-wrapper {
                display: flex;
                flex-wrap: wrap;
                gap: 0.5rem;
            }
            
            .year-pill {
                font-size: 0.85rem;
                padding: 0.4rem 1rem;
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
                    <!-- <button class="btn btn-login btn-lg">
                        <i class="fas fa-arrow-right mr-2"></i>Pelajari Lebih Lanjut
                    </button> -->
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
                    <a href="landing_page/detail_member/<?= htmlspecialchars($ketua['id']) ?>" class="team-card-link">
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
                    </a>
                </div>
            </div>
            <?php endif; ?>

            <!-- Anggota Cards -->
            <div class="row justify-content-center">
                <?php foreach ($anggota as $member): ?>
                <div class="col-md-4">
                    <a href="landing_page/detail_member/<?= htmlspecialchars($member['id']) ?>" class="team-card-link">
                    <div class="team-card scroll-scale">
                        <img src="public/<?= htmlspecialchars($member['photo']) ?>" alt="<?= htmlspecialchars($member['name']) ?>">
                        <div class="team-info">
                            <h5 class="team-name"><?= htmlspecialchars($member['title_prefix']) . ' ' . htmlspecialchars($member['name']) . ' ' . htmlspecialchars($member['title_suffix']) ?></h5>
                            <p class="team-position"><?= htmlspecialchars($member['jabatan']) ?></p>
                        </div>
                    </div>
                    </a>
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
            
            <!-- Filter & Search -->
            <div class="publikasi-controls">
                <!-- Search Box -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input 
                                type="text" 
                                id="searchPublikasi" 
                                class="form-control" 
                                placeholder="Cari publikasi berdasarkan judul atau deskripsi..."
                            >
                        </div>
                    </div>
                </div>
                
                <!-- Year Filter Pills -->
                <div class="row align-items-center">
                    <div class="col-lg-9 mb-3 mb-lg-0">
                        <div class="year-filter-container">
                            <span class="filter-label">
                                <i class="fas fa-calendar-alt mr-2"></i>Filter Tahun:
                            </span>
                            <div class="year-pills-wrapper" id="yearPills">
                                <div class="year-pill active" data-year="">
                                    <i class="fas fa-th"></i>
                                    Semua
                                </div>
                                <?php
                                $years = array_unique(array_map(function($pub) {
                                    return date('Y', strtotime($pub['date']));
                                }, $publications));
                                rsort($years);
                                foreach ($years as $year):
                                ?>
                                <div class="year-pill" data-year="<?= $year ?>">
                                    <?= $year ?>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3">
                        <button id="resetFilter" class="btn btn-block">
                            <i class="fas fa-redo"></i>Reset
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Publications Grid -->
            <div id="publikasiContainer">
                <?php foreach ($publications as $key => $publication): ?>
                <div class="publikasi-item" 
                    data-year="<?= date('Y', strtotime($publication['date'])) ?>"
                    data-title="<?= strtolower(htmlspecialchars($publication['title'])) ?>"
                    data-desc="<?= strtolower(htmlspecialchars($publication['description'])) ?>">
                    <div class="publikasi-card">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="publikasi-badge"><?= htmlspecialchars(strtoupper($publication['type'])) ?></span>
                            <span class="publikasi-date">
                                <?= htmlspecialchars($publication['member_name']) ?>
                                <i class="far fa-calendar-alt"></i>
                                <?= date('d M Y', strtotime($publication['date'])) ?>
                            </span>
                        </div>
                        <h5 class="publikasi-title">
                            <?= htmlspecialchars($publication['title']) ?>
                        </h5>
                        <p class="publikasi-desc">
                            <?= htmlspecialchars($publication['description']) ?>
                        </p>
                        <a href="<?= htmlspecialchars($publication['link']) ?>" 
                        class="publikasi-link" 
                        target="_blank" 
                        rel="noopener">
                            Baca selengkapnya 
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
            
            <!-- No Results -->
            <div id="noResults" class="text-center">
                <i class="fas fa-search"></i>
                <h4>Tidak ada publikasi yang ditemukan</h4>
                <p>Coba ubah filter atau kata kunci pencarian</p>
            </div>
            
            <!-- Pagination -->
            <nav id="paginationNav" class="mt-5">
                <ul class="pagination justify-content-center" id="pagination"></ul>
            </nav>
        </div>
    </section>

    <!-- Mata Kuliah Section -->
    <section id="matkul" class="section-matkul">
        <div class="container">
            <h2 class="section-title text-center scroll-animate">Mata Kuliah</h2>
            <h3 class="section-subtitle text-center mb-5 scroll-animate">Terkait</h3>
            <div class="row">
                <?php $icons = ['fa-chart-line', 'fa-database', 'fa-code']; ?>
                <?php foreach ($courses as $index => $course): ?>
                <div class="col-md-4">
                    <div class="riset-card scroll-scale">
                        <div class="riset-icon"><i class="fas <?= $icons[$index % count($icons)] ?>"></i></div>
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
	<script src="public/assets/plugins/select2/dist/js/select2.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            });
        });
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
            const itemsPerPage = 4;
            let currentPage = 1;
            let filteredItems = [];
            let selectedYear = '';
            
            const searchInput = document.getElementById('searchPublikasi');
            const resetBtn = document.getElementById('resetFilter');
            const yearPills = document.querySelectorAll('.year-pill');
            const container = document.getElementById('publikasiContainer');
            const noResults = document.getElementById('noResults');
            const pagination = document.getElementById('pagination');
            const paginationNav = document.getElementById('paginationNav');
            
            // Year pill click handler
            yearPills.forEach(pill => {
                pill.addEventListener('click', function() {
                    // Remove active from all pills
                    yearPills.forEach(p => p.classList.remove('active'));
                    
                    // Add active to clicked pill
                    this.classList.add('active');
                    
                    // Set selected year
                    selectedYear = this.dataset.year;
                    
                    // Filter publications
                    filterPublications();
                });
            });
            
            function getAllItems() {
                return Array.from(document.querySelectorAll('.publikasi-item'));
            }
            
            function filterPublications() {
                const searchTerm = searchInput.value.toLowerCase();
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
            
            function displayPublications() {
                const allItems = getAllItems();
                
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
                
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const itemsToShow = filteredItems.slice(startIndex, endIndex);
                
                itemsToShow.forEach((item, index) => {
                    setTimeout(() => {
                        item.style.display = 'block';
                    }, index * 80);
                });
                
                renderPagination();
            }
            
            function renderPagination() {
                const totalPages = Math.ceil(filteredItems.length / itemsPerPage);
                pagination.innerHTML = '';
                
                if (totalPages <= 1) {
                    paginationNav.style.display = 'none';
                    return;
                }
                
                paginationNav.style.display = 'block';
                
                // Previous
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
                
                // Pages
                for (let i = 1; i <= totalPages; i++) {
                    if (i === 1 || i === totalPages || (i >= currentPage - 1 && i <= currentPage + 1)) {
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
                    } else if (i === currentPage - 2 || i === currentPage + 2) {
                        const li = document.createElement('li');
                        li.className = 'page-item disabled';
                        li.innerHTML = `<a class="page-link">...</a>`;
                        pagination.appendChild(li);
                    }
                }
                
                // Next
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
            
            function scrollToSection() {
                document.getElementById('publikasi').scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start' 
                });
            }
            
            function resetFilter() {
                searchInput.value = '';
                selectedYear = '';
                
                // Reset pills
                yearPills.forEach(p => p.classList.remove('active'));
                yearPills[0].classList.add('active'); // Activate "Semua"
                
                filterPublications();
            }
            
            searchInput.addEventListener('input', filterPublications);
            resetBtn.addEventListener('click', resetFilter);
            
            filteredItems = getAllItems();
            displayPublications();
        });
    </script>
</body>
</html>