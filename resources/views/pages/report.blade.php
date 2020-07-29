@extends('templates.default')

@section('content')
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">FruitMan Application Administration</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Penjual</li>
                <li class="breadcrumb-item active">Daftar Penjual</li>
            </ol>
        </div>
    </div>
    <div class="card">
        <div class="card-body printableArea">
            <h4 class="card-title">Daftar Penjual Buah</h4>
            <h6 class="card-subtitle"><b>FruitMan Application Development</b></h6>
            <a href="{{route('report.print')}}" class="btn btn-default btn-outline"> <span><i class="fa fa-print"></i> </span> Print </a>
            <div class="table-responsive m-t-10">
                <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                    <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid"
                           aria-describedby="myTable_info">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pengepul</th>
                            <th>Nama Penebas </th>
                            <th>Nama produk</th>
                            <th>Harga produk</th>
                            <th>Harga Sepakat</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->user->name}}</td>
                                <td>{{$data->seller->name}}</td>
                                <td>{{$data->product->name}}</td>
                                <td>{{$data->product->price}}</td>
                                <td>{{$data->offer_price}}</td>
                            </tr>
                       @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection