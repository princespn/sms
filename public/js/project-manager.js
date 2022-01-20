/*===========================================================================
*
*  AUDIO FILE UPLOAD - FILEPOND PLUGIN
*
*============================================================================*/

FilePond.registerPlugin( 

   FilePondPluginFileValidateSize,
   FilePondPluginFileValidateType

);

var pond = FilePond.create(document.querySelector('.filepond'));
var all_types;
var maxFileSize;

$.ajax({
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
    },
    type: "GET",
    url: 'settings',

  }).done(function(data) {

     maxFileSize = data['size'] + 'MB';

      FilePond.setOptions({
         
          allowMultiple: false,
          maxFiles: 1,
          allowReplace: true,
          maxFileSize: maxFileSize,
          labelIdle: "Drag & Drop your audio file or <span class=\"filepond--label-action\">Browse</span><br><span class='restrictions'>[<span class='restrictions-highlight'>" + maxFileSize + "</span>: MP3 | OGG]</span>",
          required: false,
          instantUpload: false,
          storeAsFile: true,
          acceptedFileTypes: ['audio/ogg', 'audio/mpeg'],
          labelFileProcessingError: (error) => {
            console.log(error);
          }
    
      });

});



/*===========================================================================
*
*  UPLOAD AUDIO FILE FOR BACKGROUND
*
*============================================================================*/

 $('#upload-music').on('click',function(e) {

  "use strict";

  e.preventDefault();
  
  var inputAudio = [];
  var duration;
 
  
  if (pond.getFiles().length !== 0) {   
      pond.getFiles().forEach(function(file) {
      inputAudio.push(file);
    });

    var audio = document.createElement('audio');
    var objectUrl = URL.createObjectURL(inputAudio[0].file);
  
    audio.src = objectUrl;
    audio.addEventListener('loadedmetadata', function(){
      duration = audio.duration;
    },false);
  
    var formData = new FormData();
  
    setTimeout(function() {
  
      
      formData.append('audiofile', inputAudio[0].file);
      formData.append('audiolength', duration);
  
      $.ajax({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          type: "POST",
          url: 'music/upload',
          data: formData,
          contentType: false,
          processData: false,
          cache: false,
          beforeSend: function() {
              $('#upload-music').html('');
              $('#upload-music').prop('disabled', true);
              $('#processing').show().clone().appendTo('#upload-music'); 
              $('#processing').hide();          
          },
          complete: function() {
              $('#upload-music').prop('disabled', false);
              $('#processing', '#upload-music').empty().remove();
              $('#processing').hide();
              $('#upload-music').html('Upload Audio');            
          },
          success: function(data) {
            if (!data) {
              $('#notificationModal').modal('show');
              $('#notificationMessage').text('There was an error while uploading, please try again');
            } else {
              $('#notificationModal').modal('show');
              $('#notificationMessage').text('Audio file was successfully uploaded');
            }
          },
          error: function(data) {
  
              if (!data) {
                  $('#notificationModal').modal('show');
                  $('#notificationMessage').text('There was an error while uploading, please try again');
              }
  
              $('#upload-music').prop('disabled', false);
              $('#upload-music').html('Upload Audio');   
              
              if (pond.getFiles().length != 0) {
                  for (var j = 0; j <= pond.getFiles().length - 1; j++) {
                      pond.removeFiles(pond.getFiles()[j].id);
                  }
              }
            
              inputAudio = [];
          }
      }).done(function(data) {
        if (pond.getFiles().length != 0) {
            for (var j = 0; j <= pond.getFiles().length - 1; j++) {
                pond.removeFiles(pond.getFiles()[j].id);
            }
        }
      
        inputAudio = [];
      })
  
    }, 500);
    
  } else {
    $('#notificationModal').modal('show');
    $('#notificationMessage').text('Select audio file first before uploading');
    return;
  }

});





