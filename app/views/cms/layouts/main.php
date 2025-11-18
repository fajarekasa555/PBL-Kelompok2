<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>CMS</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />

	<style>
		.select2-color-admin .select2-results__option {
			font-size: 12px !important;
		}

		.select2-color-admin .select2-selection__choice {
			font-size: 12px !important;
		}
	</style>
	<style>

		body, html, .table, .btn, .form-control, .select2, .dataTables_wrapper {
			font-family: 'Inter', sans-serif !important;
			font-size: 14px;
		}


		/* Container */
		.dataTables_wrapper {
			padding: 10px;
		}

		/* Search box */
		.dataTables_filter input {
			border: 1px solid #ddd !important;
			padding: 6px 10px;
			border-radius: 8px;
			outline: none;
			transition: 0.2s;
		}

		.dataTables_filter input:focus {
			border-color: #1a73e8 !important;
			box-shadow: 0 0 0 3px rgba(26,115,232,0.15);
		}

		/* Length dropdown */
		.dataTables_length select {
			border: 1px solid #ddd !important;
			border-radius: 8px;
			padding: 5px 10px;
		}

		/* Table Header */
		table.dataTable thead th {
			background: #f8f9fc !important;
			border-bottom: 2px solid #e5e5e5 !important;
			font-weight: 600;
			color: #333;
			padding: 12px 10px;
		}

		/* Row hover */
		table.dataTable tbody tr:hover {
			background-color: #f5f9ff !important;
		}

		/* Table body */
		table.dataTable tbody td {
			padding: 10px 8px !important;
			border-color: #f0f0f0;
		}

		/* Info text */
		.dataTables_info {
			color: #555;
			font-size: 13px;
		}

		/* Responsive row details */
		table.dataTable.dtr-inline.collapsed > tbody > tr > td:first-child:before {
			top: 50%;
			transform: translateY(-50%);
			background-color: #1a73e8 !important;
		}
	</style>
	<style>
		:root {
			--gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
			--gradient-danger: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
			--gradient-success: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
			--gradient-warning: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
			--shadow-sm: 0 2px 8px rgba(0,0,0,0.08);
			--shadow-md: 0 4px 16px rgba(0,0,0,0.12);
			--shadow-lg: 0 8px 24px rgba(0,0,0,0.15);
		}

		.page-header {
			font-size: 2rem;
			font-weight: 700;
			color: #1e293b;
			margin-bottom: 1.5rem;
			position: relative;
			padding-left: 20px;
		}

		.page-header::before {
			content: '';
			position: absolute;
			left: 0;
			top: 50%;
			transform: translateY(-50%);
			width: 5px;
			height: 32px;
			border-radius: 3px;
		}

		.stat-card {
			border: none;
			border-radius: 16px;
			overflow: hidden;
			transition: all 0.3s ease;
			box-shadow: var(--shadow-sm);
			position: relative;
		}

		.stat-card:hover {
			transform: translateY(-5px);
			box-shadow: var(--shadow-lg);
		}

		.stat-card .card-body {
			padding: 1.75rem;
			background: white;
			position: relative;
			overflow: hidden;
		}

		.stat-card .gradient-overlay {
			position: absolute;
			top: 0;
			left: 0;
			right: 0;
			height: 5px;
		}

		.stat-card.card-primary .gradient-overlay {
			background: var(--gradient-primary);
		}

		.stat-card.card-danger .gradient-overlay {
			background: var(--gradient-danger);
		}

		.stat-card.card-success .gradient-overlay {
			background: var(--gradient-success);
		}

		.stat-card.card-warning .gradient-overlay {
			background: var(--gradient-warning);
		}

		.stat-icon {
			width: 56px;
			height: 56px;
			border-radius: 14px;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 1.5rem;
			transition: all 0.3s ease;
		}

		.stat-card.card-primary .stat-icon {
			background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
			color: #667eea;
		}

		.stat-card.card-danger .stat-icon {
			background: linear-gradient(135deg, rgba(240, 147, 251, 0.1) 0%, rgba(245, 87, 108, 0.1) 100%);
			color: #f5576c;
		}

		.stat-card.card-success .stat-icon {
			background: linear-gradient(135deg, rgba(79, 172, 254, 0.1) 0%, rgba(0, 242, 254, 0.1) 100%);
			color: #00d4ff;
		}

		.stat-card.card-warning .stat-icon {
			background: linear-gradient(135deg, rgba(250, 112, 154, 0.1) 0%, rgba(254, 225, 64, 0.1) 100%);
			color: #fa709a;
		}

		.stat-card:hover .stat-icon {
			transform: scale(1.1) rotate(5deg);
		}

		.stat-label {
			font-size: 0.875rem;
			color: #64748b;
			font-weight: 600;
			text-transform: uppercase;
			letter-spacing: 0.5px;
			margin-bottom: 0.5rem;
		}

		.stat-value {
			font-size: 2rem;
			font-weight: 700;
			color: #1e293b;
			margin: 0;
		}

		.chart-card {
			border: none;
			border-radius: 16px;
			box-shadow: var(--shadow-sm);
			transition: all 0.3s ease;
			background: white;
			overflow: hidden;
		}

		.chart-card:hover {
			box-shadow: var(--shadow-md);
		}

		.chart-card .card-header {
			background: white;
			border-bottom: 1px solid #f1f5f9;
			padding: 1.25rem 1.5rem;
			font-weight: 600;
			color: #1e293b;
			font-size: 1rem;
		}

		.chart-card .card-body {
			padding: 1.5rem;
		}

		@media (max-width: 768px) {
			.stat-value {
				font-size: 1.5rem;
			}
			
			.stat-icon {
				width: 48px;
				height: 48px;
				font-size: 1.25rem;
			}
		}
	</style>
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="public/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
    <link href="public/assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
	<link href="public/assets/plugins/font-awesome/5.3/css/all.min.css" rel="stylesheet" />
	<link href="public/assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="public/assets/css/default/style.min.css" rel="stylesheet" />
	<link href="public/assets/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="public/assets/css/default/theme/default.css" rel="stylesheet" id="theme" />
	<!-- ================== END BASE CSS STYLE ================== -->


    <link href="public/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="public/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="public/assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css" rel="stylesheet">

    	<!-- ================== BEGIN PAGE LEVEL STYLE ================== -->
	<link href="public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="public/assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.css" rel="stylesheet" />
	<link href="public/assets/plugins/ionRangeSlider/css/ion.rangeSlider.css" rel="stylesheet" />
	<link href="public/assets/plugins/ionRangeSlider/css/ion.rangeSlider.skinNice.css" rel="stylesheet" />
	<link href="public/assets/plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css" rel="stylesheet" />
	<link href="public/assets/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css" rel="stylesheet" />
	<link href="public/assets/plugins/password-indicator/css/password-indicator.css" rel="stylesheet" />
	<link href="public/assets/plugins/bootstrap-combobox/css/bootstrap-combobox.css" rel="stylesheet" />
	<link href="public/assets/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	<link href="public/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css" rel="stylesheet" />
	<link href="public/assets/plugins/jquery-tag-it/css/jquery.tagit.css" rel="stylesheet" />
	<link href="public/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
	<link href="public/assets/plugins/select2/dist/css/select2.min.css" rel="stylesheet" />
	<link href="public/assets/plugins/bootstrap-eonasdan-datetimepicker/build/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
	<link href="public/assets/plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css" rel="stylesheet" />
	<link href="public/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.css" rel="stylesheet" />
	<link href="public/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-fontawesome.css" rel="stylesheet" />
	<link href="public/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker-glyphicons.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL STYLE ================== -->

		<!-- ================== BEGIN PAGE LEVEL CSS STYLE ================== -->
	<link href="public/assets/plugins/jquery-jvectormap/jquery-jvectormap.css" rel="stylesheet" />
	<link href="public/assets/plugins/bootstrap-calendar/css/bootstrap_calendar.css" rel="stylesheet" />
	<link href="public/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<link href="public/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
	<!-- ================== END PAGE LEVEL CSS STYLE ================== -->

    <!-- cdn -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.min.css" rel="stylesheet">
	<link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
	<link href="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.css" rel="stylesheet"/>
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="public/assets/js/theme/default.min.js"></script>
	<script src="public/assets/js/apps.min.js"></script>
	<script src="public/assets/plugins/pace/pace.min.js"></script>
    <script src="public/js/jquery-3.7.1.min.js"></script>
	<script src="public/assets/plugins/chart-js/Chart.min.js"></script>
	<script src="public/assets/js/demo/chart-js.demo.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body class="theme-default">
    <?php
        use App\Helpers\Routing;

        $route = new Routing();
    ?>
    <?php $page = $_GET['page'] ?? ''; ?>
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>
    <div id="page-container" class="fade page-sidebar-fixed page-header-fixed">
        <?php include __DIR__ . '/partials/header.php'; ?>
        <?php include __DIR__ . '/sidebar/main.php'; ?>
        <div id="content" class="content">
            <?php echo $content; ?>
        </div>
    </div>
	
	<!-- ================== BEGIN BASE JS ================== -->
	<!-- <script src="public/assets/plugins/jquery/jquery-3.3.1.min.js"></script> -->
	<script src="public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="public/assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
	<!--[if lt IE 9]>
		<script src="public/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="public/assets/crossbrowserjs/respond.min.js"></script>
		<script src="public/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="public/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="public/assets/plugins/js-cookie/js.cookie.js"></script>
    <script src="public/assets/js/demo/form-plugins.demo.js"></script>
    <script src="public/assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="public/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
    <script src="public/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="public/assets/plugins/DataTables/extensions/Select/js/dataTables.select.min.js"></script>
    <script src="public/assets/plugins/DataTables/extensions/TreeGrid/dataTables.treeGrid.js"></script>

    <script src="public/assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script src="public/assets/plugins/ionRangeSlider/js/ion-rangeSlider/ion.rangeSlider.min.js"></script>
	<script src="public/assets/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
	<script src="public/assets/plugins/masked-input/masked-input.min.js"></script>
	<script src="public/assets/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
	<script src="public/assets/plugins/password-indicator/js/password-indicator.js"></script>
	<script src="public/assets/plugins/bootstrap-combobox/js/bootstrap-combobox.js"></script>
	<script src="public/assets/plugins/bootstrap-select/bootstrap-select.min.js"></script>
	<script src="public/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>
	<script src="public/assets/plugins/bootstrap-tagsinput/bootstrap-tagsinput-typeahead.js"></script>
	<script src="public/assets/plugins/jquery-tag-it/js/tag-it.min.js"></script>
	<script src="public/assets/plugins/bootstrap-daterangepicker/moment.js"></script>
	<script src="public/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="public/assets/plugins/select2/dist/js/select2.min.js"></script>
	<script src="public/assets/plugins/bootstrap-eonasdan-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
	<script src="public/assets/plugins/bootstrap-show-password/bootstrap-show-password.js"></script>
	<script src="public/assets/plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
	<script src="public/assets/plugins/jquery-simplecolorpicker/jquery.simplecolorpicker.js"></script>
	<script src="public/assets/plugins/clipboard/clipboard.min.js"></script>
	<script src="public/assets/js/demo/form-plugins.demo.min.js"></script>

		<!-- ================== BEGIN PAGE LEVEL JS ================== -->
	<script src="public/assets/plugins/d3/d3.min.js"></script>
	<script src="public/assets/plugins/nvd3/build/nv.d3.js"></script>
	<script src="public/assets/plugins/jquery-jvectormap/jquery-jvectormap.min.js"></script>
	<script src="public/assets/plugins/jquery-jvectormap/jquery-jvectormap-world-merc-en.js"></script>
	<script src="public/assets/plugins/bootstrap-calendar/js/bootstrap_calendar.min.js"></script>
	<script src="public/assets/plugins/gritter/js/jquery.gritter.js"></script>
	<script src="public/assets/js/demo/dashboard-v2.min.js"></script>
	<!-- ================== END PAGE LEVEL JS ================== -->

    <!-- cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.all.min.js"></script>
	<script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
	<script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
	<script src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
	<script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
            FormPlugins.init();
		});
        
        function swalConfirm(message, yesCallback) {
            Swal.fire({
                title: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
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

		FilePond.registerPlugin(
			FilePondPluginImagePreview,
			FilePondPluginFileValidateType,
			FilePondPluginFileValidateSize
		);
	</script>
</body>
</html>
