<script>
    @if(session('success'))
        Swal.fire({
            title: "Success!",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonText: "OK"
        });
    @endif

    @if(session('danger'))
        Swal.fire({
            title: "Failed!",
            text: "{{ session('danger') }}",
            icon: "error",
            confirmButtonText: "OK"
        });
    @endif
</script>