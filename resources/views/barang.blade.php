@extends('index')
@section('content')

@if($user->admin==1)
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">List Barang</h1>
    </div>
</section>
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table id="tblBarang-datatables" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" colspan="1">Aksi</th>
                            <th scope="col">Thumbnail</th>
                            <th scope="col">Nama</th>
                            <th scope="col" class="w-15">Detail</th>
                            {{-- <th></th>
                            <th></th>
                            <th></th>
                            <th></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $item)
                        <tr>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Dropdown button
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="{{route('tipe', ['id' => $item->id])}}">Tambah Tipe</a>
                                        <a class="dropdown-item" href="{{route('gambar', ['id' => $item->id])}}">List Gambar</a>
                                        <a class="dropdown-item" href="{{route('updateTipeView', ['id' => $item->id])}}">Update Tipe</a>
                                        <a class="dropdown-item" data-toggle="modal" data-target="#myModal{{$item->id}}">Edit Barang</a>
                                    </div>
                                </div>
                            </td>
                            <td><img src="{{asset('storage/'.$item->gambarProduct->where('thumbnail', 1)->first()->gambar)}}" style="height: 50px;width: 50px;" /></td>
                            <td>{{$item->nama}}</td>
                            <td>{{substr($item->detail, 0,50)}}...</td>
                            {{-- <td>
                                <a href="{{route('tipe', ['id' => $item->id])}}" class="btn btn-info">Tambah Tipe</a>
                            </td>
                            <td>
                                <a href="{{route('gambar', ['id' => $item->id])}}" class="btn btn-info">List Gambar</a>
                            </td>
                            <td>
                                <a href="{{route('updateTipeView', ['id' => $item->id])}}" class="btn btn-danger"> Update Tipe</a>
                            </td>
                            <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal{{$item->id}}">Edit Barang</button></td> --}}

                            <!-- The Modal -->
                            <div class="modal" id="myModal{{$item->id}}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                              <h4 class="modal-title">Approve Pembayaran</h4>
                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          </div>
    
                                          <!-- Modal body -->
                                          <form method="post" action="{{route('editBarang')}}">
                                            {{csrf_field()}}
                                            <div class="modal-body">
                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group text-center">
                                                        <img src="{{asset('storage/'.$item->gambarProduct->where('thumbnail', 1)->first()->gambar)}}" style="height: 200px;width: 200px;" />
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">
                                                        <input type="text" class="w-100" name="nama" value="{{$item->nama}}" required>
                                                        <label for="nama">Nama</label>
                                                    </div>
                                                </div>
                                                <div class="form-group col-sm-12">
                                                    <div class="form-label-group">
                                                        <h6>Detail</h6>
                                                        <textarea name="detail" class="w-100" cols="25" rows="5">{{$item->detail}}</textarea>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="idBarang" value="{{$item->id}}">
                                            </div>
    
                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <input type="submit" name="submit" class="btn btn-info" value="Update"></button>
    
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /endModal -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-6">
                        <a href="{{route('barang.create')}}" class="btn btn-block btn-info">Tambah Barang</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endif
@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function() {
		$('#tblBarang-datatables').DataTable({
		});
    })
</script>
@endsection