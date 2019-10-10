@extends('index')
@section('content')

@if($user->admin==1)
@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="form-group col-sm-12">
    <form method="post" action="{{route('storeTipe')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="id" value="{{$id}}">
        <div class="card">
          <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h5>Ukuran</h5>
                    <select class="form-control" name="mukuran">
                        <option value="">Pilih Ukuran</option>
                        @foreach ($mukuran as $ukuran)
                        <option value="{{$ukuran->id}}">{{$ukuran->ukuran}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    {{-- <button class="btn btn-block btn-info mb-3" type="button" id="btnTambah">Tambah Tipe Ukuran</button> --}}
                </div>
            </div>
        </div>
        <div class="card-body">
            <input type="hidden" name="asal" value="tambahUkuran">
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

                <div class="form-group col-sm-12">
                    <input type="submit" class="btn btn-block btn-danger" name="submit" value="submit">
                </div>

            </div>
        </div>
    </div>
</form>
</div>

{{-- <script type="text/javascript">
    $('#btnTambah').on('click', function(){
        $( "#tableRow" ).clone().appendTo('tbody')
    })
</script> --}}

@endif
@endsection