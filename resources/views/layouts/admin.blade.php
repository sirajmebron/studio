<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/admin/images/favicon.png" type="images/png" sizes="10x10">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
    <link rel="stylesheet" href="/admin/css/main.css">
    <title>studio app</title>
    <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans:400,500,600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Oswald:500,600,700&display=swap" rel="stylesheet">
{{--     <link href="{{ asset('css/IBM.fonts.googleapis.com.css') }}" rel="stylesheet">
    <link href="{{ asset('css/Oswald.fonts.googleapis.com.css') }}" rel="stylesheet"> --}}
    <link href="{{ asset('admin/css/bootstrap-datepicker.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/css/fileinput.min.css') }}">
    <script src="{{ asset('admin/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/js/j.min.js') }}"></script>
 

</head>



<body>


    <div class="dashboard-main-wrapper">
        <nav class="navbar navbar-expand-lg fixed-top"
            style="background: #fff; border-bottom: 1px solid #f1f1f1; height: 65px;">
            <a class="navbar-brand" href="#">
                <h6>Studio application</h6>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto navbar-right-top">
                    <li class="nav-item">
                        <div id="custom-search" class="top-search-bar">
                            <input class="form-control" type="text" placeholder="Search..">

                        </div>
                    </li>
                    <li class="nav-item dropdown notification">
                        <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span
                                class="indicator"></span></a>
                        <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                            <li>
                                <div class="notification-title"> Notification</div>
                                <div class="slimScrollDiv"
                                    style="position: relative; overflow: hidden; width: auto; height: 250px;">
                                    <div class="notification-list"
                                        style="overflow: hidden; width: auto; height: 250px;">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action active">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img
                                                            src="//placehold.it/100x80" alt=""
                                                            class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span
                                                            class="notification-list-user-name">Jeremy Rakestraw</span>
                                                        <div class="notification-date">2 min ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img
                                                            src="//placehold.it/100x80" alt=""
                                                            class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span
                                                            class="notification-list-user-name">John Abraham </span>is
                                                        now following you
                                                        <div class="notification-date">2 days ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img
                                                            src="//placehold.it/100x80" alt=""
                                                            class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span
                                                            class="notification-list-user-name">Monaan Pechi</span> is
                                                        watching your main repository
                                                        <div class="notification-date">2 min ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img
                                                            src="//placehold.it/100x80" alt=""
                                                            class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span
                                                            class="notification-list-user-name">Jessica
                                                            Caruso</span>accepted your invitation to join the team.
                                                        <div class="notification-date">2 min ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="slimScrollBar"
                                        style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px;">
                                    </div>
                                    <div class="slimScrollRail"
                                        style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="list-footer"> <a href="#">View all notifications</a></div>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown connection">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                        <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                            <li class="connection-list">
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img src="//placehold.it/100x80" alt="">
                                            <span>Github</span></a>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img src="//placehold.it/100x80" alt="">
                                            <span>Dribbble</span></a>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img src="//placehold.it/100x80" alt="">
                                            <span>Dropbox</span></a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img src="//placehold.it/100x80" alt="">
                                            <span>Bitbucket</span></a>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img src="//placehold.it/100x80"
                                                alt=""><span>Mail chimp</span></a>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                        <a href="#" class="connection-item"><img src="//placehold.it/100x80"
                                                alt=""><span>Slack</span></a>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="conntection-footer"><a href="#">More</a></div>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown nav-user">
                        <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false"><img src="//placehold.it/100x80" alt=""
                                class="user-avatar-md rounded-circle"></a>
                        <div class="dropdown-menu dropdown-menu-right nav-user-dropdown"
                            aria-labelledby="navbarDropdownMenuLink2">
                            <div class="nav-user-info">
                                <h5 class="mb-0 text-white nav-user-name">John Abraham </h5>
                                <span class="status"></span><span class="ml-2">Available</span>
                            </div>
                                 <a class="dropdown-item" href="/change-password"><i class="fas fa-user mr-2"></i>Account</a>
                            {{-- <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a> --}}
                            <a class="dropdown-item" href="/logout"><i class="fas fa-power-off mr-2"></i>Logout</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

    </div>



    <aside>
        <div class="nav-left-sidebar">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 100%;">
                <div class="menu-list" style="overflow: auto; width: auto; height: 100%; padding-bottom: 60px;">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav flex-column">
                                <li class="nav-divider">
                                    Dashboard
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link <?php if($active_mn=='customers') echo "active" ?>" href="#" data-toggle="collapse" aria-expanded="false"
                                        data-target="#submenu-1" aria-controls="submenu-1"><i
                                            class="fa fa-fw fa-user-circle"></i>Customers </a>
                                    <div id="submenu-1" class="collapse submenu <?php if($active_mn=='customers') echo "show" ?>" style="">
                                        <ul class="nav flex-column ">
                                            <li class="nav-item">
                                                <a class="nav-link <?php if($active_sub_mn=='view_customer') echo "active-sub" ?>" href="/customers">Customers List</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link <?php if($active_sub_mn=='create_customer'||$active_sub_mn=='edit_customer') echo "active-sub" ?>" href="/customers/create">New Customer</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                              
                                <li class="nav-item">
                                    <a class="nav-link <?php if($active_mn=='gallery') echo "active" ?>" href="#" data-toggle="collapse" aria-expanded="false"
                                        data-target="#submenu-2" aria-controls="submenu-2"><i
                                            class="fa fa-fw fa-user-circle"></i>Photo Gallery </a>
                                    <div id="submenu-2" class="collapse submenu <?php if($active_mn=='gallery') echo "show" ?>" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link <?php if($active_sub_mn=='view_gallery') echo "active-sub" ?>" href="/admin/gallery">Photo Gallery</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link <?php if($active_sub_mn=='create_gallery'||$active_sub_mn=='edit_gallery') echo "active-sub" ?>" href="/admin/gallery/create">New Gallery</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                
                               {{--  <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                                        data-target="#submenu-5" aria-controls="submenu-5"><i
                                            class="fas fa-fw fa-table"></i>Photo Gallery</a>
                                    <div id="submenu-5" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="/admin/gallery">Photo Gallery</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/admin/gallery/create">New Gallery</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li> --}}
                               {{--  <li class="treeview">
                                    <a href="#">
                                      <i class="fa fa-th"></i> <span>Forms</span>
                                      <i class="fa fa-angle-left pull-right"></i> 
                                    </a>
                                    <ul class="treeview-menu">
                                      <li class="active"><a href="/admin/gallery"><i class="fa fa-plus"></i>Add Form</a></li>
                                      <li class="active"><a href="/admin/gallery/create"><i class="fa fa-eye"></i>View Form</a></li>
                                    </ul> 
                                  </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                                        data-target="#submenu-6" aria-controls="submenu-6"><i
                                            class="fas fa-fw fa-table"></i>Board Members</a>
                                    <div id="submenu-6" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="/admin/boardmembers">Board Members</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="/admin/boardmembers/create">New Borad Member</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li> --}}

                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                                        data-target="#submenu-7" aria-controls="submenu-7"><i
                                            class="fas fa-fw fa-file"></i> Pages </a>
                                    <div id="submenu-7" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Blank Page</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Blank Page Header</a>
                                            </li>

                                        </ul>
                                    </div>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                                        data-target="#submenu-8" aria-controls="submenu-8"><i
                                            class="fas fa-fw fa-inbox"></i>Apps</a>
                                    <div id="submenu-8" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Inbox</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Email Detail</a>
                                            </li>

                                        </ul>
                                    </div>
                                </li> --}}
                                {{-- <li class="nav-item">
                                    <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false"
                                        data-target="#submenu-9" aria-controls="submenu-9"><i
                                            class="fas fa-fw fa-columns"></i>Icons</a>
                                    <div id="submenu-9" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">FontAwesome Icons</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Material Icons</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="#">Simpleline Icon</a>
                                            </li>

                                        </ul>
                                    </div>
                                </li> --}}

                            </ul>
                        </div>
                    </nav>
                </div>
                <div class="slimScrollBar"
                    style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 218.036px;">
                </div>
                <div class="slimScrollRail"
                    style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
                </div>
            </div>
        </div>
    </aside>

    <div class="dashboard-wrapper">
        <section class="pt-4 pb-4" id="view-form">
            <div class="container">
                @yield('content')
            </div>
        </section>
    </div>

    <!-- Scripts -->
    {{-- <script src="{{ asset('admin/js/jquery-3.3.1.min.js') }}">
    </script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('admin/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('admin/js/fileinput.min.js') }}"></script>
    <script>
        $('#file-fr').fileinput({
            theme: 'fas',
            language: 'fr',
            uploadUrl: '#',
            allowedFileExtensions: ['jpg', 'png', 'gif']
        });
        $('#file-es').fileinput({
            theme: 'fas',
            language: 'es',
            uploadUrl: '#',
            allowedFileExtensions: ['jpg', 'png', 'gif']
        });
        $("#file-0").fileinput({
            theme: 'fas',
            uploadUrl: '#'
        }).on('filepreupload', function(event, data, previewId, index) {
            alert('The description entered is:\n\n' + ($('#description').val() || ' NULL'));
        });
        $("#file-1").fileinput({
            theme: 'fas',
            uploadUrl: '#', // you must set a valid URL here else you will get an error
            allowedFileExtensions: ['jpg', 'png', 'gif'],
            overwriteInitial: false,
            maxFileSize: 1000,
            maxFilesNum: 10,
            //allowedFileTypes: ['image', 'video', 'flash'],
            slugCallback: function (filename) {
                return filename.replace('(', '_').replace(']', '_');
            }
        });
        /*
         $(".file").on('fileselect', function(event, n, l) {
         alert('File Selected. Name: ' + l + ', Num: ' + n);
         });
         */
        $("#file-3").fileinput({
            theme: 'fas',
            showUpload: false,
            showCaption: false,
            browseClass: "btn btn-primary btn-lg",
            fileType: "any",
            previewFileIcon: "<i class='glyphicon glyphicon-king'></i>",
            overwriteInitial: false,
            initialPreviewAsData: true,
            initialPreview: [
                "http://lorempixel.com/1920/1080/transport/1",
                "http://lorempixel.com/1920/1080/transport/2",
                "http://lorempixel.com/1920/1080/transport/3"
            ],
            initialPreviewConfig: [
                {caption: "transport-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 1},
                {caption: "transport-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2},
                {caption: "transport-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3}
            ]
        });
        $("#file-4").fileinput({
            theme: 'fas',
            uploadExtraData: {kvId: '10'}
        });
        $(".btn-warning").on('click', function () {
            var $el = $("#file-4");
            if ($el.attr('disabled')) {
                $el.fileinput('enable');
            } else {
                $el.fileinput('disable');
            }
        });
        $(".btn-info").on('click', function () {
            $("#file-4").fileinput('refresh', {previewClass: 'bg-info'});
        });
        /*
         $('#file-4').on('fileselectnone', function() {
         alert('Huh! You selected no files.');
         });
         $('#file-4').on('filebrowse', function() {
         alert('File browse clicked for #file-4');
         });
         */
        $(document).ready(function () {
            $("#test-upload").fileinput({
                'theme': 'fas',
                'showPreview': false,
                'allowedFileExtensions': ['jpg', 'png', 'gif'],
                'elErrorContainer': '#errorBlock'
            });
            $("#kv-explorer").fileinput({
                'theme': 'explorer-fas',
                'uploadUrl': '#',
                overwriteInitial: false,
                initialPreviewAsData: true,
                initialPreview: [
                    "http://lorempixel.com/1920/1080/nature/1",
                    "http://lorempixel.com/1920/1080/nature/2",
                    "http://lorempixel.com/1920/1080/nature/3"
                ],
                initialPreviewConfig: [
                    {caption: "nature-1.jpg", size: 329892, width: "120px", url: "{$url}", key: 1},
                    {caption: "nature-2.jpg", size: 872378, width: "120px", url: "{$url}", key: 2},
                    {caption: "nature-3.jpg", size: 632762, width: "120px", url: "{$url}", key: 3}
                ]
            });
            /*
             $("#test-upload").on('fileloaded', function(event, file, previewId, index) {
             alert('i = ' + index + ', id = ' + previewId + ', file = ' + file.name);
             });
             */
        });
    </script>
    <script src="/admin/js/main.js"></script>
   {{--  <script>
        $(document).ready(function() {
         alert();
            var krajeeGetCount = function(id) {
                var cnt = $('#' + id).fileinput('getFilesCount');
                return cnt === 0 ? 'You have no files remaining.' :
                    'You have ' +  cnt + ' file' + (cnt > 1 ? 's' : '') + ' remaining.';
            };
            $('#file-6').fileinput({
                overwriteInitial: false,
                validateInitialCount: true,
                initialPreview: [
                    "<img class='kv-preview-data file-preview-image' src='https://placekitten.com/800/460'>",
                    "<img class='kv-preview-data file-preview-image' src='https://placekitten.com/960/552'>",
                ],
                initialPreviewConfig: [
                    {caption: "Cats-1.jpg", width: "120px", url: "/site/file-delete", key: 1},
                    {caption: "Cats-2.jpg", width: "120px", url: "/site/file-delete", key: 2}
                ],
            }).on('filebeforedelete', function() {
                return new Promise(function(resolve, reject) {
                    $.confirm({
                        title: 'Confirmation!',
                        content: 'Are you sure you want to delete this file?',
                        type: 'red',
                        buttons: {   
                            ok: {
                                btnClass: 'btn-primary text-white',
                                keys: ['enter'],
                                action: function(){
                                    resolve();
                                }
                            },
                            cancel: function(){
                                $.alert('File deletion was aborted! ' + krajeeGetCount('file-6'));
                            }
                        }
                    });
                });
            }).on('filedeleted', function() {
                setTimeout(function() {
                    $.alert('File deletion was successful! ' + krajeeGetCount('file-6'));
                }, 900);
            });
        });
        </script> --}}
    @yield('scripts')
    <script type="text/javascript">
    $(document).ready(function(){
    $('.date').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight: true,
    });
    });
    </script>
    
 {{--    <script>
        $(document).ready(function () {
          var url = window.location;
         
          $('ul.treeview-menu a[href="' + this.location.pathname + '"]').parent().addClass('active');
          $('ul.treeview-menu a').filter(function() {
              //alert();
             return this.href == url;
          }).parent().parent().parent().addClass('active');
       });
       </script> --}}
    
    @include('sweetalert::alert')
</body>

</html>
