@extends('admin.main')
@section('title', 'Category')
@section('content')

<div class="content-wrapper">
    <section class="content">
    @include('admin.partials.validate')
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Category</h3>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Category Name</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
                </thead>
                <tbody>
                @foreach($category as $categories)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td>{{$categories->category_name}}</td>
                      <td>{{$categories->created_at}}</td>
                      <td>{{$categories->updated_at}}</td>
                      <td>
                        <a href="{{route('admin.category.edit', $categories->id)}}" class="btn btn-success">Edit</a>
                      </td>
                      <td>
                          <form action="{{route('admin.category.delete', $categories->id)}}" method="post">
                          {{csrf_field()}}
                          {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-danger">Delete</a>
                          </form>
                      </td>
                    </tr>
                @endforeach
                </tfoot>
              </table>
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