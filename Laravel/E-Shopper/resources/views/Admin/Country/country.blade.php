@extends('Admin.master');
@section('noi_dung')
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Country</h4>
                    <h6 class="card-title m-t-40"><i class="m-r-5 font-18 mdi mdi-numeric-1-box-multiple-outline"></i> Table With Outside Padding</h6>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Country</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                    @foreach ($country as $value)
                                    <tr>
                                    <th scope="row">{{$value->id}}</th>
                                    <td>{{$value->name}}</td>
                                    <td>
                                        <a href="/create-country">
                                            <button class="btn btn-success">Create</button>
                                        </a>
                                       <form method="POST" action="/delete-country/{{$value->id}}">
                                        @csrf
                                        <button class="btn btn-danger">Delete </button>
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

    </div>

</div>
@endsection
