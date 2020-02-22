@extends('layouts.admin')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Gallery</h3>
    </div>
    <div class="card-body">
        <table class="table table-stripped">
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Photo</th>
                <th>Selected Photo</th>
                <th>Actions</th>
            </tr>
            @foreach($gallery as $glry)
            <tr>
                <td>{{ $glry->title }}</td>
                <td>{{ $glry->description }}</td>
               <td>
                   <textarea id="{{ $glry->id }}" hidden> {{ $glry->id }}</textarea>
                   <span class="btn btn-success text-white bt-a" type="button"><a href="#" class="img-responsive view-more" data-toggle="modal" data-target="#viewmore" file="{{ $glry->id }}"><i class="fa fa-eye text-white"  data-placement="bottom"  title="View Images"></i></a></span>
                   </td>
                <td>
                    <span class="btn btn-success text-white bt-a" type="button"><a href="#" class="img-responsive selected-view-more" data-toggle="modal" data-target="#selected_viewmore" image_selected_id="{{ $glry->image_selected_id }}"><i class="fa fa-eye text-white"  data-placement="bottom"  title="View Selected Images"></i></a></span>
                    </td> 
             {{-- <td>@if($glry->image['url'])
                        <img src="/{{ $glry->image['url'] }}" alt="" style="width:100px;height:100px;">
                    @else
                    <img src="{{ asset('resources/images/blank_profile_picture.png') }}" alt="" style="width:100px;height:100px;">
                    @endif
                </td>  --}}
                <td>
                    <form class="delete" action="/admin/gallery/{{ $glry->id }}" method="POST">
                        <div class="btn-group btn-group-sm" role="group" aria-label="Actions">
                            @csrf
                            @method('DELETE')
                            <a href="/admin/gallery/{{ $glry->id }}/edit" class="btn btn-success">edit</a>
                            <button type="submit" class="btn btn-danger">delete</button>
                        </div>
                    </form>
                </td>
                {{-- <td>{{ $item->image['url'] }} <form action="{{ route('news.destroy', $item->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button></form>
                </td> --}}
            </tr>
            @endforeach
            <meta name="csrf-token" content="{{ csrf_token() }}" />
        </table>
    </div>
</div>
@endsection
<style type="text/css">
    .view-all-iamges{
      float: left
    }
    .view-all-iamges li{
      float: left;
      margin-bottom: 10px;
      list-style: none;
    }
    .modal-dialog {
        margin: 30px auto;
        width: 798px;
    }
</style>
<!-- image view more modal -->
<div class="modal fade" id="viewmore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header" style="border-bottom-width: 0px;">
  <h4 class="modal-title" id="myModalLabel">All Images</h4>
</div>
<div class="viewalliamges">
 <ul class="view-all-iamges" id="view-more">
 </ul>
</div>
<div class="clearfix"></div>
<div class="modal-footer"  style="border-top-width: 0px;">
  <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>
</div>
</div>
</div>
<!-- selected image view more modal -->
<div class="modal fade" id="selected_viewmore" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header" style="border-bottom-width: 0px;">
      <h4 class="modal-title" id="myModalLabel">All Selected Images</h4>
    </div>
    <div class="viewalliamges">
     <ul class="view-all-iamges show-selected-view-more" id="selected-view-more">
     </ul>
    </div>
    <div class="clearfix"></div>
    <div class="modal-footer"  style="border-top-width: 0px;">
      <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
    </div>
    </div>
    </div>
    </div>
@section('scripts')
<script>
     $.ajaxSetup({
            headers:
            { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });
    $(".view-more").click(function(){
      var file_id=$(this).attr('file');
      var files=$("#"+file_id).val();
      var token=$('meta[name="csrf-token"]').attr('content');
      var url="{{ url('gallery/ajax_gallery_view_more_image') }}";
      $.post(url,{file_id:file_id,image:files,token:token}, function(result)
            {
                //alert();
              $('#view-more').html(result);
            });
    });
    </script>
    <script>
        $.ajaxSetup({
               headers:
               { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
           });
       $(".selected-view-more").click(function(){
         var image_selected_id=$(this).attr('image_selected_id');
         //alert(image_selected_id);
         var token=$('meta[name="csrf-token"]').attr('content');
         var url="{{ url('gallery/ajax_gallery_selected_view_more_image') }}";
         $.post(url,{image_selected_id:image_selected_id,token:token}, function(result)
               {
               
                    $('.show-selected-view-more').html(result);
                
                 
               });
       });
       </script>
<script>
    $(".delete").on("submit", function(){
            return confirm("Do you want to delete this item?");
        });
</script>
@endsection
