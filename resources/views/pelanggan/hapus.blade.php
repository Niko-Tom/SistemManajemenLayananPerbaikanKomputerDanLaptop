<!DOCTYPE html>
<html>
<head>
    <title>Hapus Pelanggan</title>
</head>
<body>
    <h1>Yakin ingin menghapus pelanggan ini?</h1>

    <p><strong>Nama:</strong> {{ $pelanggan['nama'] }}</p>
    <p><strong>Email:</strong> {{ $pelanggan['email'] }}</p>

    <form method="post" action="/pelanggan/{{ $pelanggan['id'] }}/destroy">
        @csrf
        <button type="submit">🗑️ Ya, hapus (simulasi)</button>
    </form>
    <br>
    <a href="/pelanggan/{{ $pelanggan['id'] }}">← Batal</a>
</body>
</html>