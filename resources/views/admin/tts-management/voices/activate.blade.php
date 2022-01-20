<form action="{{ route('admin.tts.voices.activate', $result->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
        
    <div class="modal-body">        
		<p>{{ __('Do you want to activate selected voice') }}?</p>     
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-cancel mr-2" data-dismiss="modal">{{ __('Cancel') }}</button>
        <button type="submit" class="btn btn-primary">{{ __('Confirm') }}</button>
    </div>
</form>