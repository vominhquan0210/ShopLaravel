@extends('Admin.master')
@section('noi_dung')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Shopee Blog</h4>
                <div class="form-group">
                    <div class="col-sm-12">
                        <a href="/create-shopee-blog">
                            <button class="btn btn-success">Create Blog</button>
                        </a>
                    </div>
                </div>
                <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Table With Outside Padding</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tittle</th>
                                <th scope="col">Image</th>
                                <th scope="col">Description</th>
                                <th scope="col">Content</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blog as $value )
                            <tr>
                                <th scope="row">{{$value->id}}</th>
                                <td>{{$value->tittle}}</td>
                                <td><img src="{{asset('upload/user/avatar/'. $value->avatar) }}" style="width: 100px; height:80px"></td>
                                <td>{{$value->description}}</td>
                                <td>{{$value->content}}</td>
                                <td>
                                    <a href="/update-shopee-blog/{{$value->id}}">
                                          <button class="btn btn-primary">Update</button>
                                    </a>

                                    <form action="/delete-shopee-blog/{{$value->id}}" method="POST">
                                        @csrf
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

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
</div>
@endsection
