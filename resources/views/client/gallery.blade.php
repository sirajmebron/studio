@extends('layouts.client')

<style>

.wrapper {
    padding: 4.5em 0 2.5em 0;
    padding-left: 0px;
    background-color: #ffffff;
    border: solid 2px#eee;
    margin-top: 15px;
    padding-left: 50px;
}
.submit {
    text-align: center;
    margin: 0 auto;
    margin-top: 0px;
    display: block;
    margin-top: 30px;
    background: #0071b3;
    color:#fff;
    border: 0;
    padding: 7px 15px;
    transition: 0.3s all;
}
.submit:hover {
    background: #212121;
}
p {
    text-align: center;
}
input[type="checkbox"][id^="cb"] {
  display: none;
}

label {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

label:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid #4fb333;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
  z-index: 10;
}

label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  content: "✓";
  background-color: #4fb333;
  transform: scale(1);
}

:checked + label img {
  transform: scale(0.9);
  box-shadow: 0 0 5px #333;
  z-index: 1;
}

</style>

@section('content')

<!-- One -->
<div class="card">
    <div class="card-header">
        <h3>Gallery</h3>
    </div>
    <section id="basicusage" class="wrapper special">
		<form action="/client/store_selected_image" class="exampleone" method="POST">
			@csrf
            <div class="row">
            @if($images) @php $n = 1 @endphp
						@foreach($images as $image)
            
              <div class="col-md-2">
					    <input type="hidden" name="gallery_id"  value="{{ $image->imageable_id }}"/>
					  	<input type="checkbox" name="images[]" <?php if(!empty($image_selected->image)){ if(in_array(str_replace('images/','',$image->url),json_decode($image_selected->image))) echo "checked";}?> value="{{ $image->url }}" id="cb{{ $n }}" />
                            <label for="cb{{ $n }}"><img src="/{{ $image->url }}"   alt=""/></label>
                            <a data-fancybox="gallery" class="img-popup" href="/{{ $image->url }}" title="fdgfg"><i class="fa fa-plus"></i></a>            
						</div>
						@php $n++ @endphp
                        @endforeach
                       
                        
						
						</div>
            <input class="submit" type="submit" />
            @else
            <h2 class="text-center w-100">No Images Assigned</h2>
            @endif
					</form>
					<p>
						{{-- <code class="formoutput">Hit submit to see the form serialized.</code> --}}
					</p>
					<p>
					
					</p>
		</section>
</div>			

			

			

		

		<!-- Footer -->
		
		<!-- HeaderMenu -->
			
		<!-- Scripts -->
			<script src="{{ asset('admin/js/jquery-3.3.1.min.js') }}"></script>
			<script src="{{ asset('admin/js/jquery.scrolly.min.js') }}"></script>
			<script src="{{ asset('admin/js/jquery.imgcheckbox.js') }}"></script>
			
		{{-- 	<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script> --}}
@endsection