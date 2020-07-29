@extends('templates.default')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">FruitMan Application Administration</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <center><h2 class="card-title" style="text-decoration:underline" >FruitMan Application Dashboard  </h2></center>
            <h6 class="card-subtitle"><b>FruitMan Application Development</b></h6>
            <div class="row">
                <!-- Column -->
                <div class="col-lg-6 col-md-6" >
                    <div class="card">
                        <div class="card-body" style="background: #b8ffc9">
                            <div class="d-flex flex-row" >
                                <div class="round round-lg align-self-center round-info"><i class="mdi mdi-account-card-details"></i></div>
                                <div class="m-l-10 align-self-center">
                                    <h3 class="m-b-0 font-light">{{$userlist}}</h3>
                                    <h5 class="text-muted m-b-0">Jumlah Pengepul</h5></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
                <div class="col-lg-6 col-md-6">
                    <div class="card">
                        <div class="card-body" style="background: #b8ffc9">
                            <div class="d-flex flex-row">
                                <div class="round round-lg align-self-center round-warning"><i class="mdi mdi-account-card-details"></i></div>
                                <div class="m-l-10 align-self-center">
                                    <h3 class="m-b-0 font-lgiht">{{$sellerlist}}</h3>
                                    <h5 class="text-muted m-b-0">Jumlah Penebas pohon</h5></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Column -->
                <!-- Column -->
            </div>
            <div class="row">
            </div>
        </div>
    </div>


@endsection