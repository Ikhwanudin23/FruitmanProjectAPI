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
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
      <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ $message }}</strong>
    </div>
  @endif
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Daftar Penjual Buah</h4>
            <h6 class="card-subtitle"><b>FruitMan Application Development</b></h6>
            <div class="table-responsive m-t-10">
                <div id="myTable_wrapper" class="dataTables_wrapper no-footer">
                    <table id="myTable" class="table table-bordered table-striped dataTable no-footer" role="grid"
                           aria-describedby="myTable_info">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Foto</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datas as $data)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$data->user_id ? $data->user->name : $data->seller->name}}</td>
                                <td>{{$data->user_id ? $data->user->email : $data->seller->email}}</td>
                                <td>{{$data->user_id ? 'Penebas' : 'Penjual'}}</td>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#img{{$data->id}}"><img src="{{$data->image}}" width="40px" height="40px"></a></td>
                                <td>
                                    {{-- <a href="{{ route('premium.decline') }}" class="btn btn-sm btn-danger">cancel</a> --}}
                                    <a href="{{ route('premium.confirmed', $data->id) }}" 
                                        onclick="return confirm('apakah anda yakin ingin mengkonfirmasi user ini?')"
                                        class="btn btn-sm btn-success">konfirmasi</a>                      
                                </td>
                            </tr>

                            <!-- Modal -->
<div class="modal fade" id="img{{ $data->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{$data->user_id ? $data->user->name. ' - Penebas' : $data->seller->name. ' - Penjual'}}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="d-flex justify-content-center">
                <img src="{{ $data->image }}" width="200px" height="auto">
            </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Oke</button>
        </div>
      </div>
    </div>
  </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection