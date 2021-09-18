@extends('admin.main')
@section('title', 'Product Create')
@section('content')

<div class="content-wrapper">
    <section class="content">
      @include('admin.partials.validate')
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Product Create</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
        <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        {{method_field('POST')}}
            <div class="box-body">
              <div class="row">
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter Product Name">
                  </div>
                </div>
              </div>  
              <div class="row">      
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="name">Product Category</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="">- Select -</option>
                        @foreach ($category as $categories)
                            <option value="{{ $categories->id }}">{{ $categories->category_name }}</option>
                        @endforeach
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">      
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="description">Product Desription</label>
                    <input type="text" name="description" class="form-control" id="description" placeholder="Description">
                  </div>
                </div>
              </div>
              <div class="row">      
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="upload">Product Image</label>
                    <input id="files" type="file" name="files[]" multiple class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">  
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <label for="expiration_date">Date Created</label>
                      <input id="expiration_date" name="expiration_date" type="date" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">  
                <div class="col-12 col-md-3">
                  <div class="form-group">
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                  </div>
                </div>
              </div>
            </form>
        </div>
      </div>
    </section>
  </div>
@endsection