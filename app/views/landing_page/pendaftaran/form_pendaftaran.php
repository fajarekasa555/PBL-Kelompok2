<!DOCTYPE html>
<html lang="id">
<head>
	<?php
        use App\Helpers\Routing;
        $route = new Routing();
    ?>
	<meta charset="utf-8" />
	<title>DataTech - Pendaftaran Anggota</title>
    <link rel="icon" type="image/png" href="<?= $route->base_url('public/assets/img/logo/logo-icon.png') ?>" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;500;600;700&display=swap" rel="stylesheet" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />

	<!-- Select2 -->
	<link href="<?= $route->base_url('public/assets/plugins/select2/dist/css/select2.min.css') ?>" rel="stylesheet" />
	
	<!-- sweetalert -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.min.css" rel="stylesheet">

	<!-- FilePond CSS -->
	<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet"/>
	<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>
	<link href="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css" rel="stylesheet"/>
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<style>
		:root {
			--primary-color: #0a4275;
			--secondary-color: #7cb342;
			--accent-color: #4caf50;
			--dark-blue: #001a33;
			--light-gray: #f8f9fa;
			--success-color: #4caf50;
			--warning-color: #ff9800;
			--info-color: #2196F3;
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

		/* Background Animation - sama seperti halaman proyek */
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

		/* Navbar - sama seperti halaman proyek */
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

		/* Page Header - sama seperti halaman proyek */
		.page-header {
			background: linear-gradient(135deg, var(--primary-color), var(--dark-blue));
			color: white;
			padding: 4rem 0 3rem;
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

		/* Registration Card */
		.registration-card {
			background: white;
			border-radius: 20px;
			box-shadow: 0 4px 20px rgba(10, 66, 117, 0.08);
			overflow: hidden;
			animation: fadeIn 0.6s ease 0.2s both;
			border: 1px solid rgba(10, 66, 117, 0.05);
			position: relative;
		}
		
		.registration-card::before {
			content: '';
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 4px;
			background: linear-gradient(90deg, var(--primary-color), var(--dark-blue));
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

		.registration-body {
			padding: 2.5rem 2rem;
		}

		/* Alert Styles */
		.alert-box {
			border-radius: 10px;
			padding: 1rem 1.25rem;
			margin-bottom: 1.5rem;
			display: flex;
			align-items: flex-start;
			font-size: 0.9rem;
			line-height: 1.6;
			animation: fadeIn 0.5s ease;
		}

		.alert-box i {
			margin-right: 0.75rem;
			margin-top: 0.2rem;
			font-size: 1.2rem;
			flex-shrink: 0;
		}

		.alert-info {
			background: linear-gradient(135deg, rgba(33, 150, 243, 0.1), rgba(100, 181, 246, 0.1));
			border-left: 4px solid var(--info-color);
			color: #1565c0;
		}

		.alert-warning {
			background: linear-gradient(135deg, rgba(255, 152, 0, 0.1), rgba(255, 193, 7, 0.1));
			border-left: 4px solid var(--warning-color);
			color: #e65100;
		}

		.alert-box ul {
			margin: 0.5rem 0 0 0;
			padding-left: 1.5rem;
		}

		.alert-box li {
			margin: 0.25rem 0;
		}

		.alert-box strong {
			font-weight: 700;
		}

		/* Form Groups */
		.form-group {
			margin-bottom: 1.5rem;
			position: relative;
		}

		.form-group label {
			font-weight: 600;
			color: var(--primary-color);
			margin-bottom: 0.5rem;
			font-size: 0.9rem;
			display: block;
		}

		.form-group label .required {
			color: #f44336;
			margin-left: 0.25rem;
		}

		.form-group label .optional {
			color: #999;
			font-weight: 400;
			font-size: 0.85rem;
			margin-left: 0.5rem;
		}

		.input-group-custom {
			position: relative;
		}

		.input-icon {
			position: absolute;
			left: 1rem;
			top: 50%;
			transform: translateY(-50%);
			color: var(--accent-color);
			font-size: 1.1rem;
			z-index: 10;
		}

		.form-control-custom {
			width: 100%;
			padding: 0.875rem 1rem 0.875rem 3rem;
			border: 2px solid #e0e0e0;
			border-radius: 10px;
			font-size: 0.95rem;
			transition: all 0.3s ease;
			background: white;
		}

		.form-control-custom:focus {
			outline: none;
			border-color: var(--accent-color);
			box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.1);
		}

		.form-control-custom::placeholder {
			color: #999;
		}

		/* Textarea */
		textarea.form-control-custom {
			padding: 0.875rem 1rem;
			resize: vertical;
			min-height: 120px;
			font-family: inherit;
		}

		/* Select2 Custom Styling */
		.select2-container--default .select2-selection--single {
			height: auto !important;
			padding: 0.875rem 1rem 0.875rem 3rem !important;
			border: 2px solid #e0e0e0 !important;
			border-radius: 10px !important;
			font-size: 0.95rem !important;
			transition: all 0.3s ease !important;
			background: white !important;
		}

		.select2-container--default .select2-selection--single:focus,
		.select2-container--default.select2-container--open .select2-selection--single {
			outline: none !important;
			border-color: var(--accent-color) !important;
			box-shadow: 0 0 0 4px rgba(76, 175, 80, 0.1) !important;
		}

		.select2-container--default .select2-selection--single .select2-selection__rendered {
			color: #333 !important;
			line-height: normal !important;
			padding: 0 !important;
		}

		.select2-container--default .select2-selection--single .select2-selection__placeholder {
			color: #999 !important;
		}

		.select2-container--default .select2-selection--single .select2-selection__arrow {
			height: 100% !important;
			right: 1rem !important;
			top: 0 !important;
		}

		.select2-container--default .select2-selection--single .select2-selection__arrow b {
			border-color: var(--accent-color) transparent transparent transparent !important;
			border-width: 6px 5px 0 5px !important;
			margin-left: -5px !important;
			margin-top: -3px !important;
		}

		.select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
			border-color: transparent transparent var(--accent-color) transparent !important;
			border-width: 0 5px 6px 5px !important;
		}

		/* Select2 Dropdown */
		.select2-dropdown {
			border: 2px solid var(--accent-color) !important;
			border-radius: 10px !important;
			box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1) !important;
		}

		.select2-container--default .select2-results__option {
			padding: 0.75rem 1rem !important;
			font-size: 0.95rem !important;
		}

		.select2-container--default .select2-results__option--highlighted[aria-selected] {
			background-color: var(--accent-color) !important;
			color: white !important;
		}

		.select2-container--default .select2-results__option[aria-selected=true] {
			background-color: rgba(76, 175, 80, 0.1) !important;
			color: var(--primary-color) !important;
			font-weight: 600 !important;
		}

		.select2-container--default .select2-search--dropdown .select2-search__field {
			border: 2px solid #e0e0e0 !important;
			border-radius: 8px !important;
			padding: 0.5rem !important;
			font-size: 0.9rem !important;
		}

		.select2-container--default .select2-search--dropdown .select2-search__field:focus {
			border-color: var(--accent-color) !important;
			outline: none !important;
		}

		.select2-container {
			width: 100% !important;
		}

		/* Form Row */
		.form-row {
			display: grid;
			grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
			gap: 1.5rem;
		}

		/* Section Headers */
		.section-header {
			color: var(--primary-color);
			margin: 2rem 0 1.5rem;
			font-size: 1.1rem;
			border-bottom: 2px solid var(--light-gray);
			padding-bottom: 0.5rem;
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}

		.section-header:first-of-type {
			margin-top: 0;
		}

		/* FilePond Customization */
		.filepond--root {
			font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
		}

		.filepond--drop-label {
			color: #999;
		}

		.filepond--panel-root {
			background-color: white;
			border: 2px dashed #e0e0e0;
			border-radius: 10px;
		}

		.filepond--panel-root:hover {
			border-color: var(--accent-color);
			background-color: rgba(76, 175, 80, 0.03);
		}

		.filepond--item-panel {
			background-color: var(--primary-color);
		}

		.filepond--drip-blob {
			background-color: var(--accent-color);
		}

		/* File upload info text */
		.file-info {
			font-size: 0.85rem;
			color: #666;
			margin-top: 0.5rem;
			display: flex;
			align-items: center;
			gap: 0.5rem;
		}

		.file-info i {
			color: var(--info-color);
		}

		/* Buttons */
		.btn-submit {
			width: 100%;
			padding: 1rem;
			background: linear-gradient(135deg, var(--primary-color), var(--dark-blue));
			border: none;
			border-radius: 10px;
			color: white;
			font-size: 1rem;
			font-weight: 600;
			cursor: pointer;
			transition: all 0.3s ease;
			margin-top: 1rem;
			position: relative;
			overflow: hidden;
		}

		.btn-submit::before {
			content: '';
			position: absolute;
			top: 0;
			left: -100%;
			width: 100%;
			height: 100%;
			background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
			transition: left 0.5s ease;
		}

		.btn-submit:hover::before {
			left: 100%;
		}

		.btn-submit:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 25px rgba(10, 66, 117, 0.3);
		}

		.btn-submit:active {
			transform: translateY(0);
		}

		.btn-submit.loading {
			pointer-events: none;
			opacity: 0.7;
		}

		.btn-submit.loading::after {
			content: '';
			position: absolute;
			width: 20px;
			height: 20px;
			top: 50%;
			left: 50%;
			margin-left: -10px;
			margin-top: -10px;
			border: 2px solid white;
			border-radius: 50%;
			border-top-color: transparent;
			animation: spin 0.6s linear infinite;
		}

		@keyframes spin {
			to { transform: rotate(360deg); }
		}

		/* Footer */
		.registration-footer {
			padding: 1.5rem 2rem;
			background: var(--light-gray);
			text-align: center;
			font-size: 0.85rem;
			color: #666;
		}

		/* Character counter */
		.char-counter {
			color: #999;
			font-size: 0.85rem;
			margin-top: 0.5rem;
			display: block;
			text-align: right;
		}

		.char-counter.warning {
			color: var(--warning-color);
		}

		.char-counter.danger {
			color: #f44336;
		}

		/* Responsive */
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
			
			.page-header-decoration {
				font-size: 2rem;
			}
			
			.main-container {
				padding: 0 1rem 2rem;
			}

			.navbar-brand {
				font-size: 1.2rem;
			}

			.registration-body {
				padding: 2rem 1.5rem;
			}

			.form-row {
				grid-template-columns: 1fr;
			}
		}

		@media (max-width: 480px) {
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

			.registration-body {
				padding: 1.5rem 1rem;
			}
		}
	</style>
</head>
<body>
	<!-- Navbar -->
	<nav class="navbar-simple">
		<div class="container">
			<a href="<?= $route->base_url('') ?>" class="navbar-brand">
				<img src="<?= $route->base_url('public/assets/img/logo/logo-icon.png') ?>" alt="DataLab Logo" width="36" height="36" style="object-fit: contain;">
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
		<i class="fas fa-user-plus page-header-decoration decoration-1"></i>
		<i class="fas fa-file-alt page-header-decoration decoration-2"></i>
		<i class="fas fa-graduation-cap page-header-decoration decoration-3"></i>
		<i class="fas fa-award page-header-decoration decoration-4"></i>
		
		<div class="container">
			<!-- Icon -->
			<div class="page-icon">
				<i class="fas fa-user"></i>
			</div>
			
			<!-- Breadcrumb -->
			<div class="page-breadcrumb">
				<a href="<?= $route->base_url('landing_page') ?>">
					<i class="fas fa-home"></i>
					Beranda
				</a>
				<i class="fas fa-chevron-right"></i>
				<span>Pendaftaran Anggota</span>
			</div>
			
			<!-- Title -->
			<h1 class="page-title">Pendaftaran Anggota Lab</h1>
			<p class="page-subtitle">
				Lengkapi form di bawah untuk mendaftar sebagai anggota Laboratorium Data & Teknologi
			</p>
		</div>
	</div>

	<!-- Main Content -->
	<div class="main-container">
		<div class="registration-card">
			<!-- Body -->
			<div class="registration-body">
				<!-- Alert Persyaratan -->
				<div class="alert-box alert-warning">
					<i class="fas fa-exclamation-triangle"></i>
					<div>
						<strong>Persyaratan Pendaftaran:</strong>
						<ul>
							<li><strong>IPK minimal 3.00</strong> dari skala 4.00</li>
							<li>Memiliki CV yang mencantumkan pengalaman dan kemampuan</li>
							<li>Motivasi yang jelas dan terstruktur</li>
							<li>Siap berkomitmen dalam kegiatan lab</li>
						</ul>
					</div>
				</div>

				<!-- Alert Info -->
				<div class="alert-box alert-info">
					<i class="fas fa-info-circle"></i>
					<div>
						<strong>Informasi Penting:</strong><br>
						Pastikan semua data yang diisi sudah benar. Field yang bertanda <span style="color: #f44336; font-weight: 700;">*</span> wajib diisi. 
						Proses verifikasi akan dilakukan maksimal 3x24 jam setelah pendaftaran. Anda akan dihubungi melalui email atau nomor telepon yang didaftarkan.
					</div>
				</div>

				<form action="process_registration.php" method="POST" enctype="multipart/form-data" id="registrationForm">
					<!-- Data Pribadi -->
					<h3 class="section-header">
						<i class="fas fa-user"></i> Data Pribadi
					</h3>

					<div class="form-group">
						<label for="nim">NIM <span class="required">*</span></label>
						<div class="input-group-custom">
							<i class="fas fa-id-card input-icon"></i>
							<input 
								type="text" 
								name="nim" 
								id="nim"
								class="form-control-custom" 
								placeholder="Masukkan NIM" 
								required 
								maxlength="20"
							/>
						</div>
					</div>

					<div class="form-group">
						<label for="name">Nama Lengkap <span class="required">*</span></label>
						<div class="input-group-custom">
							<i class="fas fa-user input-icon"></i>
							<input 
								type="text" 
								name="name" 
								id="name"
								class="form-control-custom" 
								placeholder="Masukkan nama lengkap" 
								required 
								maxlength="100"
							/>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group">
							<label for="email">Email <span class="required">*</span></label>
							<div class="input-group-custom">
								<i class="fas fa-envelope input-icon"></i>
								<input 
									type="email" 
									name="email" 
									id="email"
									class="form-control-custom" 
									placeholder="email@example.com" 
									required 
									maxlength="100"
								/>
							</div>
						</div>

						<div class="form-group">
							<label for="phone">No. Telepon <span class="optional">(Opsional)</span></label>
							<div class="input-group-custom">
								<i class="fas fa-phone input-icon"></i>
								<input 
									type="tel" 
									name="phone" 
									id="phone"
									class="form-control-custom" 
									placeholder="08xxxxxxxxxx" 
									maxlength="20"
								/>
							</div>
						</div>
					</div>

					<!-- Data Akademik -->
					<h3 class="section-header">
						<i class="fas fa-graduation-cap"></i> Data Akademik
					</h3>

					<div class="form-group">
						<label for="program_studi">Program Studi <span class="optional">(Opsional)</span></label>
						<div class="input-group-custom">
							<i class="fas fa-book input-icon"></i>
							<input 
								type="text" 
								name="program_studi" 
								id="program_studi"
								class="form-control-custom" 
								placeholder="Contoh: Teknik Informatika" 
								maxlength="100"
							/>
						</div>
					</div>

					<div class="form-row">
						<div class="form-group">
							<label for="semester">Semester <span class="optional">(Opsional)</span></label>
							<div class="input-group-custom">
								<i class="fas fa-calendar-alt input-icon"></i>
								<select name="semester" id="semester" class="form-control-custom select2">
									<option value="">Pilih Semester</option>
									<option value="1">Semester 1</option>
									<option value="2">Semester 2</option>
									<option value="3">Semester 3</option>
									<option value="4">Semester 4</option>
									<option value="5">Semester 5</option>
									<option value="6">Semester 6</option>
									<option value="7">Semester 7</option>
									<option value="8">Semester 8</option>
									<option value="9">Semester 9</option>
									<option value="10">Semester 10</option>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="ipk">IPK <span class="required">*</span></label>
							<div class="input-group-custom">
								<i class="fas fa-chart-line input-icon"></i>
								<input 
									type="number" 
									name="ipk" 
									id="ipk"
									class="form-control-custom" 
									placeholder="Minimal 3.00" 
									required 
									min="3.00" 
									max="4.00" 
									step="0.01"
								/>
							</div>
							<small style="color: #e65100; font-size: 0.85rem; margin-top: 0.5rem; display: block;">
								<i class="fas fa-info-circle"></i> IPK minimal 3.00 dari skala 4.00
							</small>
						</div>
					</div>

					<!-- Dokumen -->
					<h3 class="section-header">
						<i class="fas fa-file-alt"></i> Dokumen
					</h3>

					<div class="form-group">
						<label for="cv">Curriculum Vitae (CV) <span class="required">*</span></label>
						<input 
							type="file" 
							name="cv" 
							id="cv"
							class="filepond"
							required
							data-max-file-size="5MB"
							data-max-files="1"
						/>
						<div class="file-info">
							<i class="fas fa-info-circle"></i>
							<span>Format: PDF, DOC, DOCX | Maksimal 5MB</span>
						</div>
					</div>

					<div class="form-group">
						<label for="portfolio">Portfolio <span class="optional">(Opsional)</span></label>
						<input 
							type="file" 
							name="portfolio" 
							id="portfolio"
							class="filepond"
							data-max-file-size="10MB"
							data-max-files="1"
						/>
						<div class="file-info">
							<i class="fas fa-info-circle"></i>
							<span>Format: PDF, DOC, DOCX, ZIP | Maksimal 10MB</span>
						</div>
					</div>

					<!-- Motivasi -->
					<h3 class="section-header">
						<i class="fas fa-pen"></i> Motivasi
					</h3>

					<div class="form-group">
						<label for="motivation">Motivasi Bergabung <span class="required">*</span></label>
						<textarea 
							name="motivation" 
							id="motivation"
							class="form-control-custom" 
							placeholder="Jelaskan motivasi Anda bergabung dengan DataLab, pengalaman yang relevan, dan kontribusi yang ingin Anda berikan..." 
							required
							maxlength="1000"
						></textarea>
						<small class="char-counter" id="charCount">0/1000 karakter</small>
					</div>

					<button type="submit" class="btn-submit" id="submitBtn">
						<span><i class="fas fa-paper-plane"></i> Kirim Pendaftaran</span>
					</button>
				</form>
			</div>

			<!-- Footer -->
			<div class="registration-footer">
				<p>&copy; 2024 DataLab. All rights reserved.</p>
			</div>
		</div>
	</div>

	<!-- FilePond JS -->
	<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
	<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
	<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
	<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.all.min.js"></script>
    <script src="<?= $route->base_url('public/js/jquery-3.7.1.min.js') ?>"></script>
	<script src="<?= $route->base_url('public/assets/plugins/select2/dist/js/select2.min.js') ?>"></script>

    <script>
		// Register FilePond plugins
		FilePond.registerPlugin(
			FilePondPluginFileValidateType,
			FilePondPluginFileValidateSize
		);

		// Function to initialize FilePond
		function initFilePond(selector, options = {}) {
			return FilePond.create(document.querySelector(selector), {
				storeAsFile: true,
				allowMultiple: false,
				instantUpload: false,
				credits: false,
				...options
			});
		}

		const cvPond = initFilePond('#cv', {
			labelIdle: 'Drag & Drop CV atau <span class="filepond--label-action">Browse</span>',
			acceptedFileTypes: ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'],
			maxFileSize: '5MB',
			labelMaxFileSizeExceeded: 'File terlalu besar',
			labelMaxFileSize: 'Maksimal ukuran file adalah {filesize}',
			labelFileTypeNotAllowed: 'Tipe file tidak valid',
			fileValidateTypeLabelExpectedTypes: 'Harap upload file PDF, DOC, atau DOCX'
		});

		const portfolioPond = initFilePond('#portfolio', {
			labelIdle: 'Drag & Drop Portfolio atau <span class="filepond--label-action">Browse</span>',
			acceptedFileTypes: ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/x-zip-compressed'],
			maxFileSize: '10MB',
			labelMaxFileSizeExceeded: 'File terlalu besar',
			labelMaxFileSize: 'Maksimal ukuran file adalah {filesize}',
			labelFileTypeNotAllowed: 'Tipe file tidak valid',
			fileValidateTypeLabelExpectedTypes: 'Harap upload file PDF, DOC, DOCX, atau ZIP'
		});

		function swalConfirm(message, yesCallback) {
            Swal.fire({
                title: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                cancelButtonText: 'Batal',
                customClass: {
					confirmButton: 'btn btn-primary btn-md px-4 mr-1',
					cancelButton: 'btn btn-danger btn-md px-4'
				},
            }).then((result) => {
                if (result.isConfirmed) {
                    if (typeof yesCallback === "function") yesCallback();
                }
            });
        }

		$(document).ready(function() {
			$('#semester').select2({
				width: '100%',
				placeholder: 'Pilih Semester',
				allowClear: true
			});

			$('#motivation').on('input', function() {
				const length = $(this).val().length;
				const charCount = $('#charCount');
				charCount.text(`${length}/1000 karakter`);
				
				charCount.removeClass('warning danger');
				
				if (length > 950) {
					charCount.addClass('danger');
				} else if (length > 800) {
					charCount.addClass('warning');
				}
			});

			$('#ipk').on('input', function() {
				let value = parseFloat($(this).val());
				if (value > 4) {
					$(this).val(4);
				}
				if (value < 0) {
					$(this).val(0);
				}
			});

			$('#ipk').on('blur', function() {
				const value = $(this).val();
				if (value && parseFloat(value) < 3.00) {
					Swal.fire({
						icon: 'warning',
						title: 'IPK Tidak Memenuhi Syarat',
						text: 'Minimal IPK untuk mendaftar adalah 3.00'
					});
					$(this).val('');
					$(this).focus();
				}
			});

			$('#phone').on('input', function() {
				$(this).val($(this).val().replace(/[^0-9]/g, ''));
			});

			$('#registrationForm').on('submit', function(e) {
				e.preventDefault();

				const ipk = parseFloat($('#ipk').val());
				const btn = $('#submitBtn');

				if (ipk < 3.00) {
					Swal.fire({
						icon: 'warning',
						title: 'IPK Tidak Memenuhi Syarat',
						text: 'Minimal IPK untuk mendaftar adalah 3.00',
					});
					$('#ipk').focus();
					return false;
				}

				const cvFiles = cvPond.getFiles();
				if (cvFiles.length === 0) {
					Swal.fire({
						icon: 'warning',
						title: 'CV Wajib Diupload',
						text: 'Harap upload CV Anda sebelum mengirim formulir.',
					});
					return false;
				}

				btn.addClass('loading');
				btn.find('span').css('opacity', '0');

				const formData = new FormData(this);

				if (cvFiles.length > 0) {
					formData.append('cv', cvFiles[0].file);
				}

				const portfolioFiles = portfolioPond.getFiles();
				if (portfolioFiles.length > 0) {
					formData.append('portfolio', portfolioFiles[0].file);
				}
				
				swalConfirm('Submit data ini?', function() {

					$.ajax({
						url: '<?php echo $route->base_url("landing_page/pendaftaran/daftar"); ?>',
						type: 'POST',
						data: formData,
						processData: false,
						contentType: false,
						dataType: 'json',

						success: function(data) {
							btn.removeClass('loading');
							btn.find('span').css('opacity', '1');

							if (data.success) {
								Swal.fire({
									icon: 'success',
									title: 'Pendaftaran Berhasil!',
									html: `
										${data.message}<br><br>
										Anda akan dihubungi melalui email yang didaftarkan.<br>
										<b>Terima kasih telah mendaftar!</b>
									`
								}).then(() => {
									window.location.href = "<?= $route->base_url('landing_page') ?>";
								});

								$('#registrationForm')[0].reset();
								cvPond.removeFiles();
								portfolioPond.removeFiles();
								$('#charCount').text('0/1000 karakter').removeClass('warning danger');
								$('#semester').val(null).trigger('change');

							} else {
								Swal.fire({
									icon: 'error',
									title: 'Pendaftaran Gagal',
									text: data.message || 'Terjadi kesalahan.',
								});
							}
						},

						error: function(xhr, status, error) {
							btn.removeClass('loading');
							btn.find('span').css('opacity', '1');

							let errorMessage = 'Terjadi kesalahan saat mengirim data';
							let errorList = '';

							if (xhr.responseJSON) {
								if (xhr.responseJSON.message) {
									errorMessage = xhr.responseJSON.message;
								}
								if (xhr.responseJSON.errors) {
									Object.values(xhr.responseJSON.errors).forEach(err => {
										errorList += `<li>${err}</li>`;
									});
								}
							}

							if (errorList !== '') {
								Swal.fire({
									icon: 'error',
									title: 'Validasi Gagal',
									html: `
										<div style="
											text-align:left;
											margin-top:15px;
											padding:10px 15px;
											border-radius:8px;
											background:#f8d7da;
											color:#842029;
											font-size:14px;
											line-height:1.6;
										">
											<ul style="padding-left: 20px; margin:0;">
												${errorList}
											</ul>
										</div>
									`
								});
							} else {
								Swal.fire({
									icon: 'error',
									title: 'Error',
									text: errorMessage,
								});
							}

						}
					});
   				});

				return false;
			});

		});
    </script>
</body>
</html>