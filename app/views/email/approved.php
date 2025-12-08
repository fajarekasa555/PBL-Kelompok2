<?php
    use App\Helpers\Routing;
    $route = new Routing();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body { 
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
            line-height: 1.6;
        }
        
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        
        /* Header */
        .email-header {
            background: linear-gradient(135deg, #0a4275 0%, #001a33 100%);
            padding: 32px;
            text-align: center;
        }
        
        .logo {
            width: 64px;
            height: 64px;
            margin-bottom: 16px;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        
        .lab-name {
            color: white;
            font-size: 20px;
            font-weight: 600;
            margin: 0;
        }
        
        .lab-subtitle {
            color: rgba(255,255,255,0.75);
            font-size: 13px;
            margin-top: 4px;
        }
        
        /* Content */
        .email-content {
            padding: 40px 32px;
        }
        
        .status-badge {
            display: inline-block;
            background: #4caf50;
            color: white;
            padding: 6px 16px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.3px;
            margin-bottom: 24px;
        }
        
        h2 {
            color: #1a1a1a;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 24px;
        }
        
        .greeting {
            font-size: 15px;
            color: #333;
            margin-bottom: 16px;
        }
        
        .greeting strong {
            color: #0a4275;
            font-weight: 600;
        }
        
        .message {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 24px;
        }
        
        /* Note Box */
        .note-box {
            background: #f8f9fa;
            border-left: 3px solid #4caf50;
            padding: 16px;
            border-radius: 4px;
            margin: 24px 0;
        }
        
        .note-box-title {
            color: #0a4275;
            font-weight: 600;
            font-size: 14px;
            margin-bottom: 8px;
        }
        
        .note-box-content {
            color: #555;
            font-size: 14px;
            line-height: 1.5;
        }
        
        /* Info Section */
        .info-section {
            background: #f8f9fa;
            padding: 24px;
            border-radius: 4px;
            margin: 24px 0;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px solid #e9ecef;
        }
        
        .info-row:last-child {
            border-bottom: none;
        }
        
        .info-label {
            color: #777;
            font-size: 14px;
        }
        
        .info-value {
            color: #0a4275;
            font-weight: 600;
            font-size: 14px;
        }
        
        .closing {
            font-size: 14px;
            color: #555;
            margin-top: 24px;
        }
        
        /* Footer */
        .email-footer {
            background: #f8f9fa;
            padding: 32px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        
        .footer-lab-name {
            color: #0a4275;
            font-weight: 600;
            font-size: 15px;
            margin-bottom: 12px;
        }
        
        .footer-contact {
            font-size: 13px;
            color: #666;
            line-height: 1.8;
            margin-bottom: 16px;
        }
        
        .footer-contact a {
            color: #0a4275;
            text-decoration: none;
        }
        
        .footer-contact a:hover {
            text-decoration: underline;
        }
        
        .social-links {
            margin: 16px 0;
        }
        
        .social-links a {
            color: #666;
            text-decoration: none;
            margin: 0 8px;
            font-size: 13px;
        }
        
        .social-links a:hover {
            color: #0a4275;
        }
        
        .footer-note {
            font-size: 12px;
            color: #999;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e9ecef;
        }
        
        /* Responsive */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            
            .email-header {
                padding: 24px;
            }
            
            .email-content {
                padding: 24px 20px;
            }
            
            .email-footer {
                padding: 24px 20px;
            }
            
            h2 {
                font-size: 20px;
            }
            
            .info-row {
                flex-direction: column;
                gap: 4px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <!-- Header -->
        <div class="email-header">
            <img src="<?= $route->base_url('public') ?>/assets/img/logo/logo-icon.png" alt="Logo" class="logo">
            <div class="lab-name">Laboratorium Data dan Teknologi</div>
            <div class="lab-subtitle">Excellence in Data Science & Technology</div>
        </div>
        
        <!-- Content -->
        <div class="email-content">
            <div class="status-badge">Disetujui</div>
            
            <h2>Selamat Bergabung!</h2>
            
            <p class="greeting">Halo <strong><?= htmlspecialchars($name) ?></strong>,</p>
            
            <p class="message">
                Pendaftaran Anda sebagai anggota Laboratorium Data dan Teknologi telah disetujui. 
                Selamat datang di keluarga besar kami!
            </p>
            
            <?php if (!empty($note)): ?>
            <div class="note-box">
                <div class="note-box-title">Catatan Admin</div>
                <div class="note-box-content">
                    <?= nl2br(htmlspecialchars($note)) ?>
                </div>
            </div>
            <?php endif; ?>
            
            <div class="info-section">
                <div class="info-row">
                    <span class="info-label">Status</span>
                    <span class="info-value">Anggota Aktif</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Tanggal Terdaftar</span>
                    <span class="info-value"><?= date('d M Y') ?></span>
                </div>
            </div>
            
            <p class="closing">
                Terima kasih telah mendaftar dan menjadi bagian dari kami.
            </p>
        </div>
        
        <!-- Footer -->
        <div class="email-footer">
            <div class="footer-lab-name">Laboratorium Data dan Teknologi</div>
            <div class="footer-contact">
                <a href="mailto:lab.datatek@university.ac.id">lab.datatek@university.ac.id</a><br>
                +62 812-3456-7890<br>
                Gedung Fakultas Teknik, Lantai 3, Ruang 301
            </div>
            
            <div class="social-links">
                <a href="#">Instagram</a> • 
                <a href="#">Facebook</a> • 
                <a href="#">LinkedIn</a>
            </div>
            
            <div class="footer-note">
                Email ini dikirim secara otomatis oleh sistem.
            </div>
        </div>
    </div>
</body>
</html>