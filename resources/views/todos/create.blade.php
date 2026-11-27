<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat ToDo Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5" style="max-width: 600px;">
    <div class="mb-4">
        <a href="{{ route('todos.index') }}" class="text-decoration-none">&larr; Kembali ke Daftar</a>
        <h3 class="fw-bold mt-2">Buat ToDo Baru</h3>
    </div>

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('todos.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="judul" class="form-label fw-semibold">Judul ToDo <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="judul" name="judul"
                           placeholder="Contoh: Mengerjakan laporan praktikum" value="{{ old('judul') }}" required>
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label fw-semibold">Keterangan</label>
                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"
                              placeholder="Detail tambahan tugas (opsional)...">{{ old('keterangan') }}</textarea>
                </div>

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" id="is_selesai" name="is_selesai" value="1" {{ old('is_selesai') ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_selesai">
                        Tandai sudah selesai (otomatis mencatat tanggal penyelesaian)
                    </label>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary px-4">Simpan ToDo</button>
                    <a href="{{ route('todos.index') }}" class="btn btn-outline-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>