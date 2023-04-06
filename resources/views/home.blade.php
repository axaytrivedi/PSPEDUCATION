@extends('layouts.app')

@section('content')
            <div class="body d-flex py-3">
                <div class="container-xxl">

                    <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
                        <div class="col">
                            <div class="alert-success alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-success text-light"><i class="fa fa-dollar fa-lg"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Total Faculty</div>
                                        <span class="small">{{ $totalFaculty}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-danger alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-danger text-light"><i class="fa fa-credit-card fa-lg"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Today Absence Faculty</div>
                                        <span class="small">{{$FacultyAbsenceAttendance}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="alert-warning alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-warning text-light"><i class="fa fa-smile-o fa-lg"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">Total Student</div>
                                        <span class="small">{{$CurrentStudent}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col">
                            <div class="alert-info alert mb-0">
                                <div class="d-flex align-items-center">
                                    <div class="avatar rounded no-thumbnail bg-info text-light"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
                                    <div class="flex-fill ms-3 text-truncate">
                                        <div class="h6 mb-0">New StoreOpen</div>
                                        <span class="small">8,925</span>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div><!-- Row end  -->

                    <div class="row g-3">
                        <div class="col-lg-12 col-md-12">
                            <div class="tab-filter d-flex align-items-center justify-content-between mb-3 flex-wrap">
                                <ul class="nav nav-tabs tab-card tab-body-header rounded  d-inline-flex w-sm-100">
                                    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#summery-today" >Today</a></li>
                                    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#summery-week" >Week</a></li>

                                </ul>
                                <div class="date-filter d-flex align-items-center mt-2 mt-sm-0 w-sm-100">
                                    <div class="input-group">
                                        <input type="date" class="form-control">
                                        <button class="btn btn-primary" type="button"><i class="icofont-filter fs-5"></i></button>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content mt-1">
                                <div class="tab-pane fade show active" id="summery-today">
                                    <div class="row g-1 g-sm-3 mb-3 row-deck">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Customers</span>
                                                        <div><span class="fs-6 fw-bold me-2">14,208</span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-student-alt fs-3 color-light-orange"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                      
                                    </div> <!-- row end -->
                                </div>
                                <div class="tab-pane fade" id="summery-week">
                                    <div class="row g-3 mb-4 row-deck">
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Customers</span>
                                                        <div><span class="fs-6 fw-bold me-2">54,208</span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-student-alt fs-3 color-light-orange"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Order</span>
                                                        <div><span class="fs-6 fw-bold me-2">12314</span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-shopping-cart fs-3 color-lavender-purple"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6">
                                            <div class="card">
                                                <div class="card-body py-xl-4 py-3 d-flex flex-wrap align-items-center justify-content-between">
                                                    <div class="left-info">
                                                        <span class="text-muted">Avg Sale</span>
                                                        <div><span class="fs-6 fw-bold me-2">$11770</span></div>
                                                    </div>
                                                    <div class="right-icon">
                                                        <i class="icofont-sale-discount fs-3 color-santa-fe"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                      
                                       
                                    </div> <!-- row end -->
                                </div>
                             
                                
                            </div>
                        </div>
                    </div><!-- Row end  -->
                </div>
            </div>
@endsection
