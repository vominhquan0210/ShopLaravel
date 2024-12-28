@extends('Admin.master')
@section('noi_dung')
<div class="container-fluid">
    <div class="row">
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

        <div class="col-md-12 ">
            <div class="card">
                <div class="card-body">
                    <form action="/create/category" class="form-horizontal form-material"
                       method="POST">
                        @csrf

                        <div class="form-group">
                            <label class="col-md-12">Category</label>
                            <div class="col-md-12">
                                <input type="text" name="category"
                                    class="form-control form-control-line" placeholder="Category">
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-sm-12">
                                <button class="btn btn-success">Create category</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
@endsection
