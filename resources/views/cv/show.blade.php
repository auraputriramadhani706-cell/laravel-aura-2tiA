@php
    $lines = fn ($text) => array_filter(array_map('trim', preg_split('/\r\n|\r|\n/', $text ?? '')));
@endphp
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>CV {{ $cv->nama }}</title>
    <style>
        body { margin: 0; background: #eee; font-family: Arial, sans-serif; color: #333; }
        .page { display: flex; max-width: 800px; min-height: 1000px; margin: 20px auto; background: #fff; }
        .side { width: 33%; background: #fbe9e1; padding: 30px 22px; }
        .main { width: 67%; padding: 40px 32px; }
        .foto { width: 150px; height: 150px; border-radius: 50%; object-fit: cover; display: block; margin: 0 auto 25px; }
        h1 { margin: 0; font-size: 34px; letter-spacing: 1px; color: #8b5e3c; text-transform: uppercase; }
        .jabatan { margin: 6px 0 16px; font-weight: bold; text-transform: uppercase; font-size: 14px; }
        h2 { font-size: 15px; letter-spacing: 1px; text-transform: uppercase; color: #8b5e3c;
             border-bottom: 2px solid #8b5e3c; padding-bottom: 4px; margin: 24px 0 10px; }
        .side h2 { color: #333; }
        ul { padding-left: 18px; margin: 0; font-size: 13px; line-height: 1.6; }
        p { font-size: 13px; line-height: 1.6; margin: 0 0 6px; }
        .toolbar { max-width: 800px; margin: 20px auto 0; }
        .toolbar a { font-size: 14px; }
        @media print { .toolbar { display: none; } body { background: #fff; } .page { margin: 0; } }
    </style>
</head>
<body>
<div class="toolbar">
    <a href="{{ route('cv.index') }}">&larr; Kembali</a> |
    <a href="#" onclick="window.print()">Cetak / Simpan PDF</a>
</div>

<div class="page">
    <div class="side">
        @if($cv->foto)
            <img class="foto" src="{{ asset('storage/'.$cv->foto) }}">
        @endif

        <h2>Kontak</h2>
        <p>{{ $cv->alamat }}</p>
        <p>{{ $cv->telepon }}</p>
        <p>{{ $cv->email }}</p>
        <p>{{ $cv->website }}</p>

        @if($cv->pendidikan)
            <h2>Pendidikan</h2>
            <ul>@foreach($lines($cv->pendidikan) as $i)<li>{{ $i }}</li>@endforeach</ul>
        @endif

        @if($cv->skill)
            <h2>Skill</h2>
            <ul>@foreach($lines($cv->skill) as $i)<li>{{ $i }}</li>@endforeach</ul>
        @endif
    </div>

    <div class="main">
        <h1>{{ $cv->nama }}</h1>
        <div class="jabatan">{{ $cv->jabatan }}</div>
        <p>{{ $cv->ringkasan }}</p>

        @if($cv->pengalaman)
            <h2>Pengalaman Kerja</h2>
            <ul>@foreach($lines($cv->pengalaman) as $i)<li>{{ $i }}</li>@endforeach</ul>
        @endif

        @if($cv->sertifikasi)
            <h2>Sertifikasi</h2>
            <ul>@foreach($lines($cv->sertifikasi) as $i)<li>{{ $i }}</li>@endforeach</ul>
        @endif
    </div>
</div>
</body>
</html>
