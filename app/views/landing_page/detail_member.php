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

    <style>
        :root {
            --primary-color: #0a4275;
            --secondary-color: #7cb342;
            --accent-color: #4caf50;
            --dark-blue: #001a33;
            --light-gray: #f8f9fa;
        }

        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            overflow-x: hidden;
        }

        /* Navbar Minimalist */
        .navbar-minimal {
            background: white;
            padding: 1rem 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-minimal.scrolled {
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }

        .navbar-brand-minimal {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-back-minimal {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }

        .btn-back-minimal:hover {
            background: var(--primary-color);
            color: white;
            text-decoration: none;
            transform: translateX(-3px);
        }

        /* Hero */
        .hero-minimal {
            margin-top: 80px;
            padding: 3rem 0 2rem;
            background: white;
        }

        .profile-container { max-width: 1100px; margin: 0 auto; }

        .profile-header {
            display: flex;
            align-items: center;
            gap: 2.5rem;
            padding: 2rem;
            background: linear-gradient(135deg, rgba(10, 66, 117, 0.03), rgba(76, 175, 80, 0.03));
            border-radius: 20px;
            margin-bottom: 2rem;
        }

        .profile-photo-minimal {
            width: 180px;
            height: 180px;
            min-width: 180px;
            border-radius: 20px;
            object-fit: cover;
            box-shadow: 0 10px 40px rgba(10, 66, 117, 0.15);
            border: 4px solid white;
        }

        .profile-name-minimal {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
        }

        .profile-position-minimal {
            font-size: 1.2rem;
            color: var(--accent-color);
            font-weight: 600;
            margin-bottom: 1rem;
        }

        /* Content Container */
        .content-minimal {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 1rem 4rem;
        }

        /* Card Styling */
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

        /* Contact Section */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-minimal {
                padding: 1.75rem;
            }

            .contact-grid {
                grid-template-columns: 1fr;
            }

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
        }

        html {
            scroll-behavior: smooth;
        }
        /* Expertise Section */

        .expertise-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .expertise-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 18px;
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--accent-color) 100%);
            color: white;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 3px 10px rgba(124, 179, 66, 0.3);
        }

        .expertise-tag i {
            font-size: 12px;
        }

        .expertise-tag:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(124, 179, 66, 0.4);
        }

        /* Profile Badges */
        .profile-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 1.5rem;
        }

        .badge-minimal {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            background: linear-gradient(135deg, var(--primary-color), #0d5a9e);
            color: white;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(10, 66, 117, 0.2);
            transition: all 0.3s ease;
        }

        .badge-minimal:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(10, 66, 117, 0.3);
        }

        .badge-minimal i {
            font-size: 16px;
        }

        /* Social Media Section */

        .social-links {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 14px;
            background: linear-gradient(135deg, var(--light-gray) 0%, #e3f2fd 100%);
            color: var(--primary-color);
            font-size: 20px;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-decoration: none;
            box-shadow: 0 3px 10px rgba(10, 66, 117, 0.15);
            position: relative;
            overflow: hidden;
        }

        .social-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
        }

        .social-link i {
            position: relative;
            z-index: 2;
            transition: transform 0.3s ease;
        }

        .social-link:hover::before {
            opacity: 1;
        }

        .social-link:hover {
            transform: translateY(-5px) scale(1.1);
            box-shadow: 0 8px 20px rgba(10, 66, 117, 0.3);
            color: white;
        }

        .social-link:hover i {
            transform: scale(1.2) rotate(5deg);
        }

        /* Responsive Design */
        @media (max-width: 992px) {
            .profile-header {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .profile-photo-minimal {
                width: 220px;
                height: 220px;
            }

            .profile-name-minimal {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .hero-minimal {
                padding: 2rem 0;
            }

            .profile-photo-minimal {
                width: 180px;
                height: 180px;
            }

            .profile-name-minimal {
                font-size: 1.75rem;
            }

            .expertise-tag {
                padding: 8px 14px;
                font-size: 13px;
            }

            .social-link {
                width: 45px;
                height: 45px;
                font-size: 18px;
            }
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar-minimal" id="navbar">
    <div class="container d-flex justify-content-between align-items-center">
        <a class="navbar-brand-minimal" href="<?= $route->base_url() ?>">
            <img src="<?= $route->base_url('public/assets/img/logo/logo-icon.png') ?>" width="32">
            <span>DataTech</span>
        </a>
        <a href="<?= $route->base_url('landing_page') ?>#tim" class="btn-back-minimal">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
</nav>

<!-- Hero -->
<section class="hero-minimal">
    <div class="container">
        <div class="profile-header">

            <div class="profile-photo-wrapper">
                <img src="<?= $route->base_url('public/' . htmlspecialchars($member['photo'])) ?>"
                     class="profile-photo-minimal">
                <div class="photo-border"></div>
            </div>

            <div class="profile-content">
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
                <div class=" mb-3">
                    <div class="expertise-tags">
                        <?php foreach ($member['expertises'] as $exp): ?>
                            <span class="expertise-tag">
                                <i class="fas fa-check-circle"></i>
                                <?= htmlspecialchars($exp['name']) ?>
                            </span>
                        <?php endforeach; ?>
                    </div>
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
</section>

<!-- Content -->
<div class="content-minimal">
    <div class="container">
        <div class="row">

            <!-- Contact Section -->
            <div class="col-lg-12">
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
            </div>

            <!-- Courses Section -->
            <div class="col-lg-12">
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
            </div>

            <!-- Education Section -->
            <div class="col-lg-12">
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
            </div>

            <!-- Publications Section -->
            <div class="col-lg-12">
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
    </div>
</div>


<!-- JavaScript -->
<script src="<?= $route->base_url('public/assets/plugins/jquery/jquery-3.3.1.min.js') ?>"></script>
<script src="<?= $route->base_url('public/assets/plugins/bootstrap/4.1.3/js/bootstrap.min.js') ?>"></script>

<script>
    // Navbar shadow saat scroll
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 20) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Animasi slide-up saat elemen terlihat
    const animatedCards = document.querySelectorAll('.animate-slide-up');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = "translateY(0)";
            }
        });
    }, { threshold: 0.15 });

    animatedCards.forEach(card => {
        card.style.opacity = 0;
        card.style.transform = "translateY(20px)";
        observer.observe(card);
    });
</script>

</body>
</html>
