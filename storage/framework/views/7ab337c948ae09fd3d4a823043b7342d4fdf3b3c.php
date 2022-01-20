

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="section-title">
                    <!-- SECTION TITLE -->
                    <div class="text-center mb-9 mt-9" id="contact-row">

                        <div class="title">
                            <h6><span><?php echo e(__('Terms and Conditions')); ?></span></h6>
                            <p><?php echo e(__('Lorem ipsum dolor sit amet')); ?></p>
                        </div>

                    </div> <!-- END SECTION TITLE -->
                </div>
            </div>
        </div>
    </div>

    <section id="about-wrapper">

        <div class="container-fluid" id="curve-container">
            <div class="curve-box">
                <div class="overflow-hidden curve">
                    <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="#fff"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center background-white">
                <div class="col-md-8 col-sm-12 policy">                
                    <div class="card-body pt-10">            

                        <div class="mb-4">
                            <p class="fs-12 text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque dolores facilis libero quas voluptatem, 
                                fuga deserunt autem atque aliquam voluptate placeat est, ipsa debitis accusamus accusantium fugit, cum officia nam.
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque dolores facilis libero quas voluptatem, 
                                fuga deserunt autem atque aliquam voluptate placeat est, ipsa debitis accusamus accusantium fugit, cum officia nam.
                            </p>
                        </div>

                        <div class="mb-4">
                            <p class="fs-12 text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque dolores facilis libero quas voluptatem, 
                                fuga deserunt autem atque aliquam voluptate placeat est, ipsa debitis accusamus accusantium fugit, cum officia nam.
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque dolores facilis libero quas voluptatem, 
                                fuga deserunt autem atque aliquam voluptate placeat est, ipsa debitis accusamus accusantium fugit, cum officia nam.
                            </p>
                        </div>

                        <div class="mb-4">
                            <p class="fs-12 text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque dolores facilis libero quas voluptatem, 
                                fuga deserunt autem atque aliquam voluptate placeat est, ipsa debitis accusamus accusantium fugit, cum officia nam.
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque dolores facilis libero quas voluptatem, 
                                fuga deserunt autem atque aliquam voluptate placeat est, ipsa debitis accusamus accusantium fugit, cum officia nam.
                            </p>
                        </div>

                        <div class="mb-4">
                            <p class="fs-12 text-justify">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque dolores facilis libero quas voluptatem, 
                                fuga deserunt autem atque aliquam voluptate placeat est, ipsa debitis accusamus accusantium fugit, cum officia nam.
                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque dolores facilis libero quas voluptatem, 
                                fuga deserunt autem atque aliquam voluptate placeat est, ipsa debitis accusamus accusantium fugit, cum officia nam.
                            </p>
                        </div>

                        <div class="form-group mt-6 text-center">                        
                            <a href="<?php echo e(route('register')); ?>" class="btn btn-primary mr-2"><?php echo e(__('I Agree, Let\'s Sign Up')); ?></a> 
                            <a href="<?php echo e(route('login')); ?>" class="btn btn-primary mr-2"><?php echo e(__('I Agree, Let\'s Login')); ?></a>                               
                        </div>
                        
                    </div>      
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/661037.cloudwaysapps.com/fuxkpjgyyd/public_html/resources/views/auth/service-terms.blade.php ENDPATH**/ ?>