<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Pelanggan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">
    <style>
        body {
            background: #f1f3f5;
            color: #18304f;
        }
        .main-card {
            background: white;
            border-radius: 10px;
            padding: 24px;
            box-shadow: 0 1px 3px #00000015;
        }
        .table thead th {
            background: #f1f3f5;
            white-space: nowrap;
            font-size: 12px;
            padding: 15px;
        }
        .table td {
            padding: 14px;
            vertical-align: middle;
            white-space: nowrap;
        }
        .btn-edit {
            background: #2864dc;
            color: white;
        }
        .btn-edit:hover {
            background: #174db9;
            color: white;
        }
        .btn-add {
            background: #10b981;
            color: white;
        }
        .btn-add:hover {
            background: #059669;
            color: white;
        }
    </style>
</head>
<body>
<div class="container-fluid p-4">

    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <h3>Data Pelanggan</h3>
            <p>List data seluruh pelanggan</p>
        </div>
        <a href="{{ route('customers.create') }}"
           class="btn btn-add px-4">Tambah Pelanggan</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="main-card mb-4">
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>FIRST NAME</th>
                    <th>LAST NAME</th>
                    <th>BIRTHDAY</th>
                    <th>GENDER</th>
                    <th>EMAIL</th>
                    <th>PHONE</th>
                    <th>CV</th>
                    <th>ACTION</th>
                </tr>
                </thead>
                <tbody>
                @forelse($customers as $customer)
                    <tr>
                        <td>{{ $customer->first_name }}</td>
                        <td>{{ $customer->last_name }}</td>
                        <td>{{ $customer->birthday?->format('Y-m-d') ?? '-' }}</td>
                        <td>{{ $customer->gender }}</td>
                        <td>{{ $customer->email }}</td>
                        <td>{{ $customer->phone }}</td>
                        <td>
                            @if($customer->cv_path)
                                <a href="{{ route('customers.downloadCv', $customer) }}"
                                   class="btn btn-sm btn-outline-success">
                                    Download
                                </a>
                            @else
                                <span class="text-muted">Belum ada</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('customers.edit', $customer) }}"
                                   class="btn btn-sm btn-edit">
                                    Edit
                                </a>

                                <a href="{{ route('customers.generateCv', $customer) }}"
                                   class="btn btn-sm btn-success">
                                    Buat CV
                                </a>

                                <form action="{{ route('customers.destroy', $customer) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin ingin menghapus pelanggan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4">
                            Belum ada data pelanggan.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="main-card">
        <h4>Upload CV Pelanggan</h4>
        <p class="text-muted">
            Pilih pelanggan dan unggah CV dalam format PDF, maksimal 5 MB.
        </p>

        <form action="{{ route('customers.index') }}" method="GET"
              id="selectCustomerForm">
            <label for="customerSelect" class="form-label">
                Pilih pelanggan
            </label>
            <select id="customerSelect" class="form-select mb-3">
                <option value="">-- Pilih pelanggan --</option>
                @foreach($customers as $customer)
                    <option value="{{ route('customers.edit', $customer) }}">
                        {{ $customer->first_name }} {{ $customer->last_name }}
                    </option>
                @endforeach
            </select>
            <button type="button" class="btn btn-primary"
                    onclick="openCustomerForm()">
                Lanjut Upload CV
            </button>
        </form>

        <hr>

        <h5>Atau buat CV otomatis</h5>
        <p class="text-muted">
            Klik tombol Buat CV pada baris pelanggan untuk mengunduh
            CV PDF berdasarkan data yang tersedia.
        </p>
    </div>
</div>

<script>
    function openCustomerForm() {
        const url = document.getElementById('customerSelect').value;

        if (!url) {
            alert('Silakan pilih pelanggan terlebih dahulu.');
            return;
        }

        window.location.href = url;
    }
</script>
</body>
</html>
