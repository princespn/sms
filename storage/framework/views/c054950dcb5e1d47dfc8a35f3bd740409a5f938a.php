

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('My Profile')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('user.tts')); ?>"><i class="mdi mdi-account-settings-variant mr-2 fs-12"></i><?php echo e(__('User')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('My Profile Settings')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('My Profile')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- USER PROFILE PAGE -->
	<div class="row">
		<div class="col-xl-3 col-lg-3 col-md-12">
			<div class="card border-0">
				<div class="widget-user-image overflow-hidden mx-auto mt-5"><img alt="User Avatar" class="rounded-circle" src="<?php if(auth()->user()->profile_photo_path): ?><?php echo e(asset(auth()->user()->profile_photo_path)); ?> <?php else: ?> <?php echo e(URL::asset('img/users/avatar.jpg')); ?> <?php endif; ?>"></div>
				<div class="card-body text-center">
					<div>
						<h4 class="mb-1 mt-1 font-weight-bold fs-16"><?php echo e(auth()->user()->name); ?></h4>
						<h6 class="text-muted fs-12"><?php echo e(auth()->user()->job_role); ?></h6>
						<?php if($user_subscription != ''): ?>
							<h6 class="text-muted fs-12">Active Subscription Plan: <span class="text-info"><?php echo e($user_subscription->plan_name); ?></span></h6>
						<?php endif; ?>
						<a href="<?php echo e(route('user.profile.edit')); ?>" class="btn btn-primary mt-3 mb-2"><i class="fa fa-pencil mr-1"></i> <?php echo e(__('Edit Profile')); ?></a>
					</div>
				</div>
				<div class="card-footer p-0">
					<div class="row">
						<div class="col-sm-6 border-right text-center">
							<div class="p-4">
								<h5 class="mb-1 font-weight-bold text-highlight number-font fs-14"><?php echo config('payment.default_system_currency_symbol'); ?><?php echo e(number_format(auth()->user()->balance)); ?></h5>
								<span class="text-muted fs-14"><?php echo e(__('Current Balance')); ?></span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="text-center p-4">
								<h5 class="mb-1 font-weight-bold text-highlight number-font fs-14"><?php echo e(number_format(auth()->user()->available_chars)); ?></h5>
								<span class="text-muted fs-14"><?php echo e(__('Available Characters')); ?></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="card border-0">
				<div class="card-body">
					<h4 class="card-title mb-4 mt-1"><?php echo e(__('Personal Details')); ?></h4>
					<div class="table-responsive">
						<table class="table mb-0">
							<tbody>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Full Name')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->name); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Job Role ')); ?></span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->job_role); ?></td>
								</tr>								
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Company')); ?></span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->company); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50">Website </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->website); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('City')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->city); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Country')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->country); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Email')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->email); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Phone')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->phone_number); ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Language')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php if($language): ?> <?php echo e($language->language); ?> <?php endif; ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Voice')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php if($voice): ?> <?php echo e($voice->voice); ?> <?php endif; ?></td>
								</tr>
								<tr>
									<td class="py-2 px-0">
										<span class="font-weight-semibold w-50"><?php echo e(__('Default Project')); ?> </span>
									</td>
									<td class="py-2 px-0"><?php echo e(auth()->user()->project); ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xl-9 col-lg-9 col-md-12">
			<div class="card border-0">				
				<div class="card-body">					
					<div class="row">
						<div class="col-lg-4 col-md-12 col-xm-12">
							<div class="card overflow-hidden border-0 special-shadow">
								<div class="card-body">
									<p class=" mb-0 fs-12 font-weight-bold"><?php echo e(__('Standard Characters Used')); ?></p>
									<p class=" mb-3 fs-10 text-muted">(<?php echo e(__('Current Month')); ?>)</p>
									<h2 class="mb-2 number-font-light"><?php echo e(number_format($user_data_month['total_standard_chars'][0]['data'])); ?></h2>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-xm-12">
							<div class="card overflow-hidden border-0 special-shadow">
								<div class="card-body">
									<p class=" mb-0 fs-12 font-weight-bold"><?php echo e(__('Neural Characters Used')); ?></p>
									<p class=" mb-3 fs-10 text-muted">(<?php echo e(__('Current Month')); ?>)</p>
									<h2 class="mb-2 number-font-light"><?php echo e(number_format($user_data_month['total_neural_chars'][0]['data'])); ?></h2>
								</div>
							</div>
						</div>
						<div class="col-lg-4 col-md-12 col-xm-12">
							<div class="card overflow-hidden border-0 special-shadow">
								<div class="card-body">
									<p class=" mb-0 fs-12 font-weight-bold"><?php echo e(__('Audio Files Created')); ?></p>
									<p class=" mb-3 fs-10 text-muted">(<?php echo e(__('Current Month')); ?>)</p>
									<h2 class="mb-2 number-font-light"><?php echo e(number_format($user_data_month['total_audio_files'][0]['data'])); ?></h2>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12">
							<div class="card border-0 special-shadow">
								<div class="card-header">
									<h3 class="card-title"><?php echo e(__('Character Usage ')); ?><span class="text-muted">(<?php echo e(__('Current Year')); ?>)</span></h3>
								</div>
								<div class="card-body">
									<div class="row mb-5 mt-2">	
										<div class="col-xl-3 col-12 ">
											<p class=" mb-1 fs-12"><?php echo e(__('Total Standard Characters Used')); ?></p>
											<h3 class="mb-0 fs-20 number-font"><?php echo e(number_format($user_data_year['total_standard_chars'][0]['data'])); ?></h3>
										</div>
										<div class="col-xl-3 col-12 ">
											<p class=" mb-1 fs-12"><?php echo e(__('Total Neural Characters Used')); ?></p>
											<h3 class="mb-0 fs-20 number-font"><?php echo e(number_format($user_data_year['total_neural_chars'][0]['data'])); ?></h3>
										</div>
										<div class="col-xl-3 col-12 ">
											<p class=" mb-1 fs-12"><?php echo e(__('Total Audio Files Created')); ?></p>
											<h3 class="mb-0 fs-20 number-font"><?php echo e(number_format($user_data_year['total_audio_files'][0]['data'])); ?></h3>
										</div>
										<div class="col-xl-3 col-12 ">
											<p class=" mb-1 fs-12"><?php echo e(__('Total Listen Mode Results')); ?></p>
											<h3 class="mb-0 fs-20 number-font"><?php echo e(number_format($user_data_year['total_listen_mode'][0]['data'])); ?></h3>
										</div>
									</div>
									<div class="chartjs-wrapper-demo">
										<canvas id="chart-user-usage" class="h-330"></canvas>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>				
			</div>
		</div>
	</div>
	<!-- END USER PROFILE PAGE -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<!-- Chart JS -->
	<script src="<?php echo e(URL::asset('plugins/chart/chart.bundle.js')); ?>"></script>
	<script>
		$(function() {
	
			'use strict';

			var standardData = JSON.parse(`<?php echo $chart_data['standard_chars']; ?>`);
			var standardDataset = Object.values(standardData);
			var neuralData = JSON.parse(`<?php echo $chart_data['neural_chars']; ?>`);
			var neuralDataset = Object.values(neuralData);

			var ctx = document.getElementById('chart-user-usage');
			new Chart(ctx, {
				type: 'bar',
				data: {
					labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
					datasets: [{
						label: 'Standard Characters Used ',
						data: standardDataset,
						backgroundColor: '#007bff',
						borderWidth: 1,
						fill: true
					}, {
						label: 'Neural Characters Used ',
						data: neuralDataset,
						backgroundColor:  '#1e1e2d',
						borderWidth: 1,
						fill: true
					}]
				},
				options: {
					maintainAspectRatio: false,
					legend: {
						display: false,
						labels: {
							display: false
						}
					},
					responsive: true,
					scales: {
						yAxes: [{
							stacked: true,
							ticks: {
								beginAtZero: true,
								fontSize: 11,
								stepSize: 100000,
							},
							gridLines: {
								borderDash: [3, 2]                            
							}
						}],
						xAxes: [{
							barPercentage: 0.5,
							stacked: true,
							ticks: {
								fontSize: 11
							},
							gridLines: {
								borderDash: [3, 2]                            
							}
						}]
					},
					tooltips: {
						cornerRadius: 0,
						xPadding: 10,
						yPadding: 10
					},
					legend: {
						position: 'bottom',
						labels: {
						boxWidth: 10,
						fontSize: 10
						}
					}
				}
			});
		});
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/661037.cloudwaysapps.com/fuxkpjgyyd/public_html/resources/views/user/profile/index.blade.php ENDPATH**/ ?>