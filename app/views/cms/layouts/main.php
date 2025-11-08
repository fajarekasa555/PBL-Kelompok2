<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
	<meta charset="utf-8" />
	<title>Color Admin | HTML Startup</title>
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	
	<!-- ================== BEGIN BASE CSS STYLE ================== -->
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="public/assets/plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet" />
	<link href="public/assets/plugins/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
	<link href="public/assets/plugins/font-awesome/5.2/css/all.min.css" rel="stylesheet" />
	<link href="public/assets/plugins/animate/animate.min.css" rel="stylesheet" />
	<link href="public/assets/css/default/style.min.css" rel="stylesheet" />
	<link href="public/assets/css/default/style-responsive.min.css" rel="stylesheet" />
	<link href="public/assets/css/default/theme/default.css" rel="stylesheet" />
    <link href="public/assets/plugins/DataTables/media/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="public/assets/plugins/DataTables/extensions/Responsive/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="public/assets/plugins/DataTables/extensions/Select/css/select.bootstrap.min.css" rel="stylesheet">

    <!-- cdn -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.min.css" rel="stylesheet">
	<!-- ================== END BASE CSS STYLE ================== -->
	
	<!-- ================== BEGIN BASE JS ================== -->
	<script src="public/assets/plugins/pace/pace.min.js"></script>
    <script src="public/js/jquery-3.7.1.min.js"></script>
	<!-- ================== END BASE JS ================== -->
</head>
<body>
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
    <script src="public/assets/plugins/DataTables/media/js/jquery.dataTables.js"></script>
    <script src="public/assets/plugins/DataTables/media/js/dataTables.bootstrap.min.js"></script>
    <script src="public/assets/plugins/DataTables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
    <script src="public/assets/plugins/DataTables/extensions/Select/js/dataTables.select.min.js"></script>
    <script src="public/assets/plugins/DataTables/extensions/TreeGrid/dataTables.treeGrid.js"></script>

    <!-- cdn -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.26.3/dist/sweetalert2.all.min.js"></script>
	<!-- ================== END BASE JS ================== -->
	
	<script>
		$(document).ready(function() {
			App.init();
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
