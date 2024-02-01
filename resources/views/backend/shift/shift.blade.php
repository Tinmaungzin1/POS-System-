@extends("layouts.backend.master")
@section('title', 'Admin Shift')
@section('content')


<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Control Shift</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12  mb-2">
                <a href="{{url('/sg-backend/shift/start')}}" class="btn btn-success btn-lg" id="shiftOpenBtn"
                    style="display:{{ $shift_open ? 'none' : 'inline'}}">
                    <span class="glyphicon glyphicon-open"></span> Shift Start
                </a>
                <a href="{{url('/sg-backend/shift/end')}}" class="btn btn-danger btn-lg" id="shiftEndBtn"
                    style="display:{{ $shift_open ? 'inline' : 'none'}}">
                    <span class="glyphicon glyphicon-download-alt"></span> Shift Close
                </a>

            </div>
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Shift Table</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th class="column-title">shift Start time </th>
                                        <th class="column-title">Shift End Time </th>
                                        <th class="column-title">Action </th>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($shift_list as $shift)
                                    <tr class="even pointer">
                                        <td class=" ">{{$shift->start_date_time}}</td>
                                        <td class=" ">{{$shift->end_date_time}}</td>
                                        <td>
                                            <a href="{{url('/sg-backend/shift/'. $shift->id .'/order')}}" class="btn btn-info btn-xs"><i
                                                    class="fa fa-eye"></i> View Order
                                            </a>
                                        </td>
                                    </tr>

                                    @endforeach

                                </tbody>
                            </table>
                            {!! $shift_list->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.backend.partial.footer_start')
@include('layouts.backend.partial.footer_end')

@if($errors->has('shift-error'))
<script>
new PNotify({
    title: 'Fail!',
    text: "{{$errors->first('shift-error')}}",
    type: 'error',
    styling: 'bootstrap3'
});
</script>
 @endif
@if(session('shift-success'))
    <script>
    new PNotify({
        title: ' Success',
        text: "{{session('shift-success')}}",
        type: 'success',
        styling: 'bootstrap3'
    });
    </script>
@endif

<script>
    // Add a click event listener to the Shift Start button
    document.getElementById('shiftOpenBtn').addEventListener('click', function (event) {
        // Prevent the default link behavior
        event.preventDefault();

        // Display a SweetAlert2 confirmation dialog
        Swal.fire({
            title: 'Are you sure you want to start the shift?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, start the shift',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            // If the user clicks "Yes", redirect to the shift start URL
            if (result.isConfirmed) {
                window.location.href = "{{ url('/sg-backend/shift/start') }}";
            }
        });
    });
</script>

<script>
    // Add a click event listener to the Shift Close button
    document.getElementById('shiftEndBtn').addEventListener('click', function (event) {
        // Prevent the default link behavior
        event.preventDefault();

        // Display a SweetAlert2 confirmation dialog
        Swal.fire({
            title: 'Are you sure you want to close the shift?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, close the shift',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            // If the user clicks "Yes", redirect to the shift end URL
            if (result.isConfirmed) {
                window.location.href = "{{ url('/sg-backend/shift/end') }}";
            }
        });
    });
</script>
@include('layouts.backend.partial.html_end')
@endsection
