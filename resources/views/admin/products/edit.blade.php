@extends('admin.main')
@section('title', 'Product Editing')
@section('content')

<div class="content-wrapper">
    <section class="content">
      @include('admin.partials.validate')
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">{{$products->name}} Editing</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form action="{{route('admin.products.update', $products->id)}}" method="post">
          {{csrf_field()}}
          {{method_field('PUT')}}
            <div class="box-body">
              <div class="row">  
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="name">Name</label>
                    <input type="name" name="name" value="{{$products->name}}" class="form-control" id="name" placeholder="Enter Product Name">
                  </div>
                </div>
              </div>
              <div class="row">  
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="category">Product Category</label>
                    <input type="category" name="category" value="{{$products->category->category_name}}"  class="form-control" id="category" placeholder="Enter Product Category">
                  </div>
                </div>
              </div>
              <div class="row">  
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="description">Product Description</label>
                    <input type="text" name="description" value="{{$products->description}}" class="form-control" id="description" placeholder="Enter Product Description">
                  </div>
                </div>
              </div>
              <div class="row">  
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="expiration_date">Expiration Date</label>
                      <input id="expiration_date" name="expiration_date" type="date" class="form-control">
                  </div>
                </div>
              </div>
            </div>
            <div class="box-footer">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </section>
  </div>
@endsection