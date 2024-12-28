@extends('Frontend.master')
@section('noi_dung')
@if (session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    {{ session('success') }}
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<section>
    <div class="container">
        <div class="row">
           @include('Frontend.Layout.left-sidebar-account')
            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Update user</h2>
                     <div class="signup-form">
                    <h2>Update User</h2>
                    <form action="/update/user/profile/{{$user->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input name="name" type="text" placeholder="Name" value="{{$user->name}}"/>
                        <input name="email" type="email" placeholder="Email Address" value="{{$user->email}}"/>
                        <input name="password" type="password" placeholder="Password" value="{{$user->password}}"/>
                        <input name="phone" type="text" placeholder="Phone" value="{{$user->phone}}"/>
                        <input name="address" type="text" placeholder="Address" value="{{$user->address}}"/>
                        <input name="avatar" type="file"/>
                        <select name="id_country">
                            @foreach ($country as $value)
                            <option value="{{$value->id}}" @selected($value->id == $user->id_country)>{{$value->name}}</option>
                            @endforeach
                        </select>
                        <button type="submit" class="btn btn-default">Update user</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
