<script>
    //button create post event
    $('body').on('click', '#btn-delete', function() {

        let user_id = $(this).data('id');

        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "ingin menghapus data ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'TIDAK',
            confirmButtonText: 'YA, HAPUS!'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#deleted" + user_id).submit()
            }
        })

    });
</script>