<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<style>
     label.error {
    color: red;
  }
</style>
</head>
<body>
    <div class="container mt-4">

        <h2 class="mb-4"> {{Auth::user()->name}}     <a href="{{route('logout')}}">Logout</a></h2>
        <h2>Create Product</h2>
        @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Success!</h4>
        <p>{{ Session::get('success') }}</p>

        <button type="button" class="close" data-dismiss="alert aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

@if (Session::has('errors'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <h4 class="alert-heading">Error!</h4>
            <p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </p>

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
    </div>
@endif
        <form method="POST" action="{{route('submitProduct')}}" enctype="multipart/form-data" id="createForm">
          @csrf
        <div class="row">
            <div class="col-md-6">
                  <!-- Product Name -->
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" name="product_name" class="form-control" id="productName" placeholder="Enter product name" >
            </div>

            <!-- Product Description -->
            <div class="mb-3">
                <label for="productDescription"  class="form-label">Product Description</label>
                <textarea class="form-control" name="product_desc" id="productDescription" rows="4" placeholder="Enter product description" ></textarea>
            </div>

            <!-- Price -->
            <div class="mb-3">
                <label for="price"  class="form-label">Price</label>
                <input type="text" name="product_price" class="form-control" id="price" placeholder="Enter price" >
            </div>

            <!-- Product Image -->
            <div class="mb-3">
                <label for="productImage" class="form-label">Product Image</label>
                <input class="form-control" name="product_image" type="file" id="productImage" accept="image/*" >
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
            </div>
            </div>
        </div>
        {{-- <form>
            <div class="form-group">
              <label for="exampleInputEmail1">Email address</label>
              <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
              <label for="exampleInputPassword1">Password</label>
              <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <div class="form-group form-check">
              <input type="checkbox" class="form-check-input" id="exampleCheck1">
              <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form> --}}

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
    <script>
        $(document).ready(function () {
  $("#createForm").validate({
    rules: {
        product_name: {
        required: true,
        minlength: 10
      },
      product_desc: {
        required: true,
      },
      product_price: {
        required: true,
        number: true
      }
    },
    messages: {
        product_name: {
        required: "The Product Name Field ISS Required",
        minlength: "Your Product name must be at least 10 characters long"
      },
      product_desc: {
        required: "Product Desciption field Required",
      }
    },
    submitHandler: function (form) {
      form.submit();
    }
  });
});

    </script>
</body>
</html>
