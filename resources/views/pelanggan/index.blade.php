<!DOCTYPE html>
<html>
<head>
    <title>Daftar Pelanggan</title>
    <style>
        body { font-family: sans-serif; }
        ul { padding-left: 20px; }
        li { margin-bottom: 5px; }
    </style>
</head>
<body>
    <h1>📋 Daftar Pelanggan</h1>
    <ul>
        @foreach ($pelanggan as $pelanggan)
            <li>
                <a href="/pelanggan/{{ $pelanggan['id'] }}">{{ $pelanggan['nama'] }}</a>
            </li>
        @endforeach
    </ul>
</body>
</html>