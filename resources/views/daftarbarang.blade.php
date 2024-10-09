
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce ID Card</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <link rel="stylesheet" href="{{ asset('css/daftarbarang.css') }}">
</head>
<body>
    <!-- Navbar Start -->
    <nav class="navbar">
    <a href="#" class="navbar-logo">E-Shop Hafiz</a>
    <div class="navbar-nav">
        @if($akun) <!-- Pastikan $akun ada -->
            <a href="{{ url('daftarbarang?id=' . $akun->id) }}">Home</a>
            <a href="{{ url('profile?id=' . $akun->id) }}" class="profile-link">
                @if(isset($akun->foto))
                    <img class="profile" src="{{ asset('img/' . $akun->foto) }}" alt="Profile">
                @else
                    <img class="profile" src="{{ asset('img/default.png') }}" alt="Profile">
                @endif
            </a>
        @else
            <p>User not found.</p>
        @endif
    </div>
</nav>

    
<form action="{{ route('daftarbarang') }}" method="GET">
    @csrf
    <input type="hidden" name="id" value="{{ $akun->id }}">
    <br>
    <div class="pencarian">
        <input type="text" name="keyword" placeholder="Masukan data yang ingin anda cari" autocomplete="off">
        <button type="submit" name="cari">Cari</button>
    </div>
</form>


    <div class="tambah">
        <a href="{{ url('/barang/tambah?id=' . $akun->id) }}">Tambah Barang</a>
    </div>
    
    <div class="container">
        @foreach ($dataBrg as $row)
            <div class="card">
                @if(isset($row->fotoBarang))
                    <img src="{{ asset('imgBarang/' . $row->fotoBarang) }}" alt="{{ $row->namaBarang }}" class="product-image">
                @else
                    <img src="{{ asset('img/default_product.png') }}" alt="Default Image" class="product-image">
                @endif
                <h3>{{ $row->namaBarang }}</h3>
                <p hidden>ID Barang: {{ $row->idBarang }}</p>
                <p>Harga: Rp {{ number_format($row->hargaBarang, 0, ',', '.') }}</p>
                <p>Stok: {{ $row->stokBarang }}</p>
                <div class="card-actions">
                <a href="{{ route('barang.ubah', ['idBarang' => $row->idBarang, 'id' => $akun->id]) }}">Ubah</a>
                <a href="{{ route('barang.hapus', ['idBarang' => $row->idBarang, 'id' => $akun->id]) }}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                </div>
            </div>
        @endforeach
    </div>
    <script>
        feather.replace();
    </script>
</body>
</html>
