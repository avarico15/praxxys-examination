@extends('admin.main')
@section('title', 'Video Link')
@section('content')

<div class="content-wrapper">
    <section class="content">
    @include('admin.partials.validate')
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Video Link</h3>
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
                <video id="vid1" class="video-js" lang="en" controls poster="//d2zihajmogu5jn.cloudfront.net/elephantsdream/poster.png">
                    <source src="//d2zihajmogu5jn.cloudfront.net/elephantsdream/ed_hd.mp4" type="video/mp4">
                    <source src="//d2zihajmogu5jn.cloudfront.net/elephantsdream/ed_hd.ogg" type="video/ogg">
                </video>
                <input id="stateToggle" type="checkbox" class="terminate-btn">
                    Terminate the play/pause middleware
                </input>
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
<script src="https://vjs.zencdn.net/7.15.4/video.min.js"></script>
<link href="https://vjs.zencdn.net/7.15.4/video-js.css" rel="stylesheet" />
<link href="https://unpkg.com/video.js@7/dist/video-js.min.css" rel="stylesheet"/>
<script>
    var stateToggle = document.getElementById('stateToggle');

    // Middleware 1
    var m1 = function(player) {
      return {
        // Mediating play to the tech
        callPlay: function() {
          if (stateToggle.checked) {
            console.log('Middleware 1: Play is set to terminate');

            player.addClass('terminated');
            return videojs.middleware.TERMINATOR;

          } else {
            console.log('Middleware 1: Play has been called');
            player.removeClass('terminated');
          }
        },
        // Mediating the results back to the player
        play: function(cancelled, value) {
          console.log('Middleware 1: play got from tech. What is the value passed?', value);

          // Handle the promise if it is returned
          if(value && value.then) {
            value.then(() => {
              console.log('Middleware 1: Promise resolved.')
            })
            .catch((err) => {
              console.log('Middleware 1: Promise rejected.');
            });
          }

          if (cancelled) {
            console.log('Middleware 1: play has been cancelled prior to this middleware');
          }
        },
        // Mediating to tech
        callPause: function() {
          if (stateToggle.checked) {
            console.log('Middleware 1: Pause is set to terminate');

            player.addClass('terminated');
            return videojs.middleware.TERMINATOR;

          } else {
            console.log('Middleware 1: Pause has been called');
            player.removeClass('terminated');
          }
        },
        // Mediating the results back to the player
        pause: function(cancelled, value) {
          console.log('Middleware 1: pause got back from tech. What is the value passed?', value);

          if (cancelled) {
            console.log('Middleware 1: pause has been cancelled prior to this middleware');
          }

          return value;
        },
        // Required for middleware. Simply passes along the source
        setSource: function(srcObj, next) {
          next(null, srcObj);
        }
      };
    };

    // Middleware 2
    var m2 = function(player) {
      return {
        callPlay: function() {
          console.log('Middleware 2: play has been called');
        },
        play: function(cancelled, value) {
          console.log('Middleware 2: got play from tech. What is the value passed?', value);

          if (cancelled) {
            console.log('Middleware 2: play has been cancelled prior to this middleware');
          }

          return value;
        },
        callPause: function() {
          console.log('Middleware 2: pause has been called');
        },
        pause: function(cancelled, value) {
          console.log('Middleware 2: got pause from tech. What is the value passed?', value);

          if (cancelled) {
            console.log('Middleware 2: pause has been cancelled prior to this middleware');
          }

          return value;
        },
        setSource: function(srcObj, next) {
          next(null, srcObj);
        }
      };
    }

    videojs.use('*', m1);
    videojs.use('*', m2);

    // Initial set-up
    var vid = document.getElementById("vid1");
    var player = videojs(vid);

    console.log('Calling play...');
    player.setTimeout(() => {
      player.play()
        .then(() => {
          console.log('The promise resolved, we are playing.');
        },
        (err) => {
          console.log('The promise was rejected, we failed to play.');
        });
    }, 500);
  </script>

<!-- City -->
<link
  href="https://unpkg.com/@videojs/themes@1/dist/city/index.css"
  rel="stylesheet"
/>

<!-- Then, in the player -->
<video class="video-js vjs-theme-city" ...></video>
@endpush