<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>DataLab CMS - Login</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<link rel="icon" type="image/png" href="public/assets/img/logo/logo-icon.png" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@400;500;600;700&display=swap" rel="stylesheet" />
	<link href="public/assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
	<link href="public/assets/plugins/font-awesome/5.3/css/all.min.css" rel="stylesheet" />
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<style>
		:root {
			--primary-color: #0a4275;
			--secondary-color: #64b5f6;
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
			/* background: linear-gradient(135deg, var(--primary-color) 0%, var(--dark-blue) 100%); */
			background-image: url('public/assets/img/login-bg/login-bg-3.jpg');
			min-height: 100vh;
			display: flex;
			align-items: center;
			justify-content: center;
			padding: 20px;
			position: relative;
			overflow: hidden;
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
		}

		@keyframes float {
			0%, 100% { transform: translateY(0); }
			50% { transform: translateY(-20px); }
		}

		/* Login Card */
		.login-container {
			position: relative;
			z-index: 1;
			width: 100%;
			max-width: 450px;
		}

		.login-card {
			background: white;
			border-radius: 20px;
			box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
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

		.login-header {
			background: linear-gradient(135deg, var(--primary-color), var(--dark-blue));
			padding: 2.5rem 2rem;
			text-align: center;
			color: white;
			position: relative;
			overflow: hidden;
		}

		.login-header::before {
			content: '';
			position: absolute;
			top: -50%;
			right: -50%;
			width: 200%;
			height: 200%;
			background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
			animation: pulse 3s ease-in-out infinite;
		}

		@keyframes pulse {
			0%, 100% { transform: scale(1); opacity: 0.5; }
			50% { transform: scale(1.1); opacity: 0.8; }
		}

		.login-logo {
			width: 70px;
			height: 70px;
			background: rgba(255, 255, 255, 0.2);
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			margin: 0 auto 1rem;
			backdrop-filter: blur(10px);
			border: 2px solid rgba(255, 255, 255, 0.3);
		}

		.login-logo i {
			font-size: 2rem;
			color: white;
		}

		.login-header h1 {
			font-size: 1.75rem;
			font-weight: 700;
			margin-bottom: 0.5rem;
			position: relative;
		}

		.login-header p {
			font-size: 0.9rem;
			opacity: 0.9;
			margin: 0;
			position: relative;
		}

		.login-body {
			padding: 2.5rem 2rem;
		}

		/* Alert */
		.alert-custom {
			background: linear-gradient(135deg, rgba(244, 67, 54, 0.1), rgba(229, 115, 115, 0.1));
			border: none;
			border-left: 4px solid #f44336;
			border-radius: 10px;
			padding: 1rem;
			margin-bottom: 1.5rem;
			color: #f44336;
			font-size: 0.9rem;
			display: flex;
			align-items: center;
		}

		.alert-custom i {
			margin-right: 0.75rem;
			font-size: 1.2rem;
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

		.input-group-custom {
			position: relative;
		}

		.input-icon {
			position: absolute;
			left: 1rem;
			top: 50%;
			transform: translateY(-50%);
			color: var(--secondary-color);
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
			border-color: var(--secondary-color);
			box-shadow: 0 0 0 4px rgba(100, 181, 246, 0.1);
		}

		.form-control-custom::placeholder {
			color: #999;
		}

		/* Button */
		.btn-login {
			width: 100%;
			padding: 1rem;
			background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
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

		.btn-login::before {
			content: '';
			position: absolute;
			top: 0;
			left: -100%;
			width: 100%;
			height: 100%;
			background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
			transition: left 0.5s ease;
		}

		.btn-login:hover::before {
			left: 100%;
		}

		.btn-login:hover {
			transform: translateY(-2px);
			box-shadow: 0 10px 25px rgba(10, 66, 117, 0.3);
		}

		.btn-login:active {
			transform: translateY(0);
		}

		/* Footer */
		.login-footer {
			padding: 1.5rem 2rem;
			background: var(--light-gray);
			text-align: center;
			font-size: 0.85rem;
			color: #666;
		}

		.login-footer a {
			color: var(--primary-color);
			text-decoration: none;
			font-weight: 600;
			transition: color 0.3s ease;
		}

		.login-footer a:hover {
			color: var(--secondary-color);
		}

		/* Responsive */
		@media (max-width: 576px) {
			.login-header h1 {
				font-size: 1.5rem;
			}

			.login-body {
				padding: 2rem 1.5rem;
			}

			.login-logo {
				width: 60px;
				height: 60px;
			}

			.login-logo i {
				font-size: 1.75rem;
			}
		}

		/* Loading State */
		.btn-login.loading {
			pointer-events: none;
			opacity: 0.7;
		}

		.btn-login.loading::after {
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
	</style>
</head>
<body>
	<div class="login-container">
		<div class="login-card">
			<!-- Login Header -->
			<div class="login-header">
				<div class="login-logo">
					<i class="fas fa-flask"></i>
				</div>
				<h1>DataLab CMS</h1>
				<p>Content Management System</p>
			</div>

			<!-- Login Body -->
			<div class="login-body">
				<?php if (!empty($error)): ?>
				<div class="alert-custom">
					<i class="fas fa-exclamation-circle"></i>
					<span><?php echo htmlspecialchars($error); ?></span>
				</div>
				<?php endif; ?>

				<form action="" method="POST" id="loginForm">
					<div class="form-group">
						<label for="username">Username</label>
						<div class="input-group-custom">
							<i class="fas fa-user input-icon"></i>
							<input 
								type="text" 
								name="username" 
								id="username"
								class="form-control-custom" 
								placeholder="Masukkan username" 
								required 
								autocomplete="username"
							/>
						</div>
					</div>

					<div class="form-group">
						<label for="password">Password</label>
						<div class="input-group-custom">
							<i class="fas fa-lock input-icon"></i>
							<input 
								type="password" 
								name="password" 
								id="password"
								class="form-control-custom" 
								placeholder="Masukkan password" 
								required 
								autocomplete="current-password"
							/>
						</div>
					</div>

					<button type="submit" class="btn-login" id="loginBtn">
						<span>Masuk</span>
					</button>
				</form>
			</div>

			<!-- Login Footer -->
			<div class="login-footer">
				<p>&copy; 2024 DataLab. All rights reserved.</p>
			</div>
		</div>
	</div>

	<!-- ================== BEGIN BASE JS ================== -->
	<script src="public/assets/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="public/assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
	<!-- ================== END BASE JS ================== -->

	<script>
		// Loading state saat form disubmit
		document.getElementById('loginForm').addEventListener('submit', function() {
			const btn = document.getElementById('loginBtn');
			btn.classList.add('loading');
			btn.querySelector('span').style.opacity = '0';
		});

		// Auto focus pada username field
		document.addEventListener('DOMContentLoaded', function() {
			document.getElementById('username').focus();
		});

		// Enter key navigation
		document.getElementById('username').addEventListener('keypress', function(e) {
			if (e.key === 'Enter') {
				e.preventDefault();
				document.getElementById('password').focus();
			}
		});
	</script>
</body>
</html>