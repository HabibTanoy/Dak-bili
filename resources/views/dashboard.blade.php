<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dak Bili</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    {{--    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">--}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    {{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>--}}
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/css/style.css">
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" />
</head>
<body>
<div class="container mt-4">
    <h3 class="text-center mb-3">Total Count of Bills</h3>
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
<!---Table List start--->
<h3 class="text-center my-4">Bills Category</h3>
<div class="text-center" role="group" aria-label="Basic example">
    <a href="" type="button" class="btn btn-primary">Registry</a>
    <a href="{{ route('list-gep') }}" type="button" class="btn btn-primary">GEP</a>
    <a href="" type="button" class="btn btn-primary">Parcel</a>
    <a href="" type="button" class="btn btn-primary">Telephone Bill</a>
    <a href="" type="button" class="btn btn-primary">Wasa Bill</a>
</div>

{{--<div class="m-4">--}}
{{--    <table class="table table-bordered">--}}
{{--        <thead>--}}
{{--        <tr>--}}
{{--            <th scope="col">Bill ID</th>--}}
{{--            <th scope="col">Telephone Number</th>--}}
{{--            <th scope="col">Postman Name</th>--}}
{{--            <th scope="col">Status</th>--}}
{{--            <th scope="col">Action</th>--}}
{{--        </tr>--}}
{{--        </thead>--}}
{{--        <tbody>--}}
{{--        @foreach( $bill_lists as  $bill_list)--}}
{{--            <tr>--}}
{{--                <td>{{$bill_list->id}}</td>--}}
{{--                <td>{{$bill_list->phone_number}}</td>--}}
{{--                <td>{{$bill_list->agent_name}}</td>--}}
{{--                <td>{{$bill_list->status}}</td>--}}
{{--                <td>--}}
{{--                    <a class="btn btn-primary" href="{{route('bill-details', $bill_list->id)}}" role="button">View</a>--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endforeach--}}
{{--        </tbody>--}}
{{--    </table>--}}
</div>
</body>
</html>
