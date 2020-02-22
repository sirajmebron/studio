@extends('layouts.admin')
@section('content')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">

<link rel="stylesheet" href="{{ asset('dropzone/dropzone.css') }}">
<script src="{{ asset('dropzone/dropzone.js') }}"></script>
<script src="{{ asset('admin/js/jquery.validate.min.js') }}"></script>
<div class="container my-4">
  <div class="card">
    <div class="card-header">
        <h3>Add Gallery</h3>
    </div>
    <div class="card-body">
    <form id="myForm" action="/admin/gallery" method="POST" enctype="multipart/form-data">
      @csrf
      <div class="form-group row">
        <label for="customer" class="col-4 col-form-label">Customer</label>
        <div class="col-8">
          <select class="form-control select" name="customer_id" id="customer_id">
            <option value="">select</option>
            @foreach($customers ?? '' as $customer)
            <option value="{{ $customer->id}}">{{   $customer->name     }}</option>
            @endforeach
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="title" class="col-4 col-form-label">Title</label>
        <div class="col-8">
          <input id="title" name="title" placeholder="Enter title" type="text" class="form-control" required="required">
        </div>
      </div>
      <div class="form-group row">
        <label for="description" class="col-4 col-form-label">Description</label>
        <div class="col-8">
          <textarea id="description" name="description" cols="40" rows="5" class="form-control" ></textarea>
        </div>
      </div>
        {{-- <div class="form-group">
            <div class="file-loading">
                <input id="file-1" type="file" multiple class="file" data-overwrite-initial="false" data-min-file-count="2" data-theme="fas">
            </div>
        </div>
        <hr> --}}
        <div class="form-group">
          <div  class="dropzone" id="my-awesome-dropzone">
            <div  class="dz-error-message"></div>
          </div>
          <meta name="csrf-token" content="{{ csrf_token() }}" />
          </div>
          <div id="the-progress-div">
            <span class="the-progress-text"></span>
          </div>
          <div class="progress">
            <div class="progress-bar progress-bar-primary" role="progressbar" data-dz-uploadprogress>
                <span class="progress-text"></span>
            </div>
        </div>
        {{-- <div class="form-group">
            <div class="file-loading">
                <input id="file-5" name="image[]" class="file" type="file" multiple data-preview-file-type="any" data-upload-url="#" data-theme="fas">
            </div>
        </div> --}}
        <div class="form-group row">
          <div class="offset-4 col-8">
          </div>
        </div>
    </form>
    <button name="submit" id="toUploadButton" type="button" class="btn btn-primary">Submit</button>
  </div>
</div>
    <br>
</div>

<script>
  //Disabling autoDiscover
   Dropzone.autoDiscover = false;
   /* var maxImageWidth = 1000, maxImageHeight = 1000; */
  $(function() {
      //Dropzone class
     var myDropzone = new Dropzone(".dropzone", {
      url:"{{url('/gallery/store/')}}",
      autoProcessQueue: false,
      paramName: "image",
      parallelUploads: 100,  
      maxFilesize: 1500,
      addRemoveLinks: true,
      dictCancelUpload: "Cancel",
      maxFiles: 100,
     
      uploadMultiple: true,
      clickable: true,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      //acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF",
      //acceptedFiles: 'image/*',
     
        init: function() {
          //alert();
         /*  this.on("addedfile", function(file) {
            //alert();
            //$('.dropzone').prepend($(file.previewElement));
         }); */
         this.on("totaluploadprogress", function(progress) {
          $("#the-progress-div").width(progress + '%');
  $(".the-progress-text").text(progress + '%');
  var progressElement = $("[data-dz-uploadprogress]");
        progressElement.style.width = progress + "%";
        progressElement.querySelector(".progress-text").textContent = progress + "%";
                      });
        
          this.on("maxfilesexceeded", function(file){
            //alert();
            swal({
             title: "Limit Reached!",
             text: "Limit Reached You cannot upload any more pics!",
             icon: "error",
             button: "OK",
          });
           
          });
          this.on("processing", function() {
            this.options.autoProcessQueue = true;
          });
            this.on("uploadprogress", function(file, progress) {
            console.log("File progress", progress);
          }); 
          this.on("complete", function (file) {
            //alert('100');
         /*  if (this.getRejectedFiles().length > 0) {
             //alert('hai');
      } */
    });
          this.on("sending", function(file, xhr, formData) { 
            // Will sendthe filesize along with the file as POST data.
            formData.append("filesize", file.size);
            formData.append("_token", $('meta[name="csrf-token"]').attr('content')),
            formData.append('customer_id',$('#customer_id').val());
            formData.append('title',$('#title').val());
            formData.append('description',$('#description').val());        
           });
           this.on("success", function(file, responseText) {
             //alert(responseText);
             window.location.href = ("{{url('admin/gallery/')}}") 
           });
          this.on("error", function(file, message, xhr) {
            //console.log(file);
            swal({
             title: "Upload Failed!",
             text: "Total Upload Size exceeds maximum memory!",
             icon: "error",
             button: "OK",
          });
            var header = xhr.statusText;
            $(file.previewElement).find('.dz-error-message').text(header);
            this.removeAllFiles();
         if (xhr == null) 
         this.removeFile(file); // perhaps not remove on xhr errors
        
      });
      },
    }); 
    $('#toUploadButton').on('click',function(e){
    e.preventDefault();
    $("#myForm").validate({
          rules: {
              field1: "required"
          },
          messages: {
              field1: "Please specify your name"
          }
      })
      $("#myForm").valid();
      $('#customer_id').prop('required',true);
      $('#title').prop('required',true);
      if( $('#customer_id').val()==''||$('#title').val()=='')
      {
          $("#myForm").valid();
      } 
    if (myDropzone.files.length == 0){
      swal({
             title: "Select File!",
             text: "You should be select any file!",
             icon: "error",
             button: "OK",
          });
        //alert("You should be select any file");
    } else if(myDropzone.getRejectedFiles().length > 0) {
        alert("The attached file is invalid");
    } else {
        myDropzone.processQueue();
    }
});
    $('#startUpload').click(function(e){ 
      $("#myForm").validate({
          rules: {
              field1: "required"
          },
          messages: {
              field1: "Please specify your name"
          }
      })
      e.preventDefault(e);
      e.stopPropagation();
     /*  if (myDropzone.files.length) {
        alert(); */
      $("#myForm").valid();
      $('#customer_id').prop('required',true);
      $('#title').prop('required',true);
      if( $('#customer_id').val()==''||$('#title').val()=='')
      {
          $("#myForm").valid();
      } 
      if (myDropzone.files.length === 0){
        
        alert("You should be select any file");
    } 
    else if(myDropzone.getAcceptedFiles().length) {
        alert("true");
    }else if(myDropzone.getRejectedFiles().length > 0) {
        alert("The attached file is invalid");
    } else {
        myDropzone.processQueue();
    }
      /* if ($("#myForm").valid() == true) { 
         if (myDropzone.getRejectedFiles().length > 0) { 
          alert('true');                         
                            myDropzone.processQueue();  
                        } else {       
                          alert('false');              
                            myDropzone.uploadFiles([]); //send empty 
                        }                                    
                    }        */      
     /*  else if (myDropzone.files.length == 0){
        alert("You should be select any file");
      } else if(myDropzone.getRejectedFiles().length > 0) {
        alert(1);
        alert("The attached file is invalid");
      } else {
        myDropzone.processQueue();
      } */
     /*}  else {
        $("#myForm").valid();
        $('#customer_id').prop('required',true);
      $('#title').prop('required',true);
        $('#myForm').submit(); // submit the form
      } */
    });
  }); 
  </script>
{{-- <script>
  $("#file-5").fileinput({
    overwriteInitial: true, 
    maxFileSize: 1500, 
    showClose: false,
    showCaption: false, 
    browseLabel: '', 
    removeLabel: '',
    browseClass: "btn btn-info", 
    browseValue: "upload", 
   /*  browseIcon: '<i class="glyphicon glyphicon-folder-open"></i>', 
    removeIcon: '<i class="glyphicon glyphicon-remove"></i>', */
    removeTitle: 'Cancel or reset changes', 
    uploadClass: "btn btn-primary",
    showRemove: true,
    showUpload: false,  
    elErrorContainer: '#kv-avatar-errors',
    msgErrorClass: 'alert alert-block alert-danger',
    layoutTemplates: {
        main2: '{preview}{browse} {upload}'
    },  
});
</script> --}}
@endsection