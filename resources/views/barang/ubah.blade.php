<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Barang</title>
    <link rel="stylesheet" href="{{ asset('css/ubah.css') }}">
    <script>
        function konfirmasiPerubahan() {
            return confirm("Apakah Anda yakin ingin menyimpan perubahan?");
        }
    </script>
</head>
<body>
    <nav class="navbar">
        <a href="#" class="navbar-logo">E-Shop Hafiz</a>
        <div class="navbar-nav">
            <a href="{{ route('daftarbarang', ['id' => $akun->id]) }}">Home</a>
            <img class="profile" src="{{ asset('img/' . ($akun->foto ?? 'default.png')) }}" alt="Profile">
        </div>
    </nav>

    <div class="card-container">
        <div class="card">
            <div class="card-header">
                <h2>Ubah Barang</h2>
            </div>
            <div class="card-body">
                <div class="product-image-container">
                    <img src="{{ asset('imgBarang/' . $barang->fotoBarang) }}" alt="{{ $barang->namaBarang }}" class="product-image">
                </div>
                <form action="{{ route('barang.update', ['idBarang' => $barang->idBarang, 'id' => $akun->id]) }}" method="post" onsubmit="return konfirmasiPerubahan()">
                    @csrf <!-- Tambahkan ini untuk CSRF protection -->
                    <label for="namaBarang">Nama Barang:</label>
                    <input type="text" id="namaBarang" name="namaBarang" value="{{ old('namaBarang', $barang->namaBarang) }}">

                    <label for="hargaBarang">Harga Barang:</label>
                    <input type="number" id="hargaBarang" name="hargaBarang" value="{{ old('hargaBarang', $barang->hargaBarang) }}" step="0.01">

                    <label for="stokBarang">Stok Barang:</label>
                    <input type="number" id="stokBarang" name="stokBarang" value="{{ old('stokBarang', $barang->stokBarang) }}">

                    <button type="submit">Simpan Perubahan</button>
                </form>

                @if($errors->any())
                <div class="error-messages">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
