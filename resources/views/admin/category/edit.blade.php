@extends('admin.main')
@section('title', 'Category Editing')
@section('content')

<div class="content-wrapper">
    <section class="content">
      @include('admin.partials.validate')
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">{{$category->category_name}} Editing</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          <form action="{{route('admin.category.update', $category->id)}}" method="post">
          {{csrf_field()}}
          {{method_field('PUT')}}
            <div class="box-body">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="name" name="name" value="{{$category->category_name}}" class="form-control" placeholder="Enter Product Category Name">
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