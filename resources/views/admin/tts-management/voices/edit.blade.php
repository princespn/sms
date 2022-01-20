<form id="change-name" action="{{ route('admin.tts.voices.update', $result->id) }}" method="POST" enctype="multipart/form-data">
  @csrf
  <div class="modal-body pb-0">        
    <div class="input-box" id="textarea-box">
      <input type="text" class="form-control" name="voice-name" id="voice-name" value="{{ $result->voice }}" required>
      <label class="input-label">
        <span class="input-label-content custom-content">{{ __('Voice Name (Required)') }}</span>
      </label>
    </div>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-cancel mr-2" data-dismiss="modal" id="listen-close">{{ __('Cancel') }}</button>
    <button type="submit" class="btn btn-primary" id="new-project-button">{{ __('Update') }}</button>
  </div>
</form>