<!-- resources/views/barang/tambah.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang Baru</title>
    <link rel="stylesheet" href="{{ asset('css/tambah.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="#" class="navbar-logo">E-Shop Hafiz</a>
        <div class="navbar-nav">
            <a href="{{ route('daftarbarang', ['id' => $akun->id]) }}">Home</a>
            <a href="{{ route('profile', ['id' => $akun->id]) }}" class="profile-link">
                @if(isset($akun->foto))
                    <img class="profile" src="{{ asset('img/' . $akun->foto) }}" alt="Profile">
                @else
                    <img class="profile" src="{{ asset('img/default.png') }}" alt="Profile">
                @endif
            </a>
        </div>
    </nav>

    <div class="card-container">
        <div class="card">
            <div class="card-header">
                <h2>Tambah Barang Baru</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{ $akun->id }}">
                    
                    <label for="namaBarang">Nama Barang:</label>
                    <input type="text" id="namaBarang" name="namaBarang" required>

                    <label for="hargaBarang">Harga Barang:</label>
                    <input type="number" id="hargaBarang" name="hargaBarang" required>

                    <label for="stokBarang">Stok Barang:</label>
                    <input type="number" id="stokBarang" name="stokBarang" required>

                    <label for="fotoBarang">Foto Barang:</label>
                    <input type="file" id="fotoBarang" name="fotoBarang" accept="image/*">

                    <button type="submit">Tambah Barang</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
