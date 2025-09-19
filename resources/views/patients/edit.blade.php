@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg rounded-3">
        <div class="card-body p-4">
            <h2 class="fw-bold mb-4 text-primary">✏️ Edit Pasien</h2>

            <form action="{{ route('patients.update', $patient['id']) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label fw-semibold">No RM</label>
                    <input type="text" name="rm_number" class="form-control form-control-lg" 
                           value="{{ $patient['rm_number'] ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Depan</label>
                    <input type="text" name="first_name" class="form-control form-control-lg" 
                           value="{{ $patient['first_name'] ?? '' }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Belakang</label>
                    <input type="text" name="last_name" class="form-control form-control-lg" 
                           value="{{ $patient['last_name'] ?? '' }}">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gender</label>
                    <select name="gender" class="form-select form-select-lg" required>
                        <option value="male" {{ ($patient['gender'] ?? '') == 'male' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="female" {{ ($patient['gender'] ?? '') == 'female' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pendidikan</label>
                    <select name="education" class="form-select form-select-lg">
                        <option value="">-- Pilih --</option>
                        <option value="SD" {{ ($patient['education'] ?? '') == 'SD' ? 'selected' : '' }}>SD</option>
                        <option value="SMP" {{ ($patient['education'] ?? '') == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA" {{ ($patient['education'] ?? '') == 'SMA' ? 'selected' : '' }}>SMA</option>
                        <option value="D1" {{ ($patient['education'] ?? '') == 'D1' ? 'selected' : '' }}>D1</option>
                        <option value="D2" {{ ($patient['education'] ?? '') == 'D2' ? 'selected' : '' }}>D2</option>
                        <option value="D3" {{ ($patient['education'] ?? '') == 'D3' ? 'selected' : '' }}>D3</option>
                        <option value="D4" {{ ($patient['education'] ?? '') == 'D4' ? 'selected' : '' }}>D4</option>
                        <option value="S1" {{ ($patient['education'] ?? '') == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ ($patient['education'] ?? '') == 'S2' ? 'selected' : '' }}>S2</option>
                        <option value="S3" {{ ($patient['education'] ?? '') == 'S3' ? 'selected' : '' }}>S3</option>
                        <option value="Pendidikan Profesi" {{ ($patient['education'] ?? '') == 'Pendidikan Profesi' ? 'selected' : '' }}>Pendidikan Profesi</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status Pernikahan</label>
                    <select name="married_status" class="form-select form-select-lg">
                        <option value="">-- Pilih --</option>
                        <option value="BelumKawin" {{ ($patient['married_status'] ?? '') == 'BelumKawin' ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="Kawin" {{ ($patient['married_status'] ?? '') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                        <option value="CeraiHidup" {{ ($patient['married_status'] ?? '') == 'CeraiHidup' ? 'selected' : '' }}>Cerai Hidup</option>
                        <option value="CeraiMati" {{ ($patient['married_status'] ?? '') == 'CeraiMati' ? 'selected' : '' }}>Cerai Mati</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pekerjaan</label>
                    <select name="job" class="form-select form-select-lg">
                        <option value="">-- Pilih --</option>
                        <option value="Pelajar" {{ ($patient['job'] ?? '') == 'Pelajar' ? 'selected' : '' }}>Pelajar</option>
                        <option value="Mahasiswa" {{ ($patient['job'] ?? '') == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        <option value="Pegawai Negeri" {{ ($patient['job'] ?? '') == 'Pegawai Negeri' ? 'selected' : '' }}>Pegawai Negeri</option>
                        <option value="Pegawai Swasta" {{ ($patient['job'] ?? '') == 'Pegawai Swasta' ? 'selected' : '' }}>Pegawai Swasta</option>
                        <option value="Wiraswasta" {{ ($patient['job'] ?? '') == 'Wiraswasta' ? 'selected' : '' }}>Wiraswasta</option>
                        <option value="Petani" {{ ($patient['job'] ?? '') == 'Petani' ? 'selected' : '' }}>Petani</option>
                        <option value="Nelayan" {{ ($patient['job'] ?? '') == 'Nelayan' ? 'selected' : '' }}>Nelayan</option>
                        <option value="Buruh" {{ ($patient['job'] ?? '') == 'Buruh' ? 'selected' : '' }}>Buruh</option>
                        <option value="Ibu Rumah Tangga" {{ ($patient['job'] ?? '') == 'Ibu Rumah Tangga' ? 'selected' : '' }}>Ibu Rumah Tangga</option>
                        <option value="TidakBekerja" {{ ($patient['job'] ?? '') == 'TidakBekerja' ? 'selected' : '' }}>Tidak Bekerja</option>
                        <option value="Pensiunan" {{ ($patient['job'] ?? '') == 'Pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                        <option value="Lainnya" {{ ($patient['job'] ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Golongan Darah</label>
                    <select name="blood_type" class="form-select form-select-lg">
                        <option value="">-- Pilih --</option>
                        <option value="A" {{ ($patient['blood_type'] ?? '') == 'A' ? 'selected' : '' }}>A</option>
                        <option value="B" {{ ($patient['blood_type'] ?? '') == 'B' ? 'selected' : '' }}>B</option>
                        <option value="AB" {{ ($patient['blood_type'] ?? '') == 'AB' ? 'selected' : '' }}>AB</option>
                        <option value="O" {{ ($patient['blood_type'] ?? '') == 'O' ? 'selected' : '' }}>O</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success btn-lg">Update</button>
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary btn-lg">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
