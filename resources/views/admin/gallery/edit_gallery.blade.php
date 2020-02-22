@extends('layouts.admin')
@section('content')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.9/sweetalert2.min.css">
<link rel="stylesheet" href="{{ asset('dropzone/dropzone.css') }}">
<script src="{{ asset('dropzone/dropzone.js') }}"></script>
<script src="{{ asset('admin/js/jquery.validate.min.js') }}"></script>
<div class="card">
    <div class="card-header">
        <h3>Update Gallery</h3>
    </div>
    <div class="card-body">
        <form id="myForm" action="/admin/gallery/{{ $gallery->id }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="form-group row">
              <label for="customer" class="col-4 col-form-label">Customer</label>
              <div class="col-8">
                <select class="form-control select" name="customer_id" id="customer_id">
                  <option value="">select</option>
                  @foreach($customers ?? '' as $customer)
                  <option value="{{ $customer->id}}" {{ old('customer_id',$gallery->customer_id)==$customer->id ? 'selected':''}}>{{   $customer->name     }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label for="title" class="col-4 col-form-label">Title</label>
              <div class="col-8">
                <input id="title" name="title" placeholder="Enter title" type="text" class="form-control" value="{{ $gallery->title }}" required="required">
              </div>
            </div>
            <div class="form-group row">
              <label for="description" class="col-4 col-form-label">Description</label>
              <div class="col-8">
                <textarea id="description" name="description" cols="40" rows="5" class="form-control" >{{ $gallery->description }}</textarea>
              </div>
            </div>
            <div class="form-group">
              <div  class="dropzone" id="my-awesome-dropzone">
                <div  class="dz-error-message"></div>
              </div>
              <meta name="csrf-token" content="{{ csrf_token() }}" />
              </div>
           {{--  <div class="form-group">
              <div class="file-loading">
                  <input id="file-5" name="image[]" class="file" type="file" multiple data-preview-file-type="any" data-upload-url="#" data-theme="fas">
              </div>
          </div> --}}
            {{-- <div class="form-group row">
              <label for="image" class="col-4 col-form-label">Post Image</label>
              <div class="col-8">
                @if($gallery->image['url'])
                <img src="/{{ $gallery->image['url'] }}" alt="" style="width:100px;height:100px;">
                @else
                <img src="{{ asset('resources/images/blank_profile_picture.png') }}" alt="" style="width:100px;height:100px;">
                @endif
              <input type="file" class="form-control-file" name="image">
              </div>
            </div> --}}
           {{--  <div class="form-group row">
              <div class="offset-4 col-8">
                <button name="submit" type="submit" class="btn btn-primary">Submit</button>
              </div>
            </div> --}}
          </form>
          <button name="submit" id="toUploadButton" type="button" class="btn btn-primary">Submit</button>
    </div>
</div>
<script>
  //Disabling autoDiscover
   Dropzone.autoDiscover = false;
  $(function() {
      //Dropzone class
      var myDropzone = new Dropzone(".dropzone", {
      url: "/gallery/update/{{ $gallery->id }}",
      paramName: "image",
      parallelUploads: 100,  
      maxFilesize: 500,
      addRemoveLinks: true,
      dictCancelUpload: "Cancel",
      maxFiles: 100,
      uploadMultiple: true,
      clickable: true,
      headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
      removedfile: function(file) {
            //alert(file.name);
            var image = file.name;
            //alert(image);
            var id = '{{ $gallery->id }}';
            var _token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
            type: 'POST',
            url: "{{ url('/gallery/destroy_gallery_upload_image')}}",
            data: {image: image, id: id,_token:_token},
            dataType: 'html'
            });
            swal({
             title: "File Deleted!",
             text: "File Deleted Successfully!",
             icon: "success",
             button: "OK",
          });
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
        },
         //acceptedFiles: ".jpeg,.jpg,.png,.gif,.JPEG,.JPG,.PNG,.GIF,.pdf,.pub",
          autoProcessQueue: false, 
          init: function() {
            <?php if($gallery->image)
             {
              foreach($gallery->image as $gly)
              {?>
                $path ='/{{ $gly->url  }}';
                //alert($path);
                var mockFile = { name: "{{ str_replace('images/', '', $gly->url)  }}", size: 12345, type: 'image/jpeg' };       
                this.options.addedfile.call(this, mockFile);
                //this.createThumbnailFromUrl(mockFile, "/images/1580990059-avatar.jpg"); 
                this.createThumbnailFromUrl(mockFile, "/{{ $gly->url  }}");
                mockFile.previewElement.classList.add('dz-success');
                mockFile.previewElement.classList.add('dz-complete'); 
              <?php }
             }?>

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
          this.on("sending", function(file, xhr, formData) { 
            // Will sendthe filesize along with the file as POST data.
            formData.append("filesize", file.size);
            formData.append("_token", $('meta[name="csrf-token"]').attr('content')),
            formData.append('customer_id',$('#customer_id').val());
            formData.append('title',$('#title').val());
            formData.append('description',$('#description').val());       
           });
           this.on("success", function(file, responseText) {
            
            window.location.href = ("{{url('admin/gallery/')}}"); 
           });
           this.on("error", function(file, message, xhr) { 
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
      } 
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
      if (myDropzone.files.length) {
      $("#myForm").valid();
      $('#customer_id').prop('required',true);
      $('#title').prop('required',true);
      if( $('#customer_id').val()==''||$('#title').val()=='')
         {
          $("#myForm").valid();
         }
         else{
          myDropzone.processQueue(); // upload files and submit the form
         }
      } else {
        $("#myForm").valid();
        $('#customer_id').prop('required',true);
      $('#title').prop('required',true);
        $('#myForm').submit(); // submit the form
      }
    });;
  }); 
  </script>
@endsection
