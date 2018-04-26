@extends('layout.layout')

@section('title')
Products Page
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">             
@if($products->count() > 0 )
<table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Image</th>
        <th scope="col">Name</th>
        <th scope="col">Price</th>
        <th scope="col">Description</th>
      </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
            <tr>
            <th scope="row">{{ $product->id }}</th>
                <td><img src="{{ $product->image }}" alt="{{ $product->image }}" width="90px" height="50px"></td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }}</td>
                <td>{{ $product->description }}</td>
                <td>
                <a href="{{ route('products.edit',['id' =>$product->id]) }}" class="btn btn-sm btn-primary">Edit</a>
                </td>
                <td>
                <form action="{{ route('products.destroy',['id'=>$product->id])}}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('delete') }}

                    <button class="btn btn-sm btn-danger">Delete</button>
                   </form>
                </td>
           </tr>
        @endforeach   
    </tbody>
  </table>
@else
     
   <div class="text-center">
       <h1>There are no data to show.</h1> 
   </div>
@endif
</div></div></div> 
@endsection