<form id="change-name" action="<?php echo e(route('admin.tts.voices.update', $result->id)); ?>" method="POST" enctype="multipart/form-data">
  <?php echo csrf_field(); ?>
  <div class="modal-body pb-0">        
    <div class="input-box" id="textarea-box">
      <input type="text" class="form-control" name="voice-name" id="voice-name" value="<?php echo e($result->voice); ?>" required>
      <label class="input-label">
        <span class="input-label-content custom-content"><?php echo e(__('Voice Name (Required)')); ?></span>
      </label>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-cancel mr-2" data-dismiss="modal" id="listen-close"><?php echo e(__('Cancel')); ?></button>
    <button type="submit" class="btn btn-primary" id="new-project-button"><?php echo e(__('Update')); ?></button>
  </div>
</form><?php /**PATH /home/661037.cloudwaysapps.com/fuxkpjgyyd/public_html/resources/views/admin/tts-management/voices/edit.blade.php ENDPATH**/ ?>