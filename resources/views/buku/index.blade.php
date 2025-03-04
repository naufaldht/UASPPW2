<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>PPW2-UAS-522485</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+4telH+8AMfyDm0ynQ6K8K7AjGpG0" crossorigin="anonymous">
</head>
<body>
    @extends('layout') <!-- Menggunakan layout utama -->

    @section('title', 'Daftar Buku') <!-- Menambahkan judul halaman -->

    @section('content')

        <!-- Flash message -->
        @if(Session::has('pesanstore'))
            <div class="alert alert-success">{{ Session::get('pesanstore') }}</div>
        @endif

        @if(Session::has('pesanupdate'))
            <div class="alert alert-primary">{{ Session::get('pesanupdate') }}</div>
        @endif

        @if(Session::has('pesandelete'))
            <div class="alert alert-warning">{{ Session::get('pesandelete') }}</div>
        @endif

        @if(Auth::check() && Auth::user()->level == 'admin')
            <h1>Daftar Buku</h1>
            <a href="{{ route('buku.create') }}" class="btn btn-primary float-end">Tambah Buku</a>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID</th>
                    <th>Poster</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    @if(Auth::check() && Auth::user()->level == 'admin')
                        <th>Aksi</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach ($data_buku as $index => $buku)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td>{{ $buku->id }}</td>
                        <td>
                            @if ($buku->filepath)
                                <div class="relative h-10 w-10">
                                    <img class="h-full w-full rounded-full object-center" src="{{ asset($buku->filepath) }}" alt="Thumbnail" />
                                </div>
                            @endif
                        </td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ "Rp. ".number_format($buku->harga, 0, ',','.') }}</td>
                        <td>{{ (new DateTime($buku->tgl_terbit))->format('d/m/Y') }}</td>
                        @if(Auth::check() && Auth::user()->level == 'admin')
                            <td>
                                <div class="d-grid gap-2">
                                    <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger w-100">Hapus</button>
                                    </form>
                                    <form action="{{ route('buku.edit', $buku->id) }}" method="GET">
                                        <button type="submit" class="btn btn-primary w-100">Edit</button>
                                    </form>
                                </div>
                            </td>
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div>{{ $data_buku->links() }}</div>
        <div><strong>Jumlah Buku: {{ $jumlah_buku }}</strong></div>

        <!-- Menampilkan total harga buku di bawah tabel -->
        <p>Total harga semua buku: Rp. {{ number_format($total_harga, 2, ',', '.') }}</p>

    @endsection
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-9ndCyUa0Jn3WL8pnhD9WmH8eKe6i5k90tqPjsqfCI5Ff5f0vuHV8/qb5mQd/gtds" crossorigin="anonymous"></script>
</body>
</html>
