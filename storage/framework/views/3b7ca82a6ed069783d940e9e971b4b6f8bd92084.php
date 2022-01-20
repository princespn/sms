<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
	<head>
		<!-- Meta data -->
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="author" content="">
	    <meta name="keywords" content="">
	    <meta name="description" content="">
		
        <!-- CSRF Token -->
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <!-- Title -->
        <title><?php echo e(config('app.name')); ?></title>

        <!--CSS Files -->
        <link href="<?php echo e(URL::asset('plugins/bootstrap/css/bootstrap.min.css')); ?>" rel="stylesheet">
	    <link href="<?php echo e(URL::asset('plugins/awselect/awselect.min.css')); ?>" rel="stylesheet" />

		<?php echo $__env->make('layouts.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

	</head>

	<body class="app sidebar-mini">

        <!-- LOADER -->
		<div id="global-loader" >
			<img src="<?php echo e(URL::asset('img/svgs/loader.svg')); ?>" alt="loader">           
		</div>
		<!-- END LOADER -->

		<!-- Page -->
		<div class="page">
			<div class="page-main">
				
				<!-- App-Content -->			
				<div class="main-content">
					<div class="side-app">

						<?php echo $__env->yieldContent('content'); ?>

					</div>                   
				</div>
		
		</div><!-- End Page -->

		<?php echo $__env->make('layouts.footer-scripts-guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        
	</body>
</html>


<?php /**PATH /home/661037.cloudwaysapps.com/fuxkpjgyyd/public_html/resources/views/layouts/auth.blade.php ENDPATH**/ ?>