<div class="sidebar px-4 py-4 py-md-4 me-0">
            <div class="d-flex flex-column h-100">
                <a href="index.html" class="mb-0 brand-icon">
                    <span class="logo-icon">
                        <i class="bi bi-bag-check-fill fs-4"></i>
                    </span>
                    <span class="logo-text">PSP Edu</span>
                </a>
                <!-- Menu: main ul -->
                <ul class="menu-list flex-grow-1 mt-3">
                    <li><a class="m-link active" href="{{ url('home') }}"><i class="icofont-home fs-5"></i><span>Dashboard</span></a></li>

                    <li><a class="m-link active" href="{{ url('role') }}"><i class="icofont-home fs-5"></i><span>Role</span></a></li>

                    <li><a class="m-link active" href="{{ url('user') }}"><i class="icofont-home fs-5"></i><span>User</span></a></li>
                    <li><a class="m-link active" href="{{ route('Module.new.creates') }}"><i class="icofont-home fs-5"></i><span>Module</span></a></li>

                    
                    <li><a class="m-link active" href="{{ url('parameter') }}"><i class="icofont-home fs-5"></i><span>Parameter</span></a></li>
                    
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#categories" href="#">
                        <i class="icofont-ui-user-group"></i> <span>Masters</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                            <!-- Menu: Sub menu ul -->
                            <ul class="sub-menu collapse" id="categories">
                                <a class="ms-link"
                                    href="{{ url("details") }}" class="nav-link {{ (request()->is('SchoolDetails') || 
                                    request()->is('SchoolDetails/create') || request()->is('SchoolDetails/*/edit') || 
                                    request()->is('SchoolDetails/*')) ? 'active' : '' }}">
                                    School Details
                                </a>
                                <a class="ms-link"
                                    href="{{ url("student") }}" class="nav-link {{ (request()->is('Student') || 
                                    request()->is('Student/create') || request()->is('Student/*/edit') || 
                                    request()->is('Student/*')) ? 'active' : '' }}">
                                    Student
                                </a>
                                <a class="ms-link"
                                    href="{{ url("faculty") }}" class="nav-link {{ (request()->is('Faculty') || 
                                    request()->is('Faculty/create') || request()->is('Faculty/*/edit') || 
                                    request()->is('Faculty/*')) ? 'active' : '' }}">
                                    Faculty
                                </a>
                                <a class="ms-link"
                                    href="{{ url("facultySubject") }}" class="nav-link {{ (request()->is('FacultySubject') || 
                                    request()->is('FacultySubject/create') || request()->is('FacultySubject/*/edit') || 
                                    request()->is('FacultySubject/*')) ? 'active' : '' }}">
                                    Faculty Subject
                                </a>
                                <a class="ms-link"
                                    href="{{ url("facultyAttendance") }}" class="nav-link {{ (request()->is('FacultyAttendance') || 
                                    request()->is('FacultyAttendance/create') || request()->is('FacultyAttendance/*/edit') || 
                                    request()->is('FacultyAttendance/*')) ? 'active' : '' }}">
                                    Faculty Attendance
                                </a>
                                <a class="ms-link"
                                    href="{{ url("studentAttendance") }}" class="nav-link {{ (request()->is('StudentAttendance') || 
                                    request()->is('StudentAttendance/create') || request()->is('StudentAttendance/*/edit') || 
                                    request()->is('StudentAttendance/*')) ? 'active' : '' }}">
                                    Student Attendance
                                </a>
                                <a class="ms-link"
                                    href="{{ url("schedule") }}" class="nav-link {{ (request()->is('Schedule') || 
                                    request()->is('Schedule/create') || request()->is('Schedule/*/edit') || 
                                    request()->is('Schedule/*')) ? 'active' : '' }}">
                                    Schedule
                                </a>
                            </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link {{ (request()->is('studentList') || request()->is('studentList/*')) ? 'active' : '' }}" data-bs-toggle="collapse" data-bs-target="#menu-product" href="#">
                        <i class="icofont-files-stack"></i> <span>Reports</span> <span class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                            <!-- Menu: Sub menu ul -->
                            <ul class="sub-menu collapse {{ (request()->is('studentList') || request()->is('studentList/*')) ? 'show' : '' }}" id="menu-product">
                                <!-- <li> <a class="ms-link"
                                    href="{{ url("student") }}" class="nav-link {{ (request()->is('Student') || 
                                    request()->is('Student/create') || request()->is('Student/*/edit') || 
                                    request()->is('Student/*')) ? 'active' : '' }}">
                                    Student
                                </a></li> -->
                                <li><a class="ms-link {{ (request()->is('studentList') || request()->is('studentList/*')) ? 'active' : '' }}" href="{{ url("studentList") }}">Student List</a></li>
                                <li><a class="ms-link" href="">Faculty List</a></li>
                                <li><a class="ms-link" href="">Faculty Total Working Hours</a></li>
                                <li><a class="ms-link" href="">Student Attendance</a></li>
                                <li><a class="ms-link" href="">Lecture Attendance</a></li>
                            </ul>
                    </li>

                  
                  
                <!-- Menu: menu collepce btn -->
                <button type="button" class="btn btn-link sidebar-mini-btn text-light">
                    <span class="ms-2"><i class="icofont-bubble-right"></i></span>
                </button>
            </div>
        </div>

        <!-- main body area -->
        <div class="main px-lg-4 px-md-4">

            <!-- Body: Header -->
            <div class="header">
                <nav class="navbar py-4">
                    <div class="container-xxl">

                        <!-- header rightbar icon -->
                        <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">
                            <div class="d-flex">
                                <a class="nav-link text-primary collapsed" href="help.html" title="Get Help">
                                    <i class="icofont-info-square fs-5"></i>
                                </a>
                            </div>
                            <div class="dropdown zindex-popover">
                                <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                                    <img src="{{URL::asset('assets/images/flag/GB.png')}}" alt="">
                                </a>
                                <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-md-end p-0 m-0 mt-3">
                                    <div class="card border-0">
                                        <ul class="list-unstyled py-2 px-3">
                                            <li>
                                                <a href="#" class=""><img src="{{URL::asset('assets/images/flag/GB.png')}}" alt=""> English</a>
                                            </li>
                                            <li>
                                                <a href="#" class=""><img src="{{URL::asset('assets/images/flag/DE.png')}}" alt=""> German</a>
                                            </li>
                                            <li>
                                                <a href="#" class=""><img src="{{URL::asset('assets/images/flag/FR.png')}}" alt=""> French</a>
                                            </li>
                                            <li>
                                                <a href="#" class=""><img src="{{URL::asset('assets/images/flag/IT.png')}}" alt=""> Italian</a>
                                            </li>
                                            <li>
                                                <a href="#" class=""><img src="{{URL::asset('assets/images/flag/RU.png')}}" alt=""> Russian</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown notifications">
                                <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                                    <i class="icofont-alarm fs-5"></i>
                                    <span class="pulse-ring"></span>
                                </a>
                                <div id="NotificationsDiv" class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-md-end p-0 m-0 mt-3">
                                    <div class="card border-0 w380">
                                        <div class="card-header border-0 p-3">
                                            <h5 class="mb-0 font-weight-light d-flex justify-content-between">
                                                <span>Notifications</span>
                                                <span class="badge text-white">06</span>
                                            </h5>
                                        </div>
                                        <div class="tab-content card-body">
                                            <div class="tab-pane fade show active">
                                                <ul class="list-unstyled list mb-0">
                                                    <li class="py-2 mb-1 border-bottom">
                                                        <a href="javascript:void(0);" class="d-flex">
                                                            <img class="avatar rounded-circle" src="{{URL::asset('assets/images/xs/avatar1.svg')}}" alt="">
                                                            <div class="flex-fill ms-2">
                                                                <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Chloe Walkerr</span> <small>2MIN</small></p>
                                                                <span class="">Added New Product 2021-07-15 <span class="badge bg-success">Add</span></span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="py-2 mb-1 border-bottom">
                                                        <a href="javascript:void(0);" class="d-flex">
                                                            <div class="avatar rounded-circle no-thumbnail">AH</div>
                                                            <div class="flex-fill ms-2">
                                                                <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Alan	Hill</span> <small>13MIN</small></p>
                                                                <span class="">Invoice generator </span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="py-2 mb-1 border-bottom">
                                                        <a href="javascript:void(0);" class="d-flex">
                                                            <img class="avatar rounded-circle" src="{{URL::asset('assets/images/xs/avatar3.svg')}}" alt="">
                                                            <div class="flex-fill ms-2">
                                                                <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Melanie	Oliver</span> <small>1HR</small></p>
                                                                <span class="">Orader  Return RT-00004</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="py-2 mb-1 border-bottom">
                                                        <a href="javascript:void(0);" class="d-flex">
                                                            <img class="avatar rounded-circle" src="{{URL::asset('assets/images/xs/avatar5.svg')}}" alt="">
                                                            <div class="flex-fill ms-2">
                                                                <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Boris Hart</span> <small>13MIN</small></p>
                                                                <span class="">Product Order to Toyseller</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="py-2 mb-1 border-bottom">
                                                        <a href="javascript:void(0);" class="d-flex">
                                                            <img class="avatar rounded-circle" src="{{URL::asset('assets/images/xs/avatar6.svg')}}" alt="">
                                                            <div class="flex-fill ms-2">
                                                                <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Alan	Lambert</span> <small>1HR</small></p>
                                                                <span class="">Leave Apply</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                    <li class="py-2">
                                                        <a href="javascript:void(0);" class="d-flex">
                                                            <img class="avatar rounded-circle" src="{{URL::asset('assets/images/xs/avatar7.svg')}}" alt="">
                                                            <div class="flex-fill ms-2">
                                                                <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">Zoe Wright</span> <small class="">1DAY</small></p>
                                                                <span class="">Product Stoke Entry Updated</span>
                                                            </div>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <a class="card-footer text-center border-top-0" href="#"> View all notifications</a>
                                    </div>
                                </div>
                            </div>
                            <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                                <div class="u-info me-2">
                                    <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold">John Quinn</span></p>
                                    <small>Admin Profile</small>
                                </div>
                                <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                                    <img class="avatar lg rounded-circle img-thumbnail" src="{{URL::asset('assets/images/profile_av.svg')}}" alt="profile">
                                </a>
                                <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                    <div class="card border-0 w280">
                                        <div class="card-body pb-0">
                                            <div class="d-flex py-1">
                                                <img class="avatar rounded-circle" src="{{URL::asset('assets/images/profile_av.svg')}}" alt="profile">
                                                <div class="flex-fill ms-3">
                                                    <p class="mb-0"><span class="font-weight-bold">John	Quinn</span></p>
                                                    <small class="">Johnquinn@gmail.com</small>
                                                </div>
                                            </div>
                                            
                                            <div><hr class="dropdown-divider border-dark"></div>
                                        </div>
                                        <div class="list-group m-2 ">
                                            <a href="admin-profile.html" class="list-group-item list-group-item-action border-0 "><i class="icofont-ui-user fs-5 me-3"></i>Profile Page</a>
                                            <a href="order-invoices.html" class="list-group-item list-group-item-action border-0 "><i class="icofont-file-text fs-5 me-3"></i>Order Invoices</a>
                                            <a href="{{route('logout')}}" class="list-group-item list-group-item-action border-0 " onclick="event.preventDefault(); document.getElementById('frm-logout').submit();">
                                            <i class="icofont-logout fs-5 me-3"></i>Signout</a>
                                            <form id="frm-logout" action="{{route('logout')}}" method="POST" style="display:none;"> @csrf</form>                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="setting ms-2">
                                <a href="#" data-bs-toggle="modal" data-bs-target="#Settingmodal"><i class="icofont-gear-alt fs-5"></i></a>
                            </div>
                        </div>
        
                        <!-- menu toggler -->
                        <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                            <span class="fa fa-bars"></span>
                        </button>
        
                        <!-- main menu Search-->
                        <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">
                            <div class="input-group flex-nowrap input-group-lg">
                                <input type="search" class="form-control" placeholder="Search" aria-label="search" aria-describedby="addon-wrapping">
                                <button type="button" class="input-group-text" id="addon-wrapping"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
        
                    </div>
                </nav>
            </div>