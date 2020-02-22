@extends('layouts.client')
@section('content')
<div class="card">
    <div class="card-header">
        <h3>Albums</h3>
    </div>
    <div class="card-body">
        <table class="table table-stripped">
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Photo</th>
                
               
            </tr>
            @foreach($gallery as $glry)
            <tr>
                <td>{{ $glry->title }}</td>
                <td>{{ $glry->description }}</td>
               
               
             {{-- <td>@if($glry->image['url'])
                        <img src="/{{ $glry->image['url'] }}" alt="" style="width:100px;height:100px;">
                    @else
                    <img src="{{ asset('resources/images/blank_profile_picture.png') }}" alt="" style="width:100px;height:100px;">
                    @endif
                </td>  --}}
                <td>
                    <a href="/client/gallery/{{ $glry->id }}" class="btn btn-success">View</a>
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

<!-- image view more modal -->

<!-- selected image view more modal -->




