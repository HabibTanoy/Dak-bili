@extends('master')
@section('content')
<style>
    .has-search {
    position: relative;
}

.has-search .form-control {
    padding-left: 2.375rem;
}

.has-search .form-control-feedback {
    position: absolute;
    z-index: 2;
    display: block;
    width: 2.375rem;
    height: 2.375rem;
    line-height: 2.375rem;
    text-align: center;
    pointer-events: none;
    color: #aaa;
}
a {
    text-decoration: none;
    color: white;
}
a:hover {
    text-decoration: none;
    color: white;
}
</style>
<div class="container">
    <h3 class="text-center my-3">Total Count of Bills</h3>
    <div class="row">
        <div class="col-md-6">
            <div class="card-counter primary">
                <i class="fa fa-code-fork"></i>
                <span class="count-numbers">{{count($total_delivered)}}</span>
                <span class="count-name">Total Delivered</span>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card-counter success">
                <i class="fa fa-users"></i>
                <span class="count-numbers">{{count($total_not_delivered)}}</span>
                <span class="count-name">Total Cancelled</span>
            </div>
        </div>
    </div>
</div>
<form action="{{route('dashboard')}}" method="get" class="mt-3">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="main">
                    <div class="form-group has-search">
                        <span class="fa fa-search form-control-feedback"></span>
                        <input type="text" name="id" class="form-control" placeholder="Bill Number">
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary">Search</button>
            </div>
        </div>
    </div>
</form>
<!---Table List start--->
<h3 class="text-center my-4">Bills Category</h3>
<div class="text-center" role="group" aria-label="Basic example">
    <button type="button" class="btn btn-primary">
        <a href="{{route('registry')}}">Registry</a>
    </button>
    <button type="button" class="btn btn-primary" >
        <a href="{{route('gep')}}">GEP</a>
    </button>
    <button  type="button" class="btn btn-primary" >
        <a href="{{route('parcel')}}">Parcel</a>
    </button>
    <button  type="button" class="btn btn-primary">
        <a href="{{route('tele-bill')}}">Telephone Bill</a>
    </button>
    <button  type="button" class="btn btn-primary" >
        <a href="{{route('wasa-bill')}}">Wasa Bill</a>
    </button>
</div>
{{--    table generate--}}
<div class="m-4">
    <table class="table table-bordered text-center">
        <thead>
        <tr>
            <th scope="col">Bill Number</th>
            <th scope="col">Bill Types</th>
            <th scope="col">Agent Name</th>
            <th scope="col">Status</th>
            <th scope="col">Issue Offices</th>
            <th scope="col" class="text-center">Bill Images</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $bill_serach_by_id as  $id)
            <tr>
                <td >{{$id->bill_number}}</td>
                <td >{{$id->bill_types}}</td>
                <td>{{$id->agent_name}}</td>
                <td>{{$id->status}}</td>
                <td>{{$id->issue_office}}</td>
                <td>
                    <div class="container">

                        <div class="modal fade" id="image-modal" tabindex="-1" role="dialog">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header" style="justify-content: end">
                                        <button onclick="onCancel()" type="button" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Cancel</button>
                                    </div>
                                    <div class="modal-body">
                                        <img class="img-responsive center-block" src="" alt="" width="90%" height="80%">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="thumbnail">
                                <img src="https://barikoipost.tk/{{$id->bill_images}}" alt="..." width="200px" height="150px">
                            </a>
                        </div>

                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<script>
    function onCancel() {
        $("#image-modal").modal('hide')
    }

    $(function() {
        $('a.thumbnail').click(function(e) {
            e.preventDefault();
            $('#image-modal .modal-body img').attr('src', $(this).find('img').attr('src'));
            $("#image-modal").modal('show');
        });

        $('#image-modal .modal-body img').on('click', function() {
            $("#image-modal").modal('hide')
        });
    });
    // function hello(bill_type) {
    //     console.log('hello....', bill_type);
    // }

</script>
@endsection
