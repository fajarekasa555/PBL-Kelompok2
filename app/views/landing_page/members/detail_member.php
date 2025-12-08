<!DOCTYPE html>
<html lang="id">
<head>
    <?php
        use App\Helpers\Routing;
        $route = new Routing();
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($member['name']) ?> - Detail Profil</title>
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

        /* Navbar */
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
            margin-bottom: 2rem;
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

        .decoration-1 { top: 15%; left: 10%; animation-delay: 0s; }
        .decoration-2 { top: 30%; right: 15%; animation-delay: 1s; }
        .decoration-3 { bottom: 20%; left: 15%; animation-delay: 2s; }
        .decoration-4 { bottom: 25%; right: 10%; animation-delay: 3s; }

        @keyframes float-icon {
            0%, 100% { transform: translateY(0) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(5deg); }
        }

        .page-header .container {
            position: relative;
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

        /* Profile Header */
        .profile-header {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }

        .profile-photo-wrapper {
            position: relative;
            display: inline-block;
            margin-bottom: 1.5rem;
        }

        .profile-photo-minimal {
            width: 180px;
            height: 180px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid white;
            box-shadow: 0 10px 40px rgba(10, 66, 117, 0.15);
        }

        .profile-name-minimal {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: white;
        }

        .profile-position-minimal {
            font-size: 1.3rem;
            color: var(--accent-color);
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        /* Profile Badges */
        .profile-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .badge-minimal {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .badge-minimal:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .badge-minimal i {
            font-size: 0.9rem;
        }

        /* Expertise Tags */
        .expertise-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 0.75rem;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .expertise-tag {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            color: white;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(124, 179, 66, 0.3);
        }

        .expertise-tag:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(124, 179, 66, 0.4);
        }

        .expertise-tag i {
            font-size: 0.8rem;
        }

        /* Social Links */
        .social-links {
            display: flex;
            gap: 0.75rem;
            justify-content: center;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            color: white;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .social-link:hover {
            background: var(--accent-color);
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 6px 16px rgba(76, 175, 80, 0.4);
            color: white;
        }

        /* Main Container */
        .main-container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 1rem 4rem;
            position: relative;
            z-index: 1;
        }

        /* Card */
        .card-minimal {
            background: white;
            border-radius: 20px;
            padding: 2.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 20px rgba(10, 66, 117, 0.08);
            transition: all 0.4s ease;
            border: 1px solid rgba(10, 66, 117, 0.05);
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.6s ease;
        }

        .card-minimal::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .card-minimal:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(10, 66, 117, 0.15);
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

        .card-title-minimal {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-color);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--light-gray);
        }

        .card-title-minimal i {
            color: var(--secondary-color);
            font-size: 1.6rem;
        }

        /* Contact Grid */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
        }

        .contact-item-minimal {
            display: flex;
            align-items: center;
            gap: 1.25rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--light-gray) 0%, #e8f5e9 100%);
            border-radius: 16px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
        }

        .contact-item-minimal::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, var(--secondary-color), var(--accent-color));
            border-radius: 16px 0 0 16px;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .contact-item-minimal:hover::before {
            transform: scaleY(1);
        }

        .contact-item-minimal:hover {
            transform: translateX(8px);
            background: linear-gradient(135deg, rgba(124, 179, 66, 0.1) 0%, rgba(76, 175, 80, 0.15) 100%);
            border-color: rgba(124, 179, 66, 0.3);
        }

        .contact-icon-minimal {
            width: 55px;
            height: 55px;
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            font-size: 1.4rem;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(124, 179, 66, 0.3);
            transition: all 0.3s ease;
        }

        .contact-item-minimal:hover .contact-icon-minimal {
            transform: scale(1.1) rotate(5deg);
        }

        .contact-details h6 {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--secondary-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.25rem;
        }

        .contact-details p {
            font-size: 1rem;
            font-weight: 600;
            color: var(--dark-blue);
            margin: 0;
        }

        /* Course Grid */
        .course-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.25rem;
        }

        .course-item-minimal {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
            background: linear-gradient(135deg, var(--light-gray) 0%, #e3f2fd 100%);
            border-radius: 16px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .course-item-minimal::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--primary-color), var(--accent-color));
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .course-item-minimal:hover::before {
            transform: scaleY(1);
        }

        .course-item-minimal:hover {
            transform: translateY(-5px);
            border-color: rgba(10, 66, 117, 0.2);
            box-shadow: 0 8px 20px rgba(10, 66, 117, 0.15);
        }

        .course-icon {
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, var(--primary-color), #0d5a9e);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.3rem;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(10, 66, 117, 0.2);
            transition: all 0.3s ease;
        }

        .course-item-minimal:hover .course-icon {
            transform: scale(1.1) rotate(-5deg);
        }

        .course-content {
            flex: 1;
        }

        .course-name-minimal {
            font-size: 1rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .course-semester-minimal {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        .course-semester-minimal i {
            font-size: 0.85rem;
        }

        /* Timeline Education */
        .timeline-minimal {
            position: relative;
            padding-left: 3rem;
        }

        .timeline-minimal::before {
            content: "";
            position: absolute;
            left: 14px;
            top: 8px;
            bottom: 8px;
            width: 3px;
            background: linear-gradient(to bottom, var(--secondary-color), transparent);
            border-radius: 3px;
        }

        .timeline-item-minimal {
            padding-bottom: 2.5rem;
            position: relative;
        }

        .timeline-item-minimal:last-child {
            padding-bottom: 0;
        }

        .timeline-item-minimal::before {
            content: "";
            position: absolute;
            left: -3rem;
            top: 0;
            width: 30px;
            height: 30px;
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            border-radius: 50%;
            border: 4px solid white;
            box-shadow: 0 0 0 4px rgba(124, 179, 66, 0.2);
            z-index: 2;
            transition: all 0.3s ease;
        }

        .timeline-item-minimal:hover::before {
            transform: scale(1.2);
            box-shadow: 0 0 0 6px rgba(124, 179, 66, 0.3);
        }

        .timeline-content {
            background: linear-gradient(135deg, var(--light-gray) 0%, #e8f5e9 100%);
            padding: 1.5rem;
            border-radius: 16px;
            transition: all 0.3s ease;
            border-left: 4px solid var(--secondary-color);
        }

        .timeline-item-minimal:hover .timeline-content {
            transform: translateX(8px);
            box-shadow: 0 6px 20px rgba(124, 179, 66, 0.15);
        }

        .timeline-degree {
            font-size: 1.1rem;
            font-weight: 800;
            color: var(--dark-blue);
            margin-bottom: 1rem;
            line-height: 1.4;
        }

        .timeline-info {
            margin-bottom: 0.75rem;
        }

        .timeline-info:last-child {
            margin-bottom: 0;
        }

        .info-item {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.95rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        .info-item i {
            color: var(--secondary-color);
            font-size: 0.9rem;
        }

        /* Publications */
        .publications-list {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .publication-item-minimal {
            display: flex;
            gap: 1.5rem;
            padding: 1.75rem;
            background: linear-gradient(135deg, var(--light-gray) 0%, #e3f2fd 100%);
            border-radius: 16px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
        }

        .publication-item-minimal::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: linear-gradient(180deg, var(--primary-color), var(--secondary-color));
            border-radius: 16px 0 0 16px;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .publication-item-minimal:hover::before {
            transform: scaleY(1);
        }

        .publication-item-minimal:hover {
            transform: translateX(8px);
            border-color: rgba(10, 66, 117, 0.2);
            box-shadow: 0 8px 20px rgba(10, 66, 117, 0.15);
        }

        .publication-number {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary-color), #0d5a9e);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 12px;
            font-size: 1.2rem;
            font-weight: 800;
            flex-shrink: 0;
            box-shadow: 0 4px 15px rgba(10, 66, 117, 0.2);
            transition: all 0.3s ease;
        }

        .publication-item-minimal:hover .publication-number {
            transform: scale(1.1) rotate(5deg);
        }

        .publication-content {
            flex: 1;
        }

        .publication-title {
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 1rem;
            line-height: 1.5;
        }

        .publication-meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .meta-item {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
            color: var(--primary-color);
            font-weight: 600;
        }

        .meta-item i {
            color: var(--secondary-color);
        }

        .publication-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
            color: white;
            border-radius: 10px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(124, 179, 66, 0.3);
        }

        .publication-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(124, 179, 66, 0.4);
            color: white;
        }

        .publication-link i {
            font-size: 0.85rem;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            color: #999;
        }

        .empty-state i {
            font-size: 4rem;
            color: #e0e0e0;
            margin-bottom: 1rem;
        }

        .empty-state h4 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            font-size: 0.95rem;
            color: #bbb;
        }

        /* Loading overlay */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.95);
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
        @media (max-width: 992px) {
            .profile-name-minimal {
                font-size: 2rem;
            }

            .course-grid {
                grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            }
        }

        @media (max-width: 768px) {
            body {
                padding-top: 80px;
            }

            .page-header {
                padding: 3rem 0 2rem;
            }

            .profile-photo-minimal {
                width: 150px;
                height: 150px;
            }

            .profile-name-minimal {
                font-size: 1.75rem;
            }

            .profile-position-minimal {
                font-size: 1.1rem;
            }

            .card-minimal {
                padding: 1.75rem;
            }

            .contact-grid,
            .course-grid {
                grid-template-columns: 1fr;
            }

            .timeline-minimal {
                padding-left: 2.5rem;
            }

            .publication-item-minimal {
                flex-direction: column;
                gap: 1rem;
            }

            .publication-number {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .page-header-decoration {
                font-size: 2rem;
            }
        }

        @media (max-width: 480px) {
            .main-container {
                padding: 0 1rem 2rem;
            }

            .profile-name-minimal {
                font-size: 1.5rem;
            }

            .profile-position-minimal {
                font-size: 1rem;
            }

            .card-minimal {
                padding: 1.5rem;
            }

            .card-title-minimal {
                font-size: 1.25rem;
            }

            .expertise-tag,
            .badge-minimal {
                font-size: 0.8rem;
                padding: 0.5rem 1rem;
            }
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="spinner"></div>
    </div>

    <!-- Navbar -->
    <nav class="navbar-simple" id="navbar">
        <div class="container d-flex justify-content-between align-items-center">
            <a class="navbar-brand" href="<?= $route->base_url() ?>">
                <img src="<?= $route->base_url('public/assets/img/logo/logo-icon.png') ?>" width="32">
                <span>DataTech</span>
            </a>
            <a href="<?= $route->base_url('landing_page') ?>" class="btn-back">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="page-header">
        <!-- Decorative Icons -->
        <i class="fas fa-user-graduate page-header-decoration decoration-1"></i>
        <i class="fas fa-award page-header-decoration decoration-2"></i>
        <i class="fas fa-book-reader page-header-decoration decoration-3"></i>
        <i class="fas fa-chalkboard-teacher page-header-decoration decoration-4"></i>

        <div class="container">
            <!-- Breadcrumb -->
            <div class="page-breadcrumb">
                <a href="<?= $route->base_url('landing_page') ?>">
                    <i class="fas fa-home"></i>
                    Beranda
                </a>
                <i class="fas fa-chevron-right"></i>
                <a href="<?= $route->base_url('landing_page') ?>#team">
                    <i class="fas fa-users"></i>
                    Tim
                </a>
                <i class="fas fa-chevron-right"></i>
                <span>Profil</span>
            </div>

            <div class="profile-header">
                <div class="profile-photo-wrapper">
                    <img src="<?= $route->base_url('public/' . htmlspecialchars($member['photo'])) ?>"
                         class="profile-photo-minimal"
                         alt="<?= htmlspecialchars($member['name']) ?>">
                </div>

                <h1 class="profile-name-minimal">
                    <?= htmlspecialchars($member['title_prefix']) ?>
                    <?= htmlspecialchars($member['name']) ?>
                    <?= htmlspecialchars($member['title_suffix']) ?>
                </h1>

                <p class="profile-position-minimal">
                    <?= htmlspecialchars($member['jabatan']) ?>
                </p>

                <div class="profile-badges">
                    <?php if ($member['program_studi']): ?>
                    <span class="badge-minimal">
                        <i class="fas fa-graduation-cap"></i>
                        <?= htmlspecialchars($member['program_studi']) ?>
                    </span>
                    <?php endif; ?>

                    <?php if ($member['nip']): ?>
                    <span class="badge-minimal">
                        <i class="fas fa-id-card"></i>
                        NIP: <?= htmlspecialchars($member['nip']) ?>
                    </span>
                    <?php endif; ?>

                    <?php if ($member['nidn']): ?>
                    <span class="badge-minimal">
                        <i class="fas fa-id-badge"></i>
                        NIDN: <?= htmlspecialchars($member['nidn']) ?>
                    </span>
                    <?php endif; ?>
                </div>

                <?php if (!empty($member['expertises'])): ?>
                <div class="expertise-tags">
                    <?php foreach ($member['expertises'] as $exp): ?>
                        <span class="expertise-tag">
                            <i class="fas fa-check-circle"></i>
                            <?= htmlspecialchars($exp['name']) ?>
                        </span>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($member['social_media'])): ?>
                <div class="social-links">
                    <?php foreach ($member['social_media'] as $social): ?>
                    <a href="<?= htmlspecialchars($social['url']) ?>" target="_blank" class="social-link">
                        <i class="<?= htmlspecialchars($social['icon']) ?>"></i>
                    </a>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-container">
        <div class="container">
            <!-- Contact Section -->
            <?php if (!empty($member['email']) || !empty($member['phone']) || !empty($member['address'])): ?>
            <div class="card-minimal">
                <h3 class="card-title-minimal">
                    <i class="fas fa-id-card"></i> Informasi Kontak
                </h3>

                <div class="contact-grid">
                    <?php if (!empty($member['email'])): ?>
                    <div class="contact-item-minimal">
                        <span class="contact-icon-minimal">
                            <i class="fas fa-envelope"></i>
                        </span>
                        <div class="contact-details">
                            <h6>Email</h6>
                            <p><?= htmlspecialchars($member['email']) ?></p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($member['phone'])): ?>
                    <div class="contact-item-minimal">
                        <span class="contact-icon-minimal">
                            <i class="fas fa-phone"></i>
                        </span>
                        <div class="contact-details">
                            <h6>Telepon</h6>
                            <p><?= htmlspecialchars($member['phone']) ?></p>
                        </div>
                    </div>
                    <?php endif; ?>

                    <?php if (!empty($member['address'])): ?>
                    <div class="contact-item-minimal">
                        <span class="contact-icon-minimal">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                        <div class="contact-details">
                            <h6>Alamat</h6>
                            <p><?= htmlspecialchars($member['address']) ?></p>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Courses Section -->
            <?php if (!empty($member['courses'])): ?>
            <div class="card-minimal">
                <h3 class="card-title-minimal">
                    <i class="fas fa-chalkboard-teacher"></i> Mata Kuliah yang Diampu
                </h3>

                <div class="course-grid">
                    <?php foreach ($member['courses'] as $course): ?>
                    <div class="course-item-minimal">
                        <div class="course-icon">
                            <i class="fas fa-book-open"></i>
                        </div>
                        <div class="course-content">
                            <div class="course-name-minimal">
                                <?= htmlspecialchars($course['course_name']) ?>
                            </div>
                            <div class="course-semester-minimal">
                                <i class="far fa-calendar"></i>
                                Semester <?= htmlspecialchars($course['semester']) ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Education Section -->
            <?php if (!empty($member['educations'])): ?>
            <div class="card-minimal">
                <h3 class="card-title-minimal">
                    <i class="fas fa-graduation-cap"></i> Riwayat Pendidikan
                </h3>

                <div class="timeline-minimal">
                    <?php foreach ($member['educations'] as $edu): ?>
                    <div class="timeline-item-minimal">
                        <div class="timeline-content">
                            <div class="timeline-degree">
                                <?= htmlspecialchars($edu['degree']) ?> - <?= htmlspecialchars($edu['major']) ?>
                            </div>

                            <div class="timeline-info">
                                <span class="info-item">
                                    <i class="fas fa-university"></i>
                                    <?= htmlspecialchars($edu['institution']) ?>
                                </span>
                            </div>

                            <div class="timeline-info">
                                <span class="info-item">
                                    <i class="far fa-calendar"></i>
                                    <?= htmlspecialchars($edu['start_year']) ?> -
                                    <?= htmlspecialchars($edu['end_year'] ?? 'Sekarang') ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>

            <!-- Publications Section -->
            <?php if (!empty($member['publications'])): ?>
            <div class="card-minimal">
                <h3 class="card-title-minimal">
                    <i class="fas fa-book"></i> Publikasi Ilmiah
                </h3>

                <div class="publications-list">
                    <?php foreach ($member['publications'] as $index => $pub): ?>
                    <div class="publication-item-minimal">
                        <div class="publication-number"><?= $index + 1 ?></div>
                        <div class="publication-content">
                            <div class="publication-title">
                                <?= htmlspecialchars($pub['title']) ?>
                            </div>

                            <div class="publication-meta">
                                <span class="meta-item">
                                    <i class="far fa-calendar"></i>
                                    <?= htmlspecialchars($pub['date']) ?>
                                </span>

                                <?php if (!empty($pub['link'])): ?>
                                <a href="<?= htmlspecialchars($pub['link']) ?>" 
                                   target="_blank" 
                                   class="publication-link">
                                    <i class="fas fa-external-link-alt"></i>
                                    Lihat Publikasi
                                </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="<?= $route->base_url('public/assets/plugins/jquery/jquery-3.3.1.min.js') ?>"></script>
    <script src="<?= $route->base_url('public/assets/plugins/bootstrap/4.1.3/js/bootstrap.min.js') ?>"></script>

    <script>
        // Navbar shadow on scroll
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Hide loading overlay
        document.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                const loadingOverlay = document.getElementById('loadingOverlay');
                if (loadingOverlay) {
                    loadingOverlay.classList.add('hidden');
                }
            }, 300);
        });
    </script>
</body>
</html>