@foreach ($tipes as $tipe)
<tr>
    <td>
        <div class="form-group col-sm-12">
            <div class="form-label-group">
                <input type="text" name="tipe" value="{{$tipe->hargaTipe->nama}}" disabled>
            </div>
        </div>
    </td>
    <td>
        <div class="form-group col-sm-12">
            <div class="form-label-group">
                <input type="text" name="harga" value="{{$tipe->harga}}">
            </div>
        </div>
    </td>
    <input type="hidden" name="id" value="{{$tipe->id}}">
</tr>
@endforeach