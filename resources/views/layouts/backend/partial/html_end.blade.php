
@if($errors->has('error-msg'))
<script>
new PNotify({
    title: 'Fail!',
    text: "{{$errors->first('error-msg')}}",
    type: 'error',
    styling: 'bootstrap3'
});
</script>
 @endif
@if(session('success-msg'))
    <script>
    new PNotify({
        title: ' Success',
        text: "{{session('success-msg')}}",
        type: 'success',
        styling: 'bootstrap3'
    });
    </script>
@endif

<script>
    function confirmDelete() {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You want to delete!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // If the user clicks "Yes," submit the form
                document.getElementById('deleteForm').submit();
            }
        });
    }
</script>
</html>
