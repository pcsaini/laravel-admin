@if (session('success'))
    <script>
        $.notify({
            title: 'Success',
            icon: 'fas fa-grin',
            message: '{{ session('success') }}',
        },{
            type: "success",
        });
    </script>
@endif

@if (session('error'))
    <script>
        $.notify({
            title: 'Oops',
            icon: 'fas fa-grin-tears',
            message: '{{ session('error') }}',
        },{
            type: "danger",
        });
    </script>
@endif
