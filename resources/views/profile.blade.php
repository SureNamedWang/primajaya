@extends('index')
@section('content')

@if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

@if($user->admin!='User')
<div class="container">
    <form method="post" action="{{route('editProfile')}}">
    @csrf
    <div class="row">
        <div class="col-md-8">
            <div class="card card-with-nav">
                <div class="card-header">
                    <div class="row row-nav-line">
                        <ul class="nav nav-tabs nav-line nav-color-secondary" role="tablist">
                            <li class="nav-item"> <a class="nav-link" data-toggle="tab" role="tab" aria-selected="false">Profile</a> </li>
                        </ul>
                    </div>
                    </div>
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Name</label>
                                    <input type="text" class="form-control" name="name" placeholder="Name" value="{{$user->name}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="{{$user->email}}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group form-group-default">
                                    <label>Phone</label>
                                    <input type="text" class="form-control" value="{{$user->telp}}" name="phone" placeholder="Phone">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <div class="form-group form-group-default">
                                    <label>Address</label>
                                    <input type="text" class="form-control" value="{{$user->alamat}}" name="address" placeholder="Address">
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-3 mb-3">
                            <input type="submit" class="btn btn-success" value="Save">
                        </div>
                    </div>
                </div>
            </div>    
        </div>
    </form>
</div>

@endif
@endsection