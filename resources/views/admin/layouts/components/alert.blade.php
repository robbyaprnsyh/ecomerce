@if ($message = Session::get('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-right',
            icon: 'success',
            title: '{{ $message }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        })
    </script>
@endif

@if ($message = Session::get('error'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-right',
            icon: 'error',
            title: '{{ $message }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        })
    </script>
@endif

@if ($message = Session::get('berhasil'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-right',
            background: 'black',
            color: 'white',
            icon: 'success',
            title: '{{ $message }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });
    </script>
@endif

@if ($message = Session::get('warning'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-right',
            icon: 'warning',
            title: '{{ $message }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        })
    </script>
@endif

@if ($message = Session::get('info'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-right',
            icon: 'info',
            title: '{{ $message }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        })
    </script>
@endif

@if ($message = Session::get('gagal'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-right',
            background: 'black',
            color: 'white',
            icon: 'error',
            title: '{{ $message }}',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });
    </script>
@endif

<script>
    $('body').on('click', '#auth', function() {
        Swal.fire({
            toast: true,
            position: 'bottom-right',
            background: 'black',
            color: 'white',
            icon: 'error',
            title: 'Anda Belum Login <br> Silahkan Login terlebih dulu',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });
    });
</script>

<script>
    $('body').on('click', '#wishlist', function() {
        Swal.fire({
            toast: true,
            position: 'bottom-right',
            background: 'black',
            color: 'white',
            icon: 'error',
            title: 'Wishlist anda kosong',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });
    });
</script>

<script>
    $('body').on('click', '#keranjang', function() {
        Swal.fire({
            toast: true,
            position: 'bottom-right',
            background: 'black',
            color: 'white',
            icon: 'error',
            title: 'Keranjang anda kosong',
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true
        });
    });
</script>

<script>
    $('body').on('click', '#btnDeleteAll', function() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "ingin menghapus semua data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'TIDAK',
            confirmButtonText: 'YA, HAPUS!'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#deleteAll").submit()
            }
        })
    });
</script>

<script>
    $('body').on('click', '#btnDeleteAllKeranjang', function() {
        Swal.fire({
            title: 'Apakah Kamu Yakin?',
            text: "ingin menghapus semua data!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'TIDAK',
            confirmButtonText: 'YA, HAPUS!'
        }).then((result) => {
            if (result.isConfirmed) {
                $("#deleteAllKeranjang").submit()
            }
        })
    });
</script>

<script>
    $('body').on('click', '#btnDeleteAlamat', function() {
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
                alamat = $(this).data('id')
                $("#deleteAlamat" + alamat).submit()
            }
        })
    });
</script>
