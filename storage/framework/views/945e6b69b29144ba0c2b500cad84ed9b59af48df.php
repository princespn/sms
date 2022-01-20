

<?php $__env->startSection('content'); ?>

    <div class="container">
        <div class="row text-center">
            <div class="col-md-12">
                <div class="section-title">
                    <!-- SECTION TITLE -->
                    <div class="text-center mb-9 mt-9" id="contact-row">

                        <div class="title">
                            <h6><span><?php echo e(__('FAQs')); ?></span></h6>
                            <p><?php echo e(__('Got questions? We have all answers for you.')); ?></p>
                        </div>

                    </div> <!-- END SECTION TITLE -->
                </div>
            </div>
        </div>
    </div>

    <section id="faq-wrapper">

        <div class="container-fluid" id="curve-container">
            <div class="curve-box">
                <div class="overflow-hidden curve">
                    <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="#fff"></path>
                    </svg>
                </div>
            </div>
        </div>

        <div class="container pt-6">

            <div class="row justify-content-md-center">

                <?php if($faq_exists): ?>

                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-10 col-sm-12"> 

                            <h6 class="faq-category"><?php echo e(ucfirst($category->name)); ?></h6> 

                            <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     
                                <?php if($category->name == $faq->category): ?>
                                    <div id="accordion">
                                        <div class="card">
                                            <div class="card-header" id="heading<?php echo e($faq->id); ?>">
                                                <h5 class="mb-0">
                                                <span class="btn btn-link" data-toggle="collapse" data-target="#collapse-<?php echo e($faq->id); ?>" aria-expanded="false" aria-controls="collapse-<?php echo e($faq->id); ?>">
                                                    <?php echo e($faq->question); ?>

                                                </span>
                                                </h5>
                                            </div>
                                        
                                            <div id="collapse-<?php echo e($faq->id); ?>" class="collapse" aria-labelledby="heading<?php echo e($faq->id); ?>" data-parent="#accordion">
                                                <div class="card-body">
                                                    <?php echo $faq->answer; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>                                                        
                                
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>  
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                    

                <?php else: ?>
                    <div class="row text-center">
                        <div class="col-sm-12 mt-6 mb-6">
                            <h6 class="fs-12 font-weight-bold text-center"><?php echo e(__('No FAQ answers were published yet')); ?></h6>
                        </div>
                    </div>
                <?php endif; ?>
     
            </div>        
        </div>

    </section>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.guest', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/661037.cloudwaysapps.com/fuxkpjgyyd/public_html/resources/views/faqs.blade.php ENDPATH**/ ?>