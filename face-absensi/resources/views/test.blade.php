<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    @include('user.partials.main')
    <h1>Dashboard</h1>
    <p>Status: {{ $status }}</p>
    <p>Nama Lengkap: {{ $nama_lengkap }}</p>
    {{-- <p>Divisi: {{ $name }}</p> --}}
</body>
</html>
