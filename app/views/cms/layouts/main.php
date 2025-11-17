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


    <!-- cdn -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.min.css" rel="stylesheet">
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="public/assets/plugins/pace/pace.min.js"></script>
    <script src="public/js/jquery-3.7.1.min.js"></script>
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
	<script src="public/assets/plugins/jquery/jquery-3.3.1.min.js"></script>
	<script src="public/assets/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="public/assets/plugins/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
	<!--[if lt IE 9]>
		<script src="public/assets/crossbrowserjs/html5shiv.js"></script>
		<script src="public/assets/crossbrowserjs/respond.min.js"></script>
		<script src="public/assets/crossbrowserjs/excanvas.min.js"></script>
	<![endif]-->
	<script src="public/assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
	<script src="public/assets/plugins/js-cookie/js.cookie.js"></script>
	<script src="public/assets/js/theme/default.min.js"></script>
	<script src="public/assets/js/apps.min.js"></script>
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

    <!-- cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.all.min.js"></script>
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
	</script>
</body>
</html>
