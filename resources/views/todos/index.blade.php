<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List — Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5" style="max-width: 720px;">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-0">Daftar To-Do</h2>
            <small class="text-muted">Kelola tugas harian Anda secara terstruktur</small>
        </div>
        <a href="{{ route('todos.create') }}" class="btn btn-primary">+ Tambah ToDo</a>
    </div>

    @if (session('sukses'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('sukses') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-0">
            @forelse ($todos as $todo)
                <div class="d-flex align-items-start justify-content-between p-3 border-bottom">
                    <div class="d-flex align-items-start gap-3">
                        <form action="{{ route('todos.toggle', $todo) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="checkbox" class="form-check-input mt-1" style="cursor:pointer; transform: scale(1.2);"
                                   onchange="this.form.submit()" {{ $todo->is_selesai ? 'checked' : '' }}>
                        </form>
                        <div>
                            <h6 class="mb-1 fw-semibold {{ $todo->is_selesai ? 'text-decoration-line-through text-muted' : '' }}">
                                {{ $todo->judul }}
                            </h6>
                            @if ($todo->keterangan)
                                <p class="mb-1 small text-secondary">{{ $todo->keterangan }}</p>
                            @endif
                            @if ($todo->is_selesai && $todo->tanggal_selesai)
                                <span class="badge bg-success-subtle text-success border border-success-subtle">
                                    Selesai pada: {{ $todo->tanggal_selesai->format('d M Y, H:i') }}
                                </span>
                            @else
                                <span class="badge bg-warning-subtle text-warning-emphasis border border-warning-subtle">
                                    Belum selesai
                                </span>
                            @endif
                        </div>
                    </div>
                    <form action="{{ route('todos.destroy', $todo) }}" method="POST" onsubmit="return confirm('Hapus tugas ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                    </form>
                </div>
            @empty
                <div class="text-center py-5 text-muted">
                    <p class="mb-2">Belum ada tugas yang tercatat.</p>
                    <a href="{{ route('todos.create') }}" class="btn btn-sm btn-outline-primary">Buat ToDo Pertama</a>
                </div>
            @endforelse
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>