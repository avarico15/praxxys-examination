@extends('admin.main')
@section('title', 'User Editing')
@section('content')

<div class="content-wrapper">
    <section class="content">
      @include('admin.partials.validate')
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">{{$user->name}} Editing</h3>
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          
        <form action="{{route('admin.users.update', $user->id)}}" method="post">
        {{csrf_field()}}
        {{method_field('PUT')}}
              <div class="box-body">
                <div class="row">
                  <div class="col-12 col-md-3">
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="name" name="name" value="{{$user->name}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Name">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-3">
                    <div class="form-group">
                      <label for="username">UserName</label>
                      <input type="name" name="username" value="{{$user->username}}" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-3">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Email address</label>
                      <input type="email" name="email" value="{{$user->email}}"  class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-3">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-12 col-md-3">
                    <div class="form-group">
                      <label for="exampleInputPassword1">RePassword</label>
                      <input type="password" name="password_confirmation" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                  </div>
                </div> 
                <div class="row">
                  <div class="col-12 col-md-3">
                    <div class="box-footer">
                      <button type="submit" class="btn btn-primary">Update</button>
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