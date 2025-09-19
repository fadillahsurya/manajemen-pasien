@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow-lg rounded-3">
        <div class="card-body p-4">
            <h2 class="fw-bold mb-4 text-primary">
                📝 Tambah Pasien
            </h2>

            <form action="{{ route('patients.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">No RM</label>
                    <input type="text" name="rm_number" class="form-control form-control-lg" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Depan</label>
                    <input type="text" name="first_name" class="form-control form-control-lg" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Nama Belakang</label>
                    <input type="text" name="last_name" class="form-control form-control-lg">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Gender</label>
                    <select name="gender" class="form-select form-select-lg" required>
                        <option value="">-- Pilih --</option>
                        <option value="male">Laki-laki</option>
                        <option value="female">Perempuan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pendidikan</label>
                    <select name="education" class="form-select form-select-lg">
                        <option value="">-- Pilih --</option>
                        <option value="SD">SD</option>
                        <option value="SMP">SMP</option>
                        <option value="SMA">SMA</option>
                        <option value="D1">D1</option>
                        <option value="D2">D2</option>
                        <option value="D3">D3</option>
                        <option value="D4">D4</option>
                        <option value="S1">S1</option>
                        <option value="S2">S2</option>
                        <option value="S3">S3</option>
                        <option value="Pendidikan Profesi">Pendidikan Profesi</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Status Pernikahan</label>
                    <select name="married_status" class="form-select form-select-lg">
                        <option value="">-- Pilih --</option>
                        <option value="BelumKawin">Belum Kawin</option>
                        <option value="Kawin">Kawin</option>
                        <option value="CeraiHidup">Cerai Hidup</option>
                        <option value="CeraiMati">Cerai Mati</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Pekerjaan</label>
                    <select name="job" class="form-select form-select-lg">
                        <option value="">-- Pilih --</option>
                        <option value="Pelajar">Pelajar</option>
                        <option value="Mahasiswa">Mahasiswa</option>
                        <option value="Pegawai Negeri">Pegawai Negeri</option>
                        <option value="Pegawai Swasta">Pegawai Swasta</option>
                        <option value="Wiraswasta">Wiraswasta</option>
                        <option value="Petani">Petani</option>
                        <option value="Nelayan">Nelayan</option>
                        <option value="Buruh">Buruh</option>
                        <option value="Ibu Rumah Tangga">Ibu Rumah Tangga</option>
                        <option value="TidakBekerja">Tidak Bekerja</option>
                        <option value="Pensiunan">Pensiunan</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Golongan Darah</label>
                    <select name="blood_type" class="form-select form-select-lg">
                        <option value="">-- Pilih --</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-success btn-lg">Simpan</button>
                    <a href="{{ route('patients.index') }}" class="btn btn-secondary btn-lg">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
