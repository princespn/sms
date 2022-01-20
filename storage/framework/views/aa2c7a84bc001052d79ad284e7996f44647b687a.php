

<?php $__env->startSection('css'); ?>
	<!-- Data Table CSS -->
	<link href="<?php echo e(URL::asset('plugins/awselect/awselect.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-header'); ?>
	<!-- PAGE HEADER -->
	<div class="page-header mt-5-7">
		<div class="page-leftheader">
			<h4 class="page-title mb-0"><?php echo e(__('Payment Settings')); ?></h4>
			<ol class="breadcrumb mb-2">
				<li class="breadcrumb-item"><a href="<?php echo e(route('admin.dashboard')); ?>"><i class="fa fa-google-wallet mr-2 fs-12"></i><?php echo e(__('Admin')); ?></a></li>
				<li class="breadcrumb-item" aria-current="page"><a href="<?php echo e(route('admin.finance.dashboard')); ?>"> <?php echo e(__('Finance Management')); ?></a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="<?php echo e(url('#')); ?>"> <?php echo e(__('Payment Settings')); ?></a></li>
			</ol>
		</div>
	</div>
	<!-- END PAGE HEADER -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>	
	<!-- ALL PAYMENT CONFIGURATIONS -->					
	<div class="row">
		<div class="col-lg-8 col-md-12 col-xm-12">

			<form action="<?php echo e(route('admin.finance.settings.store')); ?>" method="POST" enctype="multipart/form-data">
				<?php echo csrf_field(); ?>

				<div class="card border-0">
					<div class="card-header">
						<h3 class="card-title"><?php echo e(__('Setup Payment Settings')); ?></h3>
					</div>		
					<div class="card-body">				

						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-12">			
								<div class="input-box">	
									<h6><?php echo e(__('Payment Options')); ?></h6>
									<select id="payment-option" name="payment-option" data-placeholder="Choose Payment Option:">			
										<option value="prepaid" <?php if(config('payment.payment_option')  == 'prepaid'): ?> selected <?php endif; ?>>Pre-Paid Payment Option</option>
										<option value="subscription" <?php if(config('payment.payment_option')  == 'subscription'): ?> selected <?php endif; ?>>Subscription Plan Payment Option</option>
										<option value="both" <?php if(config('payment.payment_option')  == 'both'): ?> selected <?php endif; ?>>Both (Pre-Paid and Subscription Options)</option>
									</select>
								</div> 						
							</div>

							<div class="col-lg-6 col-md-6 col-sm-12">
								<div class="input-box">								
									<h6><?php echo e(__('Tax Rate')); ?> (%)</h6>
									<div class="form-group">							    
										<input type="text" class="form-control <?php $__errorArgs = ['tax'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="tax" name="tax" placeholder="Enter Tax Rate" value="<?php echo e(config('payment.payment_tax')); ?>">
									</div>
									<?php $__errorArgs = ['tax'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<p class="text-danger"><?php echo e($errors->first('tax')); ?></p>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> 
								</div>							
							</div>		
							
							<div class="col-lg-6 col-md-6 col-sm-12">			
								<div class="input-box">	
									<h6><?php echo e(__('Default Currency')); ?> <span class="text-muted">(<?php echo e(__('Payments/Plans/System/Payouts')); ?>)</span> <span class="text-danger">(<?php echo e(__('Except Estimated Spendings')); ?>)</span></h6>
									<select id="currency" name="currency" data-placeholder="Choose Default Currency:">			
										<?php $__currentLoopData = config('currencies.all'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($key); ?>" <?php if(config('payment.default_system_currency') == $key): ?> selected <?php endif; ?>><?php echo e($value['name']); ?> - <?php echo e($key); ?> (<?php echo e($value['symbol']); ?>)</option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>									
									<?php $__errorArgs = ['currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
										<p class="text-danger"><?php echo e($errors->first('currency')); ?></p>
									<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
								</div> 						
							</div>
						</div>
					
					</div>
				</div>

				<div class="card border-0">
					<div class="card-header">
						<h3 class="card-title"><span class="text-info">Online </span> <?php echo e(__('Payment')); ?></h3>
					</div>
					<div class="card-body pb-6">

						<div class="card border-0 special-shadow">							
							<div class="card-body">
								<h6 class="fs-12 font-weight-bold mb-4"><i class="fa fa-cc-paypal fs-16 mr-2"></i>PayPal Payment Gateway</h6>
								
								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-paypal" class="custom-switch-input" <?php if(config('services.paypal.enable')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use PayPal Prepaid</span>
											</label>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-paypal-subscription" class="custom-switch-input" <?php if(config('services.paypal.subscription_enable')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use PayPal Subscription</span>
											</label>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<div class="input-box">								
											<h6>PayPal Client ID</h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['paypal_client_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="paypal_client_id" name="paypal_client_id" value="<?php echo e(config('services.paypal.client_id')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['paypal_client_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('paypal_client_id')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>PayPal Client Secret</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['paypal_client_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="paypal_client_secret" name="paypal_client_secret" value="<?php echo e(config('services.paypal.client_secret')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['paypal_client_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('paypal_client_secret')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>Paypal Webhook URI</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['paypal_webhook_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="paypal_webhook_uri" name="paypal_webhook_uri" value="<?php echo e(config('services.paypal.webhook_uri')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['paypal_webhook_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('paypal_webhook_uri')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>Paypal Webhook ID</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['paypal_webhook_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="paypal_webhook_id" name="paypal_webhook_id" value="<?php echo e(config('services.paypal.webhook_id')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['paypal_webhook_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('paypal_webhook_id')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>PayPal Base URI</h6> 
											<select id="paypal-url" name="paypal_base_uri" data-placeholder="Choose Payment Option:">			
												<option value="https://api-m.paypal.com" <?php if(config('services.paypal.base_uri')  == 'https://api-m.paypal.com'): ?> selected <?php endif; ?>>Live URL</option>
												<option value="https://api-m.sandbox.paypal.com" <?php if(config('services.paypal.base_uri')  == 'https://api-m.sandbox.paypal.com'): ?> selected <?php endif; ?>>Sandbox URL</option>
											</select>
											<?php $__errorArgs = ['paypal_base_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('paypal_base_uri')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>
								
								</div>
	
							</div>
						</div>	


						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fa fa-cc-stripe fs-16 mr-2"></i>Stripe Payment Gateway</h6>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-stripe" class="custom-switch-input" <?php if(config('services.stripe.enable')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use Stripe Prepaid</span>
											</label>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-stripe-subscription" class="custom-switch-input" <?php if(config('services.stripe.subscription_enable')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use Stripe Subscription</span>
											</label>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>Stripe Key</h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['stripe_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="stripe_key" name="stripe_key" value="<?php echo e(config('services.stripe.api_key')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['stripe_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('stripe_key')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- SECRET ACCESS KEY -->
										<div class="input-box">								
											<h6>Stripe Secret Key</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['stripe_secret_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="stripe_secret_key" name="stripe_secret_key" value="<?php echo e(config('services.stripe.api_secret')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['stripe_secret_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('stripe_secret_key')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> <!-- END SECRET ACCESS KEY -->
									</div>	
									
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>Stripe Webhook URI</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['stripe_webhook_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="stripe_webhook_uri" name="stripe_webhook_uri" value="<?php echo e(config('services.stripe.webhook_uri')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['stripe_webhook_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('stripe_webhook_uri')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>Stripe Webhook Secret</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['stripe_webhook_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="stripe_webhook_secret" name="stripe_webhook_secret" value="<?php echo e(config('services.stripe.webhook_secret')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['stripe_webhook_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('stripe_webhook_secret')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>Stripe Base URI</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['stripe_base_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="stripe_base_uri" name="stripe_base_uri" value="<?php echo e(config('services.stripe.base_uri')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['stripe_base_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('stripe_base_uri')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>
									
								</div>
	
							</div>
						</div>


						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><img src="<?php echo e(URL::asset('/img/payments/paystack.svg')); ?>" alt="Paystack" class="gateway-logo">Paystack Payment Gateway</h6>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-paystack" class="custom-switch-input" <?php if(config('services.paystack.enable')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use Paystack Prepaid</span>
											</label>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-paystack-subscription" class="custom-switch-input" <?php if(config('services.paystack.subscription_enable')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use Paystack Subscription</span>
											</label>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>Paystack Public Key</h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['paystack_public_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="paystack_public_key" name="paystack_public_key" value="<?php echo e(config('services.paystack.api_key')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['paystack_public_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('paystack_public_key')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- SECRET ACCESS KEY -->
										<div class="input-box">								
											<h6>Paystack Secret Key</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['paystack_secret_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="paystack_secret_key" name="paystack_secret_key" value="<?php echo e(config('services.paystack.api_secret')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['paystack_secret_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('paystack_secret_key')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> <!-- END SECRET ACCESS KEY -->
									</div>	
									
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>Paystack Webhook URI</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['paystack_webhook_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="paystack_webhook_uri" name="paystack_webhook_uri" value="<?php echo e(config('services.paystack.webhook_uri')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['paystack_webhook_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('paystack_webhook_uri')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>Paystack Base URI</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['paystack_base_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="paystack_base_uri" name="paystack_base_uri" value="<?php echo e(config('services.paystack.base_uri')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['paystack_base_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('stripe_base_uri')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>
									
								</div>
	
							</div>
						</div>


						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><img src="<?php echo e(URL::asset('/img/payments/razorpay.svg')); ?>" alt="Razorpay" class="gateway-logo">Razorpay Payment Gateway</h6>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-razorpay" class="custom-switch-input" <?php if(config('services.razorpay.enable')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use Razorpay Prepaid</span>
											</label>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-razorpay-subscription" class="custom-switch-input" <?php if(config('services.razorpay.subscription_enable')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use Razorpay Subscription</span>
											</label>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>Razorpay Key ID</h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['razorpay_key_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="razorpay_key_id" name="razorpay_key_id" value="<?php echo e(config('services.razorpay.key_id')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['razorpay_key_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('razorpay_key_id')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> <!-- END ACCESS KEY -->
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<!-- SECRET ACCESS KEY -->
										<div class="input-box">								
											<h6>Razorpay Key Secret</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['razorpay_key_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="razorpay_key_secret" name="razorpay_key_secret" value="<?php echo e(config('services.razorpay.key_secret')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['razorpay_key_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('razorpay_key_secret')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> <!-- END SECRET ACCESS KEY -->
									</div>	
									
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>Razorpay Webhook URI</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['razorpay_webhook_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="razorpay_webhook_uri" name="razorpay_webhook_uri" value="<?php echo e(config('services.razorpay.webhook_uri')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['razorpay_webhook_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('razorpay_webhook_uri')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>Razorpay Webhook Secret</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['razorpay_webhook_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="razorpay_webhook_secret" name="razorpay_webhook_secret" value="<?php echo e(config('services.razorpay.webhook_secret')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['razorpay_webhook_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('razorpay_webhook_secret')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>
									
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>Razorpay Base URI</h6> 
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['razorpay_base_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="razorpay_base_uri" name="razorpay_base_uri" value="<?php echo e(config('services.razorpay.base_uri')); ?>" autocomplete="off">
											</div> 
											<?php $__errorArgs = ['razorpay_base_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('razorpay_base_uri')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>
									
								</div>
	
							</div>
						</div>


						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><img src="<?php echo e(URL::asset('/img/payments/mollie.svg')); ?>" alt="Mollie" class="gateway-logo gateway-small-logo">Mollie Payment Gateway</h6>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-mollie" class="custom-switch-input" <?php if(config('services.mollie.enable')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use Mollie Prepaid</span>
											</label>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-mollie-subscription" class="custom-switch-input" <?php if(config('services.mollie.subscription_enable')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use Mollie Subscription</span>
											</label>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>Mollie Public Key</h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['mollie_key_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="mollie_key_id" name="mollie_key_id" value="<?php echo e(config('services.mollie.key_id')); ?>" autocomplete="off">
											</div>
												<?php $__errorArgs = ['mollie_key_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('mollie_key_id')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> <!-- END ACCESS KEY -->
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<div class="input-box">								
											<h6>Mollie Webhook URI</h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['mollie_webhook_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="mollie_webhook_uri" name="mollie_webhook_uri" value="<?php echo e(config('services.mollie.webhook_uri')); ?>" autocomplete="off">
											</div>
												<?php $__errorArgs = ['mollie_webhook_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('mollie_webhook_uri')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<div class="input-box">								
											<h6>Mollie Base URI</h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['mollie_base_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="mollie_base_uri" name="mollie_base_uri" value="<?php echo e(config('services.mollie.base_uri')); ?>" autocomplete="off">
											</div>
												<?php $__errorArgs = ['mollie_base_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('mollie_base_uri')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div>
									</div>								
									
								</div>
	
							</div>
						</div>


						<div class="card border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><img src="<?php echo e(URL::asset('/img/payments/braintree.svg')); ?>" alt="Braintree" class="gateway-logo">Braintree Payment Gateway</h6>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-braintree" class="custom-switch-input" <?php if(config('services.braintree.enable')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use Braintree Prepaid</span>
											</label>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>Braintree Private Key</h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['braintree_private_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="braintree_private_key" name="braintree_private_key" value="<?php echo e(config('services.braintree.private_key')); ?>" autocomplete="off">
											</div>
												<?php $__errorArgs = ['braintree_private_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('braintree_private_key')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> <!-- END ACCESS KEY -->
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<!-- ACCESS KEY -->
										<div class="input-box">								
											<h6>Braintree Public Key</h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['braintree_public_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="braintree_public_key" name="braintree_public_key" value="<?php echo e(config('services.braintree.public_key')); ?>" autocomplete="off">
											</div>
												<?php $__errorArgs = ['braintree_public_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('braintree_public_key')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> <!-- END ACCESS KEY -->
									</div>									
									<div class="col-lg-6 col-md-6 col-sm-12">		
										<div class="input-box">								
											<h6>Braintree Merchant ID</h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['braintree_merchant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="braintree_merchant_id" name="braintree_merchant_id" value="<?php echo e(config('services.braintree.merchant_id')); ?>" autocomplete="off">
											</div>
												<?php $__errorArgs = ['braintree_merchant_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('braintree_merchant_id')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>Braintree Environment</h6> 
											<select id="braintree" name="braintree_env" data-placeholder="Choose Braintree Environment:">			
												<option value="sandbox" <?php if(config('services.braintree.env')  == 'sandbox'): ?> selected <?php endif; ?>>Sandbox</option>
												<option value="production" <?php if(config('services.braintree.env')  == 'production'): ?> selected <?php endif; ?>>Production</option>
											</select>
											<?php $__errorArgs = ['braintree_env'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('braintree_env')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>
								</div>
	
							</div>
						</div>
					
					</div>
				</div>


				<div class="card border-0">
					<div class="card-header">
						<h3 class="card-title"><span class="text-info">Cryptocurrency </span> <?php echo e(__('Payment')); ?></h3>
					</div>
					<div class="card-body pb-6">

						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><img src="<?php echo e(URL::asset('/img/payments/coinbase.svg')); ?>" alt="Coinbase" class="gateway-logo"><?php echo e(__('Coinbase Commerce Payment Gateway')); ?></h6>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-coinbase" class="custom-switch-input" <?php if(config('services.coinbase.enable')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use for Prepaid</span>
											</label>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">		
										<div class="input-box">								
											<h6>Coinbase API Key</h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['coinbase_api_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="coinbase_api_key" name="coinbase_api_key" value="<?php echo e(config('services.coinbase.api_key')); ?>" autocomplete="off">
											</div>
												<?php $__errorArgs = ['coinbase_api_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('coinbase_api_key')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">		
										<div class="input-box">								
											<h6>Coinbase Webhook Secret</h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['coinbase_webhook_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="coinbase_webhook_secret" name="coinbase_webhook_secret" value="<?php echo e(config('services.coinbase.webhook_secret')); ?>" autocomplete="off">
											</div>
												<?php $__errorArgs = ['coinbase_webhook_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('coinbase_webhook_secret')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-12">		
										<div class="input-box">								
											<h6>Coinbase Webhook URI</h6>
											<div class="form-group">							    
												<input type="text" class="form-control <?php $__errorArgs = ['coinbase_webhook_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-danger <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="coinbase_webhook_uri" name="coinbase_webhook_uri" value="<?php echo e(config('services.coinbase.webhook_uri')); ?>" autocomplete="off">
											</div>
												<?php $__errorArgs = ['coinbase_webhook_uri'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('coinbase_webhook_uri')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div>
									</div>
								</div>
	
							</div>
						</div>
					
					</div>					
				
				</div>


				<div class="card border-0">
					<div class="card-header">
						<h3 class="card-title"><span class="text-info">Offline </span> <?php echo e(__('Payment')); ?></h3>
					</div>
					<div class="card-body">

						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fa fa-university fs-16 mr-2"></i><?php echo e(__('Bank Transfer Payment')); ?> <span class="text-muted">(<?php echo e(__('Offline Payment')); ?>)</span></h6>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-bank-prepaid" class="custom-switch-input" <?php if(config('services.banktransfer.prepaid')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use for Prepaid</span>
											</label>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-bank-subscription" class="custom-switch-input" <?php if(config('services.banktransfer.subscription')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use for Subscription</span>
											</label>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-12">								
										<div class="input-box">								
											<h6>Customer Payment Intructions</h6>
											<textarea class="form-control" name="bank_instructions" id="bank_instructions" rows="6"><?php echo e($bank['bank_instructions']); ?></textarea> 
											<?php $__errorArgs = ['bank_instructions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('bank_instructions')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div>
									</div>

									<div class="col-lg-6 col-md-6 col-sm-12">
										<div class="input-box">								
											<h6>Bank Account Requisites</h6> 
											<textarea class="form-control" name="bank_requisites" id="bank_requisites" rows="6"><?php echo e($bank['bank_requisites']); ?></textarea>
											<?php $__errorArgs = ['bank_requisites'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('bank_requisites')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div> 
									</div>										
									
								</div>
	
							</div>
						</div>		
						
						<div class="card overflow-hidden border-0 special-shadow">							
							<div class="card-body">

								<h6 class="fs-12 font-weight-bold mb-4"><i class="fa fa-money fs-16 mr-2"></i><?php echo e(__('My Balance Payment')); ?> <span class="text-muted">(<?php echo e(__('Offline Payment')); ?>)</span></h6>

								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-balance-prepaid" class="custom-switch-input" <?php if(config('services.mybalance.prepaid')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use for Prepaid</span>
											</label>
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label class="custom-switch">
												<input type="checkbox" name="enable-balance-subscription" class="custom-switch-input" <?php if(config('services.mybalance.subscription')  == 'on'): ?> checked <?php endif; ?>>
												<span class="custom-switch-indicator"></span>
												<span class="custom-switch-description">Use for Subscription</span>
											</label>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12 col-md-12 col-sm-12">								
										<div class="input-box">								
											<h6>Customer Payment Intructions</h6>
											<textarea class="form-control" name="balance_instructions" id="balance_instructions" rows="6"><?php echo e($bank['balance_instructions']); ?></textarea> 
											<?php $__errorArgs = ['balance_instructions'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
												<p class="text-danger"><?php echo e($errors->first('balance_instructions')); ?></p>
											<?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
										</div>
									</div>								
								</div>
	
							</div>
						</div>

						<!-- SAVE CHANGES ACTION BUTTON -->
						<div class="border-0 text-right mb-2 mt-1">
							<a href="<?php echo e(route('admin.finance.dashboard')); ?>" class="btn btn-cancel mr-2"><?php echo e(__('Cancel')); ?></a>
							<button type="submit" class="btn btn-primary"><?php echo e(__('Save')); ?></button>							
						</div>
					
					</div>					
				
				</div>		
			
			</form>
				
		</div>
	</div>
	<!-- END ALL PAYMENT CONFIGURATIONS -->	

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<!-- Awselect JS -->
	<script src="<?php echo e(URL::asset('plugins/awselect/awselect.min.js')); ?>"></script>
	<script src="<?php echo e(URL::asset('js/awselect.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/661037.cloudwaysapps.com/fuxkpjgyyd/public_html/resources/views/admin/finance-management/settings/index.blade.php ENDPATH**/ ?>