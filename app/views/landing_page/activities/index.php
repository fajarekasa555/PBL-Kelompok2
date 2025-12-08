<!DOCTYPE html>
<html lang="id">
<head>
    <?php
        use App\Helpers\Routing;
        $route = new Routing();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan & Proyek - Laboratorium Data & Teknologi</title>
    <link rel="icon" type="image/png" href="<?= $route->base_url('public/assets/img/logo/logo-icon.png') ?>" />
    <link rel="stylesheet" href="<?= $route->base_url('public/assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
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
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            padding-top: 70px;
            position: relative;
            overflow-x: hidden;
        }
        
        /* Background Animation */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="rgba(255,255,255,0.03)" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            opacity: 0.5;
            animation: float 20s ease-in-out infinite;
            pointer-events: none;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }
        
        /* Navbar Sederhana */
        .navbar-simple {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-blue));
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            animation: slideDown 0.6s ease;
            transition: all 0.3s ease;
        }
        
        .navbar-simple.scrolled {
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-100%);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .navbar-simple .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            text-decoration: none;
            font-size: 1.3rem;
            font-weight: 700;
            transition: all 0.3s ease;
        }
        
        .navbar-brand:hover {
            color: white;
            transform: translateY(-2px);
            text-decoration: none;
        }
        
        .navbar-brand img {
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover img {
            transform: rotate(10deg) scale(1.1);
        }
        
        .btn-back {
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 0.6rem 1.75rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
        }
        
        .btn-back:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
            color: white;
            text-decoration: none;
        }
        
        .btn-back i {
            transition: transform 0.3s ease;
        }
        
        .btn-back:hover i {
            transform: translateX(-3px);
        }
        
        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-blue));
            color: white;
            padding: 4rem 0 3rem;
            /* margin-top: 70px; */
            margin-bottom: 2rem;
            text-align: center;
            position: relative;
            overflow: hidden;
            animation: slideUp 0.6s ease;
        }
        
        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Animated Background Pattern */
        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(255,255,255,0.15) 0%, transparent 70%);
            border-radius: 50%;
            animation: float-bubble 8s ease-in-out infinite;
        }
        
        .page-header::after {
            content: '';
            position: absolute;
            bottom: -30%;
            left: -5%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(76, 175, 80, 0.2) 0%, transparent 70%);
            border-radius: 50%;
            animation: float-bubble 10s ease-in-out infinite reverse;
        }
        
        @keyframes float-bubble {
            0%, 100% { 
                transform: translate(0, 0) scale(1);
                opacity: 0.5;
            }
            50% { 
                transform: translate(30px, -30px) scale(1.1);
                opacity: 0.8;
            }
        }
        
        /* Decorative Icons */
        .page-header-decoration {
            position: absolute;
            font-size: 3rem;
            opacity: 0.1;
            animation: float-icon 6s ease-in-out infinite;
        }
        
        .decoration-1 {
            top: 15%;
            left: 10%;
            animation-delay: 0s;
        }
        
        .decoration-2 {
            top: 30%;
            right: 15%;
            animation-delay: 1s;
        }
        
        .decoration-3 {
            bottom: 20%;
            left: 15%;
            animation-delay: 2s;
        }
        
        .decoration-4 {
            bottom: 25%;
            right: 10%;
            animation-delay: 3s;
        }
        
        @keyframes float-icon {
            0%, 100% { 
                transform: translateY(0) rotate(0deg);
            }
            50% { 
                transform: translateY(-20px) rotate(5deg);
            }
        }
        
        .page-header .container {
            position: relative;
            text-align: center;
            z-index: 2;
        }
        
        /* Breadcrumb */
        .page-breadcrumb {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .page-breadcrumb a {
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .page-breadcrumb a:hover {
            color: var(--accent-color);
            transform: translateX(-3px);
        }
        
        .page-breadcrumb i {
            font-size: 0.75rem;
        }
        
        .page-breadcrumb span {
            color: var(--accent-color);
            font-weight: 600;
        }
        
        /* Title with underline effect */
        .page-title {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            position: relative;
            display: inline-block;
            padding-bottom: 1rem;
        }
        
        .page-title::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 120px;
            height: 4px;
            background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
            border-radius: 2px;
            animation: glow 2s ease-in-out infinite;
        }
        
        @keyframes glow {
            0%, 100% {
                opacity: 0.6;
                box-shadow: 0 0 10px var(--accent-color);
            }
            50% {
                opacity: 1;
                box-shadow: 0 0 20px var(--accent-color);
            }
        }
        
        .page-subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            margin: 0 auto;
            max-width: 600px;
            line-height: 1.6;
        }
        
        /* Stats Counter */
        .page-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            margin-top: 2.5rem;
            flex-wrap: wrap;
        }
        
        .stat-item {
            text-align: center;
            position: relative;
        }
        
        .stat-item::after {
            content: '';
            position: absolute;
            right: -1.5rem;
            top: 50%;
            transform: translateY(-50%);
            width: 1px;
            height: 40px;
            background: rgba(255, 255, 255, 0.3);
        }
        
        .stat-item:last-child::after {
            display: none;
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--accent-color);
            display: block;
            line-height: 1;
            margin-bottom: 0.5rem;
        }
        
        .stat-label {
            font-size: 0.9rem;
            opacity: 0.9;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        /* Icon with animation */
        .page-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            display: inline-block;
            background: rgba(255, 255, 255, 0.1);
            width: 100px;
            height: 100px;
            line-height: 100px;
            border-radius: 50%;
            backdrop-filter: blur(10px);
            animation: pulse-icon 2s ease-in-out infinite;
        }
        
        @keyframes pulse-icon {
            0%, 100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(76, 175, 80, 0.7);
            }
            50% {
                transform: scale(1.05);
                box-shadow: 0 0 0 20px rgba(76, 175, 80, 0);
            }
        }
        
        /* Main Container */
        .main-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 1rem 4rem;
            position: relative;
            z-index: 1;
        }
        
        /* Filter Section */
        .filter-section {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 4px 20px rgba(10, 66, 117, 0.08);
            margin-bottom: 2rem;
            animation: fadeIn 0.6s ease 0.2s both;
            border: 1px solid rgba(10, 66, 117, 0.05);
            position: relative;
            overflow: hidden;
        }
        
        .filter-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .filter-tabs {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }
        
        .filter-tab {
            padding: 0.75rem 2rem;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            background: white;
            color: #666;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .filter-tab:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.2);
        }
        
        .filter-tab.active {
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
            border-color: var(--accent-color);
            color: white;
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
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
        
        .search-box input {
            width: 100%;
            padding: 0.875rem 1.25rem 0.875rem 3rem;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        
        .search-box input:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.1);
        }
        
        /* Activity/Project Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
            animation: fadeIn 0.6s ease 0.4s both;
        }
        
        .activity-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(10, 66, 117, 0.08);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: 1px solid rgba(10, 66, 117, 0.05);
            height: 100%;
            display: flex;
            flex-direction: column;
            position: relative;
        }
        
        .activity-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }
        
        .activity-card:hover::before {
            transform: scaleX(1);
        }
        
        .activity-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(10, 66, 117, 0.15);
        }
        
        .card-image {
            width: 100%;
            height: 260px;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .activity-card:hover .card-image {
            transform: scale(1.08);
        }
        
        .card-image-wrapper {
            overflow: hidden;
            position: relative;
            background: #f0f0f0;
        }
        
        .card-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 0.6rem 1.4rem;
            border-radius: 25px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            z-index: 2;
            backdrop-filter: blur(10px);
        }
        
        .card-badge.activity {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.5);
        }
        
        .card-badge.project {
            background: linear-gradient(135deg, #2196F3, #42A5F5);
            color: white;
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.5);
        }
        
        .card-content {
            padding: 1.75rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .card-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 3rem;
        }
        
        .card-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }
        
        .card-meta {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            font-size: 0.88rem;
            color: #777;
            padding-top: 1.5rem;
            border-top: 2px solid #f5f5f5;
            margin-top: auto;
        }
        
        .card-meta-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        
        .card-meta-item i {
            color: var(--accent-color);
            font-size: 0.9rem;
            width: 18px;
            text-align: center;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 6rem 2rem;
            animation: fadeIn 0.6s ease;
        }
        
        .empty-state i {
            font-size: 5rem;
            color: #e0e0e0;
            margin-bottom: 1.5rem;
        }
        
        .empty-state h4 {
            color: #999;
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .empty-state p {
            color: #bbb;
            font-size: 1rem;
        }
        
        /* Custom SweetAlert2 Styling */
        .swal2-popup {
            border-radius: 20px !important;
            padding: 2rem !important;
        }
        
        .swal2-title {
            color: var(--primary-color) !important;
            font-size: 1.75rem !important;
            font-weight: 700 !important;
        }
        
        .swal2-html-container {
            max-height: 60vh;
            overflow-y: auto;
            text-align: left;
        }
        
        .detail-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 1.5rem;
        }
        
        .detail-section {
            margin-bottom: 1.5rem;
        }
        
        .detail-label {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .detail-label i {
            color: var(--accent-color);
        }
        
        .detail-value {
            color: #555;
            line-height: 1.7;
            font-size: 0.95rem;
        }
        
        .members-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .member-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: #f8f9fa;
            padding: 0.75rem;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
        }
        
        .member-avatar,
        .member-avatar-placeholder {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        
        .member-avatar {
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .member-avatar-placeholder {
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .member-info {
            flex: 1;
            min-width: 0;
        }
        
        .member-name {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .member-role {
            font-size: 0.75rem;
            color: #777;
        }
        
        /* Loading overlay - untuk mencegah kedip-kedip */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 9999;
            opacity: 1;
            transition: opacity 0.3s ease;
        }
        
        .loading-overlay.hidden {
            opacity: 0;
            pointer-events: none;
        }
        
        .spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid var(--accent-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding-top: 80px;
            }
            
            .navbar-simple {
                padding: 1rem 0;
            }
            
            .navbar-simple .container {
                padding: 0 1rem;
            }
            
            .page-title {
                font-size: 2rem;
                padding-bottom: 0.75rem;
            }
            
            .page-title::after {
                width: 80px;
                height: 3px;
            }
            
            .page-subtitle {
                font-size: 1rem;
            }
            
            .page-icon {
                font-size: 3rem;
                width: 80px;
                height: 80px;
                line-height: 80px;
            }
            
            .page-header {
                padding: 3.5rem 0 2.5rem;
                margin-bottom: 2rem;
            }
            
            .page-stats {
                gap: 2rem;
                margin-top: 2rem;
            }
            
            .stat-number {
                font-size: 2rem;
            }
            
            .stat-label {
                font-size: 0.8rem;
            }
            
            .stat-item::after {
                display: none;
            }
            
            .page-header-decoration {
                font-size: 2rem;
            }
            
            .main-container {
                padding: 0 1rem 2rem;
            }
            
            .cards-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .filter-section {
                padding: 1.5rem;
            }
            
            .filter-tabs {
                flex-direction: row;
                justify-content: space-between;
            }
            
            .filter-tab {
                flex: 1;
                text-align: center;
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
                justify-content: center;
            }
            
            .members-grid {
                grid-template-columns: 1fr;
            }
            
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .card-content {
                padding: 1.5rem;
            }
            
            .card-title {
                font-size: 1.2rem;
            }
        }
        
        @media (max-width: 480px) {
            .main-container {
                padding: 0 1rem 1.5rem;
            }
            
            .filter-section {
                padding: 1.25rem;
            }
            
            .filter-tab {
                font-size: 0.7rem;
                padding: 0.5rem 0.4rem;
            }
            
            .filter-tab i {
                display: none;
            }
            
            .btn-back span {
                display: none;
            }
            
            .page-header {
                padding: 2rem 0 1.5rem;
            }
            
            .page-title {
                font-size: 1.5rem;
            }
            
            .page-subtitle {
                font-size: 0.9rem;
            }
            
            .stat-number {
                font-size: 1.5rem;
            }
            
            .stat-label {
                font-size: 0.7rem;
            }
        }
        
        /* Navbar Sederhana */
        .navbar-simple {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-blue));
            padding: 1rem 0;
            box-shadow: 0 2px 20px rgba(0,0,0,0.15);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        
        .navbar-simple .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .navbar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            text-decoration: none;
            font-size: 1.4rem;
            font-weight: 700;
            transition: all 0.3s ease;
        }
        
        .navbar-brand:hover {
            color: white;
            transform: translateY(-2px);
            text-decoration: none;
        }
        
        .navbar-brand img {
            transition: transform 0.3s ease;
        }
        
        .navbar-brand:hover img {
            transform: rotate(10deg) scale(1.1);
        }
        
        .btn-back {
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 0.5rem 1.5rem;
            border-radius: 25px;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-back:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
            color: white;
            text-decoration: none;
        }
        
        .btn-back i {
            transition: transform 0.3s ease;
        }
        
        .btn-back:hover i {
            transform: translateX(-3px);
        }
        
        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--dark-blue));
            color: white;
            top: 0;
            padding: 3rem 0 2rem;
            margin-bottom: 3rem;
            text-align: center;
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .page-subtitle {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        /* Filter Section */
        .filter-section {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            margin-bottom: 2rem;
        }
        
        .filter-tabs {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }
        
        .filter-tab {
            padding: 0.75rem 2rem;
            border: 2px solid #e0e0e0;
            border-radius: 25px;
            background: white;
            color: #666;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .filter-tab:hover {
            border-color: var(--accent-color);
            color: var(--accent-color);
            transform: translateY(-2px);
        }
        
        .filter-tab.active {
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
            border-color: var(--accent-color);
            color: white;
            box-shadow: 0 4px 12px rgba(76, 175, 80, 0.3);
        }
        
        .search-box {
            position: relative;
            margin-top: 1.5rem;
        }
        
        .search-box i {
            position: absolute;
            left: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
        }
        
        .search-box input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 45px;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            font-size: 0.95rem;
            transition: all 0.3s;
        }
        
        .search-box input:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }
        
        /* Activity/Project Cards Grid */
        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
            gap: 2.5rem;
            margin-bottom: 3rem;
        }
        
        .activity-card {
            background: white;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0,0,0,0.06);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: 1px solid #f0f0f0;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .activity-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.12);
            border-color: var(--accent-color);
        }
        
        .card-image {
            width: 100%;
            height: 260px;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .activity-card:hover .card-image {
            transform: scale(1.08);
        }
        
        .card-image-wrapper {
            overflow: hidden;
            position: relative;
            background: #f0f0f0;
        }
        
        .card-badge {
            position: absolute;
            top: 20px;
            left: 20px;
            padding: 0.6rem 1.4rem;
            border-radius: 25px;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            z-index: 2;
            backdrop-filter: blur(10px);
        }
        
        .card-badge.activity {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.5);
        }
        
        .card-badge.project {
            background: linear-gradient(135deg, #2196F3, #42A5F5);
            color: white;
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.5);
        }
        
        .card-content {
            padding: 2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .card-title {
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1rem;
            line-height: 1.4;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            min-height: 3.6rem;
        }
        
        .card-description {
            color: #666;
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 1.5rem;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
            flex: 1;
        }
        
        .card-meta {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            font-size: 0.88rem;
            color: #777;
            padding-top: 1.5rem;
            border-top: 2px solid #f5f5f5;
            margin-top: auto;
        }
        
        .card-meta-item {
            display: flex;
            align-items: center;
            gap: 0.7rem;
        }
        
        .card-meta-item i {
            color: var(--accent-color);
            font-size: 0.9rem;
            width: 18px;
            text-align: center;
        }
        
        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 6rem 2rem;
        }
        
        .empty-state i {
            font-size: 5rem;
            color: #e0e0e0;
            margin-bottom: 1.5rem;
        }
        
        .empty-state h4 {
            color: #999;
            font-weight: 600;
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .empty-state p {
            color: #bbb;
            font-size: 1rem;
        }
        
        /* Custom SweetAlert2 Styling */
        .swal2-popup {
            border-radius: 20px !important;
            padding: 2rem !important;
        }
        
        .swal2-title {
            color: var(--primary-color) !important;
            font-size: 1.75rem !important;
            font-weight: 700 !important;
        }
        
        .swal2-html-container {
            max-height: 60vh;
            overflow-y: auto;
            text-align: left;
        }
        
        .detail-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 15px;
            margin-bottom: 1.5rem;
        }
        
        .detail-section {
            margin-bottom: 1.5rem;
        }
        
        .detail-label {
            font-weight: 700;
            color: var(--primary-color);
            font-size: 0.95rem;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .detail-label i {
            color: var(--accent-color);
        }
        
        .detail-value {
            color: #555;
            line-height: 1.7;
            font-size: 0.95rem;
        }
        
        .members-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .member-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: #f8f9fa;
            padding: 0.75rem;
            border-radius: 12px;
            border: 1px solid #e0e0e0;
        }
        
        .member-avatar,
        .member-avatar-placeholder {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        
        .member-avatar {
            object-fit: cover;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .member-avatar-placeholder {
            background: linear-gradient(135deg, var(--accent-color), var(--secondary-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.9rem;
            border: 2px solid white;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .member-info {
            flex: 1;
            min-width: 0;
        }
        
        .member-name {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 0.9rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .member-role {
            font-size: 0.75rem;
            color: #777;
        }
        
        /* Responsive */
        @media (max-width: 1200px) {
            .cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            body {
                padding-top: 140px;
            }
            
            .page-title {
                font-size: 2rem;
            }
            
            .page-header {
                padding: 2rem 0 1.5rem;
                margin-bottom: 2rem;
            }
            
            .cards-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .filter-section {
                padding: 1.5rem;
            }
            
            .filter-tabs {
                flex-direction: row;
                justify-content: space-between;
            }
            
            .filter-tab {
                flex: 1;
                text-align: center;
                padding: 0.6rem 1rem;
                font-size: 0.85rem;
            }
            
            .members-grid {
                grid-template-columns: 1fr;
            }
            
            .navbar-simple .container {
                flex-wrap: wrap;
                gap: 1rem;
                padding-left: 15px !important;
                padding-right: 15px !important;
            }
            
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .card-content {
                padding: 1.5rem;
            }
            
            .card-title {
                font-size: 1.2rem;
            }
            
            .container {
                padding-left: 15px !important;
                padding-right: 15px !important;
            }
        }
        
        @media (max-width: 480px) {
            .filter-tab {
                font-size: 0.75rem;
                padding: 0.5rem 0.5rem;
            }
            
            .filter-tab i {
                display: none;
            }
            
            .container {
                padding-left: 10px !important;
                padding-right: 10px !important;
            }
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <!-- Simple Navbar -->
    <nav class="navbar-simple">
        <div class="container">
            <a href="<?= $route->base_url('') ?>" class="navbar-brand">
                <img 
                    src="<?= $route->base_url('public/assets/img/logo/logo-icon.png') ?>" 
                    alt="DataLab Logo" 
                    width="36" 
                    height="36"
                    style="object-fit: contain;"
                >
                <span>DataTech</span>
            </a>
            
            <a href="<?= $route->base_url('landing_page') ?>#kegiatan" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <!-- Decorative Icons -->
        <i class="fas fa-flask page-header-decoration decoration-1"></i>
        <i class="fas fa-project-diagram page-header-decoration decoration-2"></i>
        <i class="fas fa-users page-header-decoration decoration-3"></i>
        <i class="fas fa-calendar-alt page-header-decoration decoration-4"></i>
        
        <div class="container">
            <!-- Icon -->
            <div class="page-icon">
                <i class="fas fa-newspaper"></i>
            </div>
            
            <!-- Breadcrumb -->
            <div class="page-breadcrumb">
                <a href="<?= $route->base_url('landing_page') ?>">
                    <i class="fas fa-home"></i>
                    Beranda
                </a>
                <i class="fas fa-chevron-right"></i>
                <span>Kegiatan & Proyek</span>
            </div>
            
            <!-- Title -->
            <h1 class="page-title">Kegiatan & Proyek</h1>
            <p class="page-subtitle">
                Jelajahi semua aktivitas, penelitian, dan proyek inovatif yang dilakukan oleh Laboratorium Data & Teknologi
            </p>
            
            <!-- Stats -->
            <div class="page-stats">
                <div class="stat-item">
                    <span class="stat-number" id="activityCount">0</span>
                    <span class="stat-label">Kegiatan</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" id="projectCount">0</span>
                    <span class="stat-label">Proyek</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number" id="totalCount">0</span>
                    <span class="stat-label">Total</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <!-- Filter Section -->
        <div class="filter-section">
            <div class="filter-tabs">
                <div class="filter-tab active" data-filter="all">
                    <i class="fas fa-th mr-2"></i>Semua
                </div>
                <div class="filter-tab" data-filter="activity">
                    <i class="fas fa-calendar-check mr-2"></i>Kegiatan
                </div>
                <div class="filter-tab" data-filter="project">
                    <i class="fas fa-project-diagram mr-2"></i>Proyek
                </div>
            </div>
            
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input 
                    type="text" 
                    id="searchInput" 
                    placeholder="Cari berdasarkan judul atau deskripsi..."
                >
            </div>
        </div>

        <!-- Cards Grid -->
        <div id="cardsContainer" class="cards-grid"></div>

        <!-- Empty State -->
        <div id="emptyState" class="empty-state" style="display: none;">
            <i class="fas fa-search"></i>
            <h4>Tidak ada hasil ditemukan</h4>
            <p>Coba ubah filter atau kata kunci pencarian</p>
        </div>
    </div>

    <script src="<?= $route->base_url('public/assets/plugins/jquery/jquery-3.3.1.min.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="<?= $route->base_url('public/assets/plugins/bootstrap/4.1.3/js/bootstrap.min.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <script>
        // Data dari PHP
        const activities = <?php echo json_encode($activities ?? []); ?>;
        const projects = <?php echo json_encode($projects ?? []); ?>;
        
        // Gabungkan dan tambahkan type
        const allData = [
            ...activities.map(item => ({...item, type: 'activity'})),
            ...projects.map(item => ({...item, type: 'project'}))
        ].sort((a, b) => {
            const dateA = new Date(a.date || a.start_date);
            const dateB = new Date(b.date || b.start_date);
            return dateB - dateA; // Sort descending (terbaru dulu)
        });

        let currentFilter = 'all';
        let searchTerm = '';

        function formatDate(dateString) {
            const options = { year: 'numeric', month: 'long', day: 'numeric' };
            return new Date(dateString).toLocaleDateString('id-ID', options);
        }

        function getInitials(name) {
            return name
                .split(' ')
                .map(n => n[0])
                .join('')
                .substring(0, 2)
                .toUpperCase();
        }

        function filterData() {
            return allData.filter(item => {
                const matchesFilter = currentFilter === 'all' || item.type === currentFilter;
                const matchesSearch = !searchTerm || 
                    (item.title || item.name || '').toLowerCase().includes(searchTerm.toLowerCase()) ||
                    (item.description || '').toLowerCase().includes(searchTerm.toLowerCase());
                
                return matchesFilter && matchesSearch;
            });
        }

        function renderCards() {
            const container = document.getElementById('cardsContainer');
            const emptyState = document.getElementById('emptyState');
            const filteredData = filterData();

            if (filteredData.length === 0) {
                container.style.display = 'none';
                emptyState.style.display = 'block';
                return;
            }

            container.style.display = 'grid';
            emptyState.style.display = 'none';

            container.innerHTML = filteredData.map((item, index) => {
                const title = item.title || item.name || 'Tanpa Judul';
                const description = item.description || 'Tidak ada deskripsi';
                const displayDate = item.type === 'activity' 
                    ? formatDate(item.date)
                    : `${formatDate(item.start_date)} - ${formatDate(item.end_date)}`;
                
                const locationOrSponsor = item.type === 'activity'
                    ? `<div class="card-meta-item"><i class="fas fa-map-marker-alt"></i><span>${item.location || 'Lokasi tidak tersedia'}</span></div>`
                    : `<div class="card-meta-item"><i class="fas fa-handshake"></i><span>${item.sponsor || 'Sponsor tidak tersedia'}</span></div>`;

                const memberCount = Array.isArray(item.members) ? item.members.length : 0;

                return `
                    <div class="activity-card" data-index="${index}">
                        <div class="card-image-wrapper">
                            <span class="card-badge ${item.type}">
                                ${item.type === 'activity' ? 'Kegiatan' : 'Proyek'}
                            </span>
                            <img src="<?= $route->base_url('public/') ?>${item.documentation}" 
                                 alt="${title}" 
                                 class="card-image"
                                 onerror="this.src='https://via.placeholder.com/400x260/0a4275/ffffff?text=No+Image'">
                        </div>
                        
                        <div class="card-content">
                            <h3 class="card-title">${title}</h3>
                            <p class="card-description">${description}</p>
                            
                            <div class="card-meta">
                                <div class="card-meta-item">
                                    <i class="far fa-calendar-alt"></i>
                                    <span>${displayDate}</span>
                                </div>
                                ${locationOrSponsor}
                                <div class="card-meta-item">
                                    <i class="fas fa-users"></i>
                                    <span>${memberCount} Anggota</span>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
            
            // Add click event listeners setelah render
            document.querySelectorAll('.activity-card').forEach((card, index) => {
                card.addEventListener('click', () => {
                    const currentData = filterData();
                    showDetail(currentData[index]);
                });
            });
        }

        function showDetail(item) {
            const title = item.title || item.name || 'Tanpa Judul';
            const description = item.description || 'Tidak ada deskripsi';
            const members = Array.isArray(item.members) ? item.members : [];
            
            const membersHtml = members.length > 0 ? members.map(member => {
                const fullName = `${member.title_prefix || ''} ${member.name || ''} ${member.title_suffix || ''}`.trim();
                
                return `
                    <div class="member-item">
                        ${member.photo 
                            ? `<img src="<?= $route->base_url('public/') ?>${member.photo}" alt="${member.name}" class="member-avatar">` 
                            : `<div class="member-avatar-placeholder">${getInitials(member.name || 'N A')}</div>`
                        }
                        <div class="member-info">
                            <div class="member-name">${fullName || 'Nama tidak tersedia'}</div>
                            <div class="member-role">${member.role || 'Anggota'}</div>
                        </div>
                    </div>
                `;
            }).join('') : '<p style="text-align: center; color: #999;">Belum ada anggota tim</p>';

            const displayDate = item.type === 'activity' 
                ? formatDate(item.date)
                : `${formatDate(item.start_date)} - ${formatDate(item.end_date)}`;

            const locationOrSponsor = item.type === 'activity'
                ? `
                    <div class="detail-section">
                        <div class="detail-label">
                            <i class="fas fa-map-marker-alt"></i>
                            Lokasi
                        </div>
                        <div class="detail-value">${item.location || 'Lokasi tidak tersedia'}</div>
                    </div>
                `
                : `
                    <div class="detail-section">
                        <div class="detail-label">
                            <i class="fas fa-handshake"></i>
                            Sponsor
                        </div>
                        <div class="detail-value">${item.sponsor || 'Sponsor tidak tersedia'}</div>
                    </div>
                `;

            Swal.fire({
                title: title,
                html: `
                    <img src="<?= $route->base_url('public/') ?>${item.documentation}" 
                         alt="${title}" 
                         class="detail-image"
                         onerror="this.src='https://via.placeholder.com/800x400/0a4275/ffffff?text=No+Image'">
                    
                    <div class="detail-section">
                        <div class="detail-label">
                            <i class="fas fa-tag"></i>
                            Jenis
                        </div>
                        <div class="detail-value">
                            <span style="
                                display: inline-block;
                                padding: 0.5rem 1.2rem;
                                border-radius: 25px;
                                font-size: 0.85rem;
                                font-weight: 700;
                                color: white;
                                text-transform: uppercase;
                                letter-spacing: 1px;
                                background: ${item.type === 'activity' 
                                    ? 'linear-gradient(135deg, #4CAF50, #66BB6A)' 
                                    : 'linear-gradient(135deg, #2196F3, #42A5F5)'};
                            ">
                                ${item.type === 'activity' ? 'Kegiatan' : 'Proyek'}
                            </span>
                        </div>
                    </div>
                    
                    <div class="detail-section">
                        <div class="detail-label">
                            <i class="far fa-calendar-alt"></i>
                            ${item.type === 'activity' ? 'Tanggal' : 'Periode'}
                        </div>
                        <div class="detail-value">${displayDate}</div>
                    </div>
                    
                    ${locationOrSponsor}
                    
                    <div class="detail-section">
                        <div class="detail-label">
                            <i class="fas fa-align-left"></i>
                            Deskripsi
                        </div>
                        <div class="detail-value">${description}</div>
                    </div>
                    
                    <div class="detail-section">
                        <div class="detail-label">
                            <i class="fas fa-users"></i>
                            Tim (${members.length} Anggota)
                        </div>
                        <div class="members-grid">
                            ${membersHtml}
                        </div>
                    </div>
                `,
                width: '900px',
                showCloseButton: true,
                showConfirmButton: false,
                customClass: {
                    popup: 'detail-modal',
                    htmlContainer: 'swal2-html-container'
                }
            });
        }

        // Event Listeners
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                currentFilter = this.dataset.filter;
                renderCards();
            });
        });

        document.getElementById('searchInput').addEventListener('input', function(e) {
            searchTerm = e.target.value;
            renderCards();
        });

        // Initial render
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Total data:', allData.length);
            console.log('Activities:', activities.length);
            console.log('Projects:', projects.length);
            
            // Animate counter
            animateCounter('activityCount', activities.length);
            animateCounter('projectCount', projects.length);
            animateCounter('totalCount', allData.length);
            
            // Render cards
            renderCards();
            
            // Hide loading overlay setelah halaman selesai load
            setTimeout(() => {
                const loadingOverlay = document.getElementById('loadingOverlay');
                if (loadingOverlay) {
                    loadingOverlay.classList.add('hidden');
                }
            }, 300);
        });
        
        // Counter animation function
        function animateCounter(elementId, targetValue) {
            const element = document.getElementById(elementId);
            if (!element) return;
            
            let currentValue = 0;
            const duration = 1500; // 1.5 seconds
            const increment = targetValue / (duration / 16); // 60fps
            
            const timer = setInterval(() => {
                currentValue += increment;
                if (currentValue >= targetValue) {
                    element.textContent = targetValue;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(currentValue);
                }
            }, 16);
        }
    </script>
</body>
</html>