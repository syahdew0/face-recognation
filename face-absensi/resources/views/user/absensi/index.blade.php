@extends('user.partials.main')

<style>
    .webcam-capture,
    .webcam-capture video {
        display: inline-block;
        width: 100% !important;
        margin: auto;
        height: auto !important;
        border-radius: 15px;
    }
</style>

@section('container')
    <h3 class="h3 mb-5">Halaman Absensi</h3>
    <div class="row mb-3">
        <div class="col">
            <div class="webcam-capture"></div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form class="text-center" method="POST">     
                @csrf           
                <input type="hidden" name="idKaryawan" id="idKaryawan" value="{{ auth()->user()->id }}">
                @if ($cek > 0)
                    <button id="absen" type="submit" class="btn btn-danger btn-block"><i
                            class="bi bi-camera-fill"></i>
                        Absen Pulang</button>
                @else
                    <button id="absen" type="submit" class="btn btn-success btn-block"><i
                            class="bi bi-camera-fill"></i>
                        Absen Masuk</button>
                @endif
            </form>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        Webcam.set({
            height: 480,
            width: 640,
            image_format: 'jpeg',
            jpeg_quality: 90
        });

        Webcam.attach('.webcam-capture');

        $('#absen').click(function(e) {
            event.preventDefault();
            var idKaryawan = $('#idKaryawan').val();
            var image = '';

            Webcam.snap(function(data_uri) {
                image = data_uri;
            });

            $.ajax({
                type: 'post',
                url: '/absensi/lakukan',
                data: {
                    _token: "{{ csrf_token() }}",
                    idKaryawan: idKaryawan,
                    image: image
                },
                cache: false,
                success: function(respond) {
                    var status = respond.split("|");
                    if (status[0] == "success") {
                        Swal.fire({
                            title: 'Berhasil',
                            text: status[1],
                            icon: 'success',
                        })
                        setTimeout("location.href='/home'", 3000);
                    } else {
                        Swal.fire({
                            title: 'Error',
                            text: status[1],
                            icon: 'error',
                        })
                    }
                }
            });
        });
    </script>
@endpush
