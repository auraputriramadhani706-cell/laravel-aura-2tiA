<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $cv->exists ? 'Edit' : 'Tambah' }} CV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4" style="max-width: 800px">
    <h3>{{ $cv->exists ? 'Edit' : 'Tambah' }} CV</h3>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" enctype="multipart/form-data"
          action="{{ $cv->exists ? route('cv.update', $cv) : route('cv.store') }}"
          class="card card-body">
        @csrf
        @if($cv->exists) @method('PUT') @endif

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama</label>
                <input type="text" name="nama" class="form-control" value="{{ old('nama', $cv->nama) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Jabatan</label>
                <input type="text" name="jabatan" class="form-control" value="{{ old('jabatan', $cv->jabatan) }}">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Foto</label>
            @if($cv->foto)
                <div class="mb-2"><img src="{{ asset('storage/'.$cv->foto) }}" width="90" class="rounded"></div>
            @endif
            <input type="file" name="foto" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Ringkasan</label>
            <textarea name="ringkasan" rows="3" class="form-control">{{ old('ringkasan', $cv->ringkasan) }}</textarea>
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" value="{{ old('email', $cv->email) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Telepon</label>
                <input type="text" name="telepon" class="form-control" value="{{ old('telepon', $cv->telepon) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" class="form-control" value="{{ old('alamat', $cv->alamat) }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label">Website</label>
                <input type="text" name="website" class="form-control" value="{{ old('website', $cv->website) }}">
            </div>
        </div>

        @foreach(['pendidikan' => 'Pendidikan', 'pengalaman' => 'Pengalaman Kerja', 'skill' => 'Skill', 'sertifikasi' => 'Sertifikasi'] as $field => $label)
            <div class="mb-3">
                <label class="form-label">{{ $label }} <small class="text-muted">(satu baris = satu item)</small></label>
                <textarea name="{{ $field }}" rows="4" class="form-control">{{ old($field, $cv->$field) }}</textarea>
            </div>
        @endforeach

        <div>
            <button class="btn btn-primary">Simpan</button>
            <a href="{{ route('cv.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
</body>
</html>
