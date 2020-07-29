<!DOCTYPE html>
<html>
<head>
    <title>Laporan Data Transaksi Pengepul dan Penebas</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .table {
            font-size: 15px;
            border-collapse: collapse;
        }
        .table-laporan th,.table-laporan td {
            border: 1px solid #000;
        }
        .table tr,.table td {
            height: 22px;
            text-align: center;
        }
        .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th
        {
            padding:0;
        }
    </style>

</head>
{{--<div align="center">--}}
{{--<img src="{{asset('assets/images/logomin.png')}}">--}}
{{--</div>--}}
<div align="center">
    {{--<tr>--}}
    {{--<td>--}}
    <center>
        <font size="4">LAPORAN HISTORY TRANSAKSI USER APLIKASI FRUITMAN</font><BR>
        <font size="5"><b>PENGELOLA APLIKASI FRUITMAN</b></font><BR>
        <font size="2"><i>Email : fruitmanapp@gmail.com, Website : http://fruitman.tugas-akhir.com/</i><BR></font>
    </center>
    {{--</td>--}}
    {{--</tr>--}}
    {{--<tr>--}}
    {{--<td colspan="2">--}}
    <hr style="height:1px;border:none;color:#333;background-color:#333;">
    {{--</td>--}}
    {{--</tr>--}}
</div>
<body>

<center>
    <font size="3"><b>Laporan Data Histori Transaksi Sudah Selesai Pengepul dan Penebas</b></font>
    <br>
    <font size="3"><b> </b></font>
</center>

<br>
<table id="example1" class="table table-laporan" align="center"
       style="border-collapse: collapse; width: 100%;" border="1">
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
</body>
</html>