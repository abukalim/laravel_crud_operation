<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Table Example</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
    .image-sec{
        object-fit: contain;
    }
</style>
</head>
<body>
    <div class="container mt-4">

        <h2 class="mb-4">Welcome {{Auth::user()->name}}     <a href="{{route('logout')}}">Logout</a></h2>

        <a href="{{route('createProduct')}}" class="btn btn-primary">Create</a>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $count=1
                @endphp
                @foreach ( $viewdetails as $view)
                <tr>
                    <td>{{$count++}}</td>
                    <td>{{$view->product_name??''}}</td>
                    <td>{{$view->product_description??''}}</td>
                    <td>{{$view->product_price}}</td>
                    <td>
                        @if(Storage::exists('public/images/'.$view->product_image))
                            <img src="{{ Storage::url('images/'.$view->product_image) }}" class="image-sec" alt="Product Image" width="150" height="150">
                        @else
                            <img src="{{ url('default/default.jpg')}}" class="image-sec" alt="Default Image" width="150" height="150">
                        @endif
                    </td>
                    <td>
                        <a href="{{route('editProduct',['id'=>$view->id])}}">Edit</a>
                   <a href="{{route('deleteProduct')}}">Delete</a>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>
        {{ $viewdetails->links('custom') }}
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
