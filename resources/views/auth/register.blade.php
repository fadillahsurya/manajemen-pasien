@extends('layouts.app')

@section('no-card')
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7 col-lg-6">
        <div class="card shadow-lg rounded-3">
            <div class="card-body p-4">
                <h3 class="text-center mb-4 fw-bold text-success">📝 Registrasi</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email (@pkuwsb.id)</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <small class="text-muted">Minimal 7 karakter, ada huruf besar, kecil, dan angka.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Foto Profil</label>
                        <input type="file" name="profile_photo" class="form-control" accept="image/*" required>
                    </div>
                    <button class="btn btn-success w-100 py-2">Daftar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
