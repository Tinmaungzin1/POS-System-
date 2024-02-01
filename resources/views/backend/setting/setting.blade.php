@extends("layouts.backend.master")
@section('title', 'Admin Shift')
@section('content')


<div class="right_col" role="main">
    <div class="">
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2>Setting</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form action="url('/setting/create')" method="POST" enctype="multipart/form-data"
                            novalidate>
                            <span class="section">Setting Create</span>

                            <div class="field item form-group">
                                <label for="name" class="col-form-label col-md-3 col-sm-3  label-align">Company
                                    Name<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input id="name" type="text" class="form-control" name="name"
                                        value="" />
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label for="phone" class="col-form-label col-md-3 col-sm-3  label-align">Company
                                    Phone<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input type="text" id="phone" class="form-control" name="phone"
                                        value="" />
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label for="email" class="col-form-label col-md-3 col-sm-3  label-align">Company
                                    Email<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <input class="form-control" id="email" name="email" class='email'
                                        required="required" type="email" value="" />
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label for="address" class="col-form-label col-md-3 col-sm-3  label-align">
                                    Company Address<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <textarea id="address" class="form-control"
                                        name="address"></textarea>
                                </div>
                            </div>

                            <div class="field item form-group">
                                <label for="image" class="col-form-label col-md-3 col-sm-3  label-align">
                                    Item Image<span class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                    <div id="preview-wrapper" style="display:none;">
                                        <div class="vertical-center">
                                            <label class="choose-file" onclick="fileBrowse()" for="upload">Choose
                                                File</label>
                                        </div>
                                    </div>
                                    <div id="preview-wrapper-img">
                                        <div class="vertical-center">
                                            <img src="" id="image-preview" style="width:100%">
                                            <label class="choose-file" onclick="fileBrowse()" for="upload">Choose
                                                File</label>
                                        </div>
                                    </div>
                                </div>
                                <input class="hide img-upload" type="file" name="file" onchange='SelectFile(this)' />

                            </div>

                            <div class="ln_solid">
                                <div class="form-group">
                                    <div class="col-md-6 offset-md-3">
                                        <button type='submit' class="btn btn-primary">Submit</button>
                                        <button type='reset' class="btn btn-success">Reset</button>
                                        <input type="hidden" name="form-sub" value="1">
                                    </div>
                                </div>
                            </div>
                        </form>
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
@if($errors->has('shift-start-error'))
<script>
new PNotify({
    title: 'Fail!',
    text: "{{$errors->first('shift-start-error')}}",
    type: 'error',
    styling: 'bootstrap3'
});
</script>
 @endif
@if(session('shift-start-success'))
    <script>
    new PNotify({
        title: ' Success',
        text: "{{sesseion('shift-start-success')}}",
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
