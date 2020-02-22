@extends('layouts.client')
@section('content')

          <div class="row">
              <div class="col-md-3">
                  <div class="card">
                      <div class="icon"><i class="fas fa-compass"></i></div>
                      <h6>Listing</h6>
                      {{-- <span>{{ $data['listing_count'] }}</span> --}}
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="card">
                      <div class="icon">
                          <i class="fas fa-user-tie"></i>
                      </div>
                      <h6>Committee</h6>
                      {{-- <span>{{ $data['board_count'] }}</span> --}}
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="card">
                      <div class="icon">
                          <i class="fas fa-users" ></i>
                      </div>
                      <h6> Members List</h6>
                      {{-- <span>{{ $data['members_count'] }}</span> --}}
                  </div>
              </div>

              <div class="col-md-3">
                  <div class="card">
                      <div class="icon">
                          <i class="fas fa-comment" ></i>
                      </div>
                      <h6>About Us</h6>
                      <span>20</span>
                  </div>
              </div>

          </div>
      </div>
  </section>

  <section class="pt-0 pb-4" id="table">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <div class="card">
                      <div class="card-body new-user order-list">
                          <h4 class="header-title mt-0 mb-3">Directory</h4>
                          <div class="table-responsive">
                              <table class="table table-hover mb-0">
                                  <thead class="thead-light">
                                      <tr>
                                          <th class="border-top-0">S.NO</th>
                                          <th class="border-top-0">NAME</th>
                                          <th class="border-top-0">SHOP</th>
                                          <th class="border-top-0">ADDRESS</th>
                                          <th class="border-top-0">PHONE</th>
                                      </tr>
                                  </thead>
                                  <tbody>
                                      <tr>
                                          <td>1</td>
                                          <td>John Doe</td>
                                          <td>Gents Fashion </td>
                                          <td>Busstand , Tirur </td>
                                          <td>+91 123-456-789</td>
                                      </tr>
                                      <tr>
                                          <td>2</td>
                                          <td>John Doe</td>
                                          <td>Gents Fashion </td>
                                          <td>Busstand , Tirur </td>
                                          <td>+91 123-456-789</td>
                                      </tr>
                                      <tr>
                                          <td>3</td>
                                          <td>John Doe</td>
                                          <td>Gents Fashion </td>
                                          <td>Busstand , Tirur </td>
                                          <td>+91 123-456-789</td>
                                      </tr>
                                      <tr>
                                          <td>4</td>
                                          <td>John Doe</td>
                                          <td>Gents Fashion </td>
                                          <td>Busstand , Tirur </td>
                                          <td>+91 123-456-789</td>
                                      </tr>
                                      <tr>
                                          <td>5</td>
                                          <td>John Doe</td>
                                          <td>Gents Fashion </td>
                                          <td>Busstand , Tirur </td>
                                          <td>+91 123-456-789</td>
                                      </tr>
                                      <tr>
                                          <td>6</td>
                                          <td>John Doe</td>
                                          <td>Gents Fashion </td>
                                          <td>Busstand , Tirur </td>
                                          <td>+91 123-456-789</td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

@endsection
