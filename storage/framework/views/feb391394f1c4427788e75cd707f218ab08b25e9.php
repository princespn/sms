<form action="<?php echo e(route('admin.user.destroy', $user->id)); ?>" method="POST" enctype="multipart/form-data">
    <?php echo method_field('DELETE'); ?>
    <?php echo csrf_field(); ?>
        
    <div class="modal-body">        
		<p><?php echo e(__('Do you want to delete this user')); ?>: <strong><?php echo e($user->name); ?></strong>?</p>     
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-cancel mr-2" data-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
        <button type="submit" class="btn btn-confirm"><?php echo e(__('Confirm')); ?></button>
    </div>
</form><?php /**PATH /home/661037.cloudwaysapps.com/fuxkpjgyyd/public_html/resources/views/admin/user-management/list/delete.blade.php ENDPATH**/ ?>