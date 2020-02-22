@extends('layouts.admin')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th class="th-sm">Name
                            </th>
                            <th class="th-sm">Mobile
                            </th>
                            <th class="th-sm">Secondary Mobile
                            </th>
                            <th class="th-sm">Email
                            </th>
                            <th class="th-sm">Address
                            </th>
                            <th class="th-sm">Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($customers as $customer)
                        <tr>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->mobile }}</td>
                            <td>{{ $customer->secondary_mobile }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->address }}</td>
                            <td>
                                <form action="/customers/destroy/{{ $customer->id }}" method="POST">
                                    @csrf
                                   {{--  @method('DELETE') --}}
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Actions">
                                        <a href="/customers/edit/{{ $customer->id }}" class="btn btn-success">edit</a>
                                       {{--  <a href="/admin/listings/add_listing/{{ $customer->id }}"
                                            class="btn btn-primary">Add Listing</a> --}}
                                       {{--  @if( !membership($customer->id))
                                        <a href="/admin/subscriptions/subscribe/{{ $customer->id }}"
                                            class="btn btn-warning">Subscribe</a>
                                            @endif --}}
                                        <button type="submit" class="btn btn-danger">delete</button>
                                    </div>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Name
                            </th>
                            <th>Mobile
                            </th>
                            <th>Secondary Mobile
                            </th>
                            <th>Email
                            </th>
                            <th>Address
                            </th>
                            <th>Action
                            </th>
                           
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        @endsection
