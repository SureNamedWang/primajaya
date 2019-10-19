@extends('index')
@section('content')

@if($user->admin!='User')
@if (Session::has('message'))
<div class="alert alert-info">{{ Session::get('message') }}</div>
@endif
<div class="form-group col-sm-12">
    <form method="post" action="{{route('updateBahanProses')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="card">
          <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <select id="cboUkuran" onchange="cboUkuranFucntion()" class="form-control" name="ukuran">
                        <option value="">Pilih Ukuran</option>
                        @foreach ($ukuran as $ukuran)
                        <option value="{{$ukuran->id}}">{{$ukuran->MasterUkuran->ukuran}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <!-- <button class="btn btn-block btn-info mb-3" type="button" id="btnTambah">Tambah Tipe Ukuran</button> -->
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tabelTipe" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Bahan</th>
                            <th scope="col">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                </table>

                <div class="form-group col-sm-12">
                    <input type="submit" class="btn btn-block btn-danger" style="font-weight: bolder" name="submit" value="UPDATE">
                </div>

            </div>
        </div>
    </div>
</form>
</div>

<script type="text/javascript">
    function cboUkuranFucntion() {
        var selUkuran = $('#cboUkuran').find('option:selected').val();
        $.ajax({
            url: "{{ route('ajaxBahan') }}",
            method:'GET',
            data:{id:selUkuran},
            success: function(result){
            console.log(result);
            $('#tbody').html("");
            result.forEach(element => {
                //console.log(element);
                $('#tbody').append(
                '<tr>'+
                    '<td>'+
                        '<div class="form-group col-sm-12">'+
                            '<div class="form-label-group">'+
                                '<input type="text" name="bahan" value="'+element.id_master_bahan+'" disabled>'+
                            '</div>'+
                        '</div>'+
                    '</td>'+
                    '<td>'+
                        '<div class="form-group col-sm-12">'+
                            '<div class="form-label-group">'+
                                '<input type="text" name="jumlah[]" value="'+element.jumlah+'">'+
                            '</div>'+
                        '</div>'+
                    '</td>'+
                    '<input type="hidden" name="id[]" value="'+element.id+'">'+
                '</tr>'
                );
            });
        }});
    }
</script>

@endif
@endsection