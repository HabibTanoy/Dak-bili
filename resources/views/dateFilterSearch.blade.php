@extends('master')
@section('content')

    <h3 class="text-center mt-3 mb-4">Delivery Information</h3>
    <form action="{{route('date-filter')}}" method="get">
        @csrf
<div class="container">
    <div class="row" style="margin-left: 150px">
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group mb-4">
                    <div class="input-group-prepend">
                    </div>
                    <input type="date" class="form-control" name="start_date" id="pure-date" aria-describedby="date-design-prepend">
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <div class="input-group mb-4 constrained">
                    <div class="input-group-prepend">
                    </div>
                    <input type="date" class="form-control ppDate" name="end_date" id="from-date" aria-describedby="date-design-prepend">
                </div>
            </div>
        </div>
        <div class="col-md-4" >
            <button class="btn btn-primary">Get Search List</button>
        </div>
        <div class="col-md-3" style="padding-left: 33px">
        </div>
    </div>
</div>
    </form>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card-counter primary">
                    <i class="fa fa-code-fork"></i>
                    <span class="count-numbers">{{$date_wise_delivered}}</span>
                    <span class="count-name">Delivered</span>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card-counter success">
                    <i class="fa fa-users"></i>
                    <span class="count-numbers">{{$date_wise_not_delivered}}</span>
                    <span class="count-name">Cancelled</span>
                </div>
            </div>
        </div>
    </div>
    {{--</div>--}}
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
                @foreach( $search_by_filters as  $filter)
                    <tr>
                        <td >{{$filter->bill_number}}</td>
                        <td >{{$filter->bill_types}}</td>
                        <td>{{$filter->agent_name}}</td>
                        <td>{{$filter->status}}</td>
                        <td>{{$filter->issue_office}}</td>
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
                                            <img src="https://barikoipost.tk/{{$filter->bill_images}}" alt="..." width="200px" height="150px">
                                        </a>
                                    </div>

                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $search_by_filters->links('custom') }}
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

    </script>
@endsection
