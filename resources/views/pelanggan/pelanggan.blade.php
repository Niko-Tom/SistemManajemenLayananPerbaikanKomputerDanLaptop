<!DOCTYPE html>
<html>
<head>
    <title>Detail Pengguna</title>
</head>
<body>
    <h1>{{ $pelanggan['nama'] }}</h1>
    <p><strong>Email:</strong> {{ $pelanggan['email'] }}</p>
    <p><strong>No Telepon:</strong> {{ $pelanggan['telepon'] }}</p>

    <p>
        <a href="/pelanggan/{{ $pelanggan['id'] }}/edit">✏️ Edit</a> |
        <a href="/pelanggan/{{ $pelanggan['id'] }}/delete">🗑️ Hapus</a>
    </p>

    <a href="/pelanggan">← Kembali ke daftar</a>
</body>
</html>