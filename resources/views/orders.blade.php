@extends('index')
@section('content')
<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">List Order</h1>
    </div>
</section>

<div class="container mb-4">
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">OrderID</th>
                            <th scope="col">Pembeli</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Total Belanja</th>
                            <th scope="col">Biaya Kirim</th>
                            <th scope="col">Total Harga</th>
                            <th scope="col">Status Pembayaran</th>
                            <th></th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $item)
                        <tr>
                            <td>1</td>
                            <td>Moses</td>
                            <td>2019-05-01</td>
                            <td>50000</td>
                            <td>0</td>
                            <td>50000</td>
                            <td>Belum Lunas</td>
                            <td><button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#myModal">Ubah Biaya Kirim</button></td>
                            <td><button class="btn btn-sm btn-info">Detail Barang</button></td>
                            <td><button class="btn btn-sm btn-dark">SPK</button></td>

                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Ubah Ongkos Kirim</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form>
            <div class="form-group col-sm-12">
                <div class="form-label-group">                
                    <input type="text" name="hargaAwal" value="0" disabled>
                    <label for="hargaAwal">Harga Awal</label>
                </div>
            </div>
            <div class="form-group col-sm-12">
                <div class="form-label-group">                
                    <input type="number" name="hargaBaru">
                    <label for="hargaBaru">Harga Baru</label>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal footer -->
    <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">Ubah</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
    </div>
</div>
</div>
</div>
@endsection