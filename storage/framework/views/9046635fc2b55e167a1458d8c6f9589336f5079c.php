

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Change Password')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('user.tts')); ?>"><i class="mdi mdi-account-settings-variant mr-2 fs-12"></i><?php echo e(__('User')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('My Profile Settings')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(route('user.password')); ?>"> <?php echo e(__('Change Password')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<!-- CHANGE PASSWORD -->
	<div class="row"> 
		<div class="col-xl-3 col-lg-4">
			<div class="card border-0">
				<div class="card-header">
					<h3 class="card-title"><?php echo e(__('Edit Password')); ?></h3>
				</div>
				<div class="card-body">
					<div class="text-center mb-5">
						<div class="widget-user-image overflow-hidden">
							<img alt="User Avatar" class="rounded-circle mr-3" src="<?php if(auth()->user()->profile_photo_path): ?><?php echo e(asset(auth()->user()->profile_photo_path)); ?> <?php else: ?> <?php echo e(URL::asset('img/users/avatar.jpg')); ?> <?php endif; ?>">
						</div>
						<h4 class="mb-1 mt-4 font-weight-bold fs-16"><?php echo e(auth()->user()->name); ?></h4>
						<h6 class="text-muted fs-12"><?php echo e(__('Last Profile Update')); ?>: <?php echo e(auth()->user()->updated_at->diffForHumans()); ?></h6>
					</div>
					<form method="POST" action="<?php echo e(route('user.password.update', [auth()->user()->id])); ?>" enctype="multipart/form-data">

						<?php echo csrf_field(); ?>

						<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <p class="text-danger"><?php echo e($error); ?></p>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 

						<div class="input-box">	
							<div class="form-group">
								<label class="form-label fs-12"><?php echo e(__('Current Password')); ?></label>
								<input type="password" name='current_password' class="form-control">
							</div>
						</div>
						<div class="input-box">
							<div class="form-group">
								<label class="form-label fs-12"><?php echo e(__('New Password')); ?></label>
								<input type="password" name="new_password" class="form-control">
							</div>
						</div>
						<div class="input-box mb-0">
							<div class="form-group mb-0">
								<label class="form-label fs-12"><?php echo e(__('Confirm New Password')); ?></label>
								<input type="password" name="new_confirm_password" class="form-control">
							</div>
						</div>
						<div class="card-footer border-0 text-right mt-2 pr-0 pb-0">
							<a href="<?php echo e(route('user.profile', [auth()->user()->id])); ?>" class="btn btn-cancel mr-2"><?php echo e(__('Cancel')); ?></a>
							<button type="submit" class="btn btn-primary"><?php echo e(__('Change')); ?></button>							
						</div>
					</form>					
				</div>				
			</div>
		</div>
	</div>
	<!-- CHANGE PASSWORD -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/661037.cloudwaysapps.com/fuxkpjgyyd/public_html/resources/views/user/profile/password/index.blade.php ENDPATH**/ ?>