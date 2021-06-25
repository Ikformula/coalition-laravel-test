@extends('layouts.app')

@section('title', 'Products Stocking')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center font-weight-bold">
                    <strong>Add a Product</strong>
                </div>
                <div class="card-body">



                    <form name="addProductForm" id="addProductForm" method="post" action="javascript:void(0)">
                        @csrf
                        <div class="form-group">
                            <label for="name">Product name</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="quantity_in_stock">Quantity in Stock</label>
                            <input type="number" name="quantity_in_stock" id="quantity_in_stock" class="form-control"
                                   min="0" step="1" required>
                        </div>

                        <div class="form-group">
                            <label for="price_per_item">Price per Item</label>
                            <input type="number" name="price_per_item" id="price_per_item" class="form-control" min="0"
                                   required>
                        </div>
                        <button type="button" onclick="addProduct()" class="btn btn-primary" id="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center my-4">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header text-center font-weight-bold">
                    <strong>Products in Stock</strong>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Quantity in Stock</th>
                            <th>Price Per Item</th>
                            <th>Datetime Submitted</th>
                            <th>Total value number</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->quantity_in_stock }}</td>
                                <td>{{ $product->price_per_item }}</td>
                                <td>{{ $product->created_at }}</td>
                                <td>{{ number_format($product->quantity_in_stock * $product->price_per_item) }}</td>
                                <td><a href="{{ route('edit', $product->id) }}" class="btn btn-info">Edit</a> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('after-scripts')
<script>
    function addProduct() {
        disableSubmit();
        var name = $('#name').val();
        var quantity_in_stock = $('#quantity_in_stock').val();
        var price_per_item = $('#price_per_item').val();

        let _token = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: '{{ route('store') }}',
            type: "POST",
            data: {
                name: name,
                quantity_in_stock: quantity_in_stock,
                price_per_item: price_per_item,
                _token: _token
            },
            success: function (response) {
                console.log(response.data);
                if (response.code == 200) {
                    $('#alert-div').html('<div class="alert alert-dismissible alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><p class="mb-0"> '+ response.message + ' </p></div>');

                        $('tbody').append('<tr> <td>' + response.data.id + '</td> <td> ' + response.data.name + '</td> <td>' + response.data.quantity_in_stock + '</td> <td>' + response.data.price_per_item + '</td> <td>' + response.data.created_at + '</td> <td>' + response.data.price_per_item * response.data.price_per_item + '</td> <td> <a href="' + response.data.id + '" class="btn btn-info">Edit</a></td> </tr>');

                }
            },
            error: function (response) {
                $('#alert-div').html('<div class="alert alert-dismissible alert-danger"><button type="button" class="close" data-dismiss="alert">&times;</button><p class="mb-0">' + response.message + '</p></div>');
            }
        });

        enableSubmit();
		document.getElementById('addProductForm').reset();
    }


</script>

@endpush
