

<?php $__env->startSection('css'); ?>
	<!-- Data Table CSS -->
	<link href="<?php echo e(URL::asset('plugins/awselect/awselect.min.css')); ?>" rel="stylesheet" />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="section-title">
                    <!-- SECTION TITLE -->
                    <div class="text-center mb-9 mt-9" id="contact-row">

                        <div class="title">
                            <h6><span><?php echo e(__('Text to Speech')); ?></span> <?php echo e(__('Blogs')); ?></h6>
                            <p><?php echo e(__('Read our unique blog articles about various text to speech usecases and secrets')); ?></p>
                        </div>

                    </div> <!-- END SECTION TITLE -->
                </div>
            </div>
        </div>
    </div>

    <section id="blog-wrapper">
        
        <div class="container-fluid" id="curve-container">
            <div class="curve-box">
                <div class="overflow-hidden curve">
                    <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="#fff"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="container pt-9">

            <div class="row justify-content-md-center">

                <?php if($blog_exists): ?>

                    <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 col-sm-12 mb-6">
                            <div class="blog-box">
                                <a href="<?php echo e(route('blogs.show', $blog->url)); ?>"><img src="<?php echo e(URL::asset($blog->image)); ?>" alt="Blog Image"></a>
                                <div class="blog-info">
                                    <h6 class="fs-12"><i class="mdi mdi-account-edit mr-2"></i><?php echo e($blog->created_by); ?></h6>
                                    <h6 class="fs-12"><i class="mdi mdi-alarm mr-2"></i><?php echo e(date('F j, Y', strtotime($blog->created_at))); ?></h6>
                                    <h6 class="fs-14 font-weight-bold"><?php echo e($blog->title); ?></h6>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <?php else: ?>
                    <div class="row text-center">
                        <div class="col-sm-12 mt-6 mb-6">
                            <h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No blog articles were published yet')); ?></h6>
                        </div>
                    </div>
                <?php endif; ?>
     
            </div>        
        </div>

    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
	<!-- Awselect JS -->
	<script src="<?php echo e(URL::asset('plugins/awselect/awselect.min.js')); ?>"></script>
	<script src="<?php echo e(URL::asset('js/awselect.js')); ?>"></script>   
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/661037.cloudwaysapps.com/fuxkpjgyyd/public_html/resources/views/blogs.blade.php ENDPATH**/ ?>