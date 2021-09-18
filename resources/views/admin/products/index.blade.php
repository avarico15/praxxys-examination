@extends('admin.main')
@section('title', 'Products')
@section('content')

<div class="content-wrapper">
    <section class="content">
    @include('admin.partials.validate')
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Products</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
            <div class="box-body">
            @if($products)
            <div class="row">
              <div class="col-12 col-md-3">
                <div class="form-group">
                  <a href="{{route('admin.products.create')}}" class="btn btn-success">+ Add Product</a><br>
              </div>
              </div>
            </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Expiration Date</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$product->name}}</td>
                      <td>{{$product->category->category_name ?? '' }}</td>
                      <td>{{$product->description}}</td>
                      <td>{{$product->expiration_date}}</td>
                      <td>{{$product->created_at}}</td>
                      <td>{{$product->updated_at}}</td>
                      <td>
                        <a href="{{route('admin.products.edit', $product->id)}}" class="btn btn-success">Edit</a>
                      </td>
                      <td>
                          <form action="{{route('admin.products.delete', $product->id)}}" method="post">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">Delete</a>
                          </form>
                      </td>
                    </tr>
                @endforeach
                </tfoot>
              </table>
              @endif
            </div>
        </div>
      </div>
    </section>
  </div>
@endsection
@push('style')
<!-- DataTables -->    
  <link rel="stylesheet" href="{{asset('assets/admin')}}/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
@endpush
@push('scripts')
<!-- DataTables -->
<script src="{{asset('assets/admin')}}/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets/admin')}}/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
@endpush