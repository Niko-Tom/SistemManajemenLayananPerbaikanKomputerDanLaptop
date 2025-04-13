<!DOCTYPE html>
<html>
<head>
    <title>Edit Pelanggan</title>
</head>
<body>
    <h1>Edit Data Pelanggan</h1>
    <form method="post" action="/pelanggan/{{ $pelanggan['id'] }}/update">
        @csrf
        <p>
            <label>Nama:</label><br>
            <input type="text" name="nama" value="{{ $pelanggan['nama'] }}" required>
        </p>
        <p>
            <label>Email:</label><br>
            <input type="email" name="email" value="{{ $pelanggan['email'] }}" required>
        </p>
        <p>
            <label>Telepon:</label><br>
            <input type="text" name="telepon" value="{{ $pelanggan['telepon'] }}" required>
        </p>
        <button type="submit">💾 Simpan (simulasi)</button>
    </form>
    <br>
    <a href="/pelanggan/{{ $pelanggan['id'] }}">← Kembali ke detail</a>
</body>
</html>