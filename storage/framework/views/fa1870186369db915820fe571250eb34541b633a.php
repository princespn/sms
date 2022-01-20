

<?php $__env->startSection('css'); ?>
	<!-- Awselect CSS -->
	<link href="<?php echo e(URL::asset('plugins/awselect/awselect.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Update Bank Transfer Payment')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-google-wallet mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.finance.dashboard')); ?>"> <?php echo e(__('Finance Management')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.finance.payments')); ?>"> <?php echo e(__('All Payments')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="#"> <?php echo e(__('Update Payment')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>						
	<div class="row">
		<div class="col-lg-6 col-md-6 col-xm-12">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Payment')); ?> ID: <span class="text-info"><?php echo e($id->order_id); ?></span></h3>
				</div>
				<div class="card-body pt-5">		

					<div class="row">
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Transaction Date')); ?>: </h6>
							<span class="fs-14"><?php echo e($id->created_at); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Plan Type')); ?>: </h6>
							<span class="fs-14"><?php echo e(ucfirst($id->plan_type)); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Price')); ?> (<?php echo e(config('payment.default_system_currency')); ?>): </h6>
							<span class="fs-14"><?php echo config('payment.default_system_currency_symbol'); ?><?php echo e(ucfirst($id->amount)); ?></span>
						</div>
					</div>

					<div class="row pt-5">
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Package Name')); ?>: </h6>
							<span class="fs-14"><?php echo e($id->plan_name); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Characters Included')); ?>: </h6>
							<span class="fs-14"><?php echo e(number_format($id->characters)); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Paid By')); ?>: </h6>
							<span class="fs-14"><?php echo e($id->gateway); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12 pt-5">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('User Full Name')); ?>: </h6>
							<span class="fs-14"><?php echo e($user->name); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12 pt-5">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('User Email')); ?>: </h6>
							<span class="fs-14"><?php echo e($user->email); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12 pt-5">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('User Country')); ?>: </h6>
							<span class="fs-14"><?php echo e($user->country); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12 pt-5">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Discount Applied')); ?> (<?php echo e(config('payment.default_system_currency')); ?>): </h6>
							<span class="fs-14"><?php echo config('payment.default_system_currency_symbol'); ?><?php echo e($id->discount); ?></span>
						</div>
						<div class="col-lg-4 col-md-4 col-12 pt-5">
							<h6 class="font-weight-bold mb-1"><?php echo e(__('Status')); ?>: </h6>
							<span class="fs-14"><?php echo e($id->status); ?></span>
						</div>
					</div>	

					<form action="<?php echo e(route('admin.finance.payments.update', $id)); ?>" method="POST" enctype="multipart/form-data">
						<?php echo method_field('PUT'); ?>
						<?php echo csrf_field(); ?>

						<div class="row pt-8">
							<div class="col-lg-6 col-md-6 col-sm-12">				
								<div class="input-box">	
									<h6><?php echo e(__('Update Payment Status')); ?> <span class="text-muted">(<?php echo e(__('Required')); ?>)</span></h6>
									<select id="notification-type" name="payment-status" data-placeholder="Update payment status:">			
										<option value="Pending" selected>Pending Payment</option>
										<option value="Success">Payment Received</option>
										<option value="Cancelled">Payment Cancelled</option>
										<option value="Declined">Payment Declined</option>
									</select>
									<?php $__errorArgs = ['payment-status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<p class="text-danger"><?php echo e($errors->first('payment-status')); ?></p>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div> 							
							</div>						
						</div>

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-7">
							<a href="<?php echo e(route('admin.finance.payments')); ?>" class="btn btn-cancel mr-2"><?php echo e(__('Return')); ?></a>
							<button type="submit" class="btn btn-primary"><?php echo e(__('Update')); ?></button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<!-- Awselect JS -->
	<script src="<?php echo e(URL::asset('plugins/awselect/awselect.min.js')); ?>"></script>
	<script src="<?php echo e(URL::asset('js/awselect.js')); ?>"></script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/661037.cloudwaysapps.com/fuxkpjgyyd/public_html/resources/views/admin/finance-management/payments/edit.blade.php ENDPATH**/ ?>