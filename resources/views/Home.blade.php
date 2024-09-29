@extends('Layout/App')

@section('content')
    <!-- Content wrapper -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex flex-row mb-3 d-flex justify-content-center">
            <div class="p-2">
                <div class="card style-course">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-body">
                                <div class="card-info">
                                    <h5 class="mb-3 text-nowrap text-white">
                                        INSTITUTO DOZER
                                    </h5>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="{{ route('home.list', 'dozer') }}" class="btn-index waves-effect">
                                        <span class="me-1"></span>Ver más
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-center d-flex align-items-center align-self-center">
                            <div class="card-body pb-0 pt-3">
                                <img src="{{ asset('img/dozer.png') }}" alt="Ratings" class="img-fluid" width="95" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <div class="card style-course">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-body">
                                <div class="card-info">
                                    <h5 class="mb-3 text-nowrap text-white">CIP</h5>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="content-cip.html" class="btn-index waves-effect">
                                        <span class="me-1"></span>Ver más
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-center d-flex align-items-center">
                            <div class="card-body pb-0 pt-3">
                                <img src="{{ asset('img/cip.png') }}" alt="Ratings" class="img-fluid" width="95" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-2">
                <div class="card style-course">
                    <div class="row">
                        <div class="col-6">
                            <div class="card-body">
                                <div class="card-info">
                                    <h5 class="mb-3 text-nowrap text-white">CAP</h5>
                                </div>
                                <div class="d-flex align-items-center">
                                    <a href="content-cap.html" class="btn-index waves-effect">
                                        <span class="me-1"></span>Ver más
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 text-center d-flex align-items-center">
                            <div class="card-body pb-0 pt-3">
                                <img src="{{ asset('img/cap.png') }}" alt="Ratings" class="img-fluid" width="95" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection()

@section('styles')
@endsection()

@section('scripts')
@endsection
