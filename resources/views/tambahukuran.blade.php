@extends('index')
@section('content')

@if($user->admin==1)

<div class="form-group col-sm-12">

    <div class="card">
      <div class="card-header">
        <div class="row">
            <div class="col-6">
                <select class="form-control" name="ukuran[]">
                    <option value="">Pilih Ukuran</option>
                    @foreach ($ukuran as $ukuran)
                    <option value="{{$ukuran->id}}">{{$ukuran->ukuran}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-6">
                <button class="btn btn-block btn-info mb-3" type="button" id="btnTambah">Tambah Ukuran</button>
            </div>
        </div>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Tipe</th>
                        <th scope="col">Harga</th>
                    </tr>
                </thead>
                <tbody id="tbody">

                    <tr id="tableRow">
                        <td>
                            <div class="form-group col-sm-12">
                                <div class="form-label-group">
                                    <select class="form-control" name="tipe[]">
                                        <option value="">Pilih Tipe</option>
                                        @foreach ($tipe as $tipe)
                                        <option value="{{$tipe->id}}">{{$tipe->nama}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group col-sm-12">
                                <div class="form-label-group">
                                    <input type="text" name="harga[]" required>
                                </div>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endif
@endsection