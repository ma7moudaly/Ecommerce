@extends('layout.layout')

@section('title')
Update Product Page
@endsection

@section('content')

<div class="row"> 
        <div class="col-lg-12 col-md-offset-4">
<div class="panel panel-default">
        
    <div class="panel-heading">
    <h3 class="text-center">Update : {{ $product->name}}</h3>
    </div>
    <div class="panel-body">
            <form action="{{ route('products.update',['id'=>$product->id]) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('put') }}
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ $product->name }}">
                </div> 
                
                <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" name="price" class="form-control" value="{{ $product->price }}">
                </div>
                
                <div class="form-group">
                        <label for="image">Image</label>
                <input type="file" name="image" class="form-control">
                </div>
                
                <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" class="form-control" cols="30" rows="10">
                            {{ $product->description }}
                        </textarea>
                </div>

                <div class="form-group">
                        <button class="form-control btn btn-success">Update Product</button>
                </div>
 
            </form>
    </div>
</div>
</div></div>


@endsection