@extends("layouts.backend.master")
@section('title', 'Admin Shift')
@section('content')


<div class="right_col" role="main">
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Category Table</h3>
            </div>
        </div>

        <div class="clearfix"></div>

        <div class="row" style="display: block;">
            <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Category List</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <div class="table-responsive">
                            <table class="table table-striped jambo_table bulk_action">
                                <thead>
                                    <tr class="headings">
                                        <th>
                                            <input type="checkbox" id="check-all" class="flat">
                                        </th>
                                        <th class="column-title">Name </th>
                                        <th class="column-title">Category id </th>
                                        <th class="column-title">Price</th>
                                        <th class="column-title">Quantity</th>
                                        <th class="column-title">Code Number</th>
                                        <th class="column-title">Status </th>
                                        <th class="column-title">Image </th>
                                        <th class="column-title no-link last"><span class="nobr">Action</span>
                                        </th>
                                        <th class="bulk-actions" colspan="7">
                                            <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span
                                                    class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>



                                    <tr class="even pointer">
                                        <td class="a-center ">
                                            <input type="checkbox" class="flat" name="table_records">
                                        </td>
                                        <td class="">fkfjka</td>
                                        <td class=" ">fjkajfa</td>
                                        <td class=" ">fnkdf</td>
                                        <td class=" ">fajkf</td>
                                        <td class=" ">fkdlfjk</td>
                                        <td class=" ">
                                            0
                                        </td>
                                        <td class=" ">
                                            <div>
                                                <img src=""
                                                    style="width: 100px; height: auto; object-fit: cover;">

                                            </div>
                                        </td>
                                        <td class=" last">
                                            <a href="" class="btn btn-info btn-xs"><i
                                                    class="fa fa-pencil"></i> Edit
                                            </a>
                                            <a href="" class="btn btn-danger btn-xs"
                                                onclick="confirmDelete(event)">
                                                <i class="fa fa-trash-o"></i>
                                                Delete
                                            </a>

                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.backend.partial.footer_start')
@include('layouts.backend.partial.footer_end')
{{-- javascript code --}}
{{-- @if($errors->has('shift-start-error'))
<script>
Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "{{$errors->first('shift-start-error')}}",
});
</script>
@endif
@if($errors->has('shift-start-success'))
<script>
Swal.fire({
  icon: "error",
  title: "Oops...",
  text: "{{$errors->first('shift-start-success')}}",
});
</script>
@endif --}}
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
