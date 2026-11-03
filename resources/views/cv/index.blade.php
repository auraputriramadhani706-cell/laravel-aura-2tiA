<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <div class="d-flex justify-content-between mb-3">
        <h3>Daftar CV</h3>
        <a href="{{ route('cv.create') }}" class="btn btn-primary">+ Tambah CV</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered bg-white align-middle">
        <thead>
            <tr><th>Foto</th><th>Nama</th><th>Jabatan</th><th>Email</th><th width="230">Aksi</th></tr>
        </thead>
        <tbody>
        @forelse($cvs as $cv)
            <tr>
                <td>
                    @if($cv->foto)
                        <img src="{{ asset('storage/'.$cv->foto) }}" width="60" height="60"
                             style="object-fit:cover;border-radius:50%">
                    @endif
                </td>
                <td>{{ $cv->nama }}</td>
                <td>{{ $cv->jabatan }}</td>
                <td>{{ $cv->email }}</td>
                <td>
                    <a href="{{ route('cv.show', $cv) }}" class="btn btn-info btn-sm">Lihat</a>
                    <a href="{{ route('cv.edit', $cv) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('cv.destroy', $cv) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin hapus CV ini?')">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center">Belum ada data.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
</body>
</html>
