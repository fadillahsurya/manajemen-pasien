@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
        <h2 class="fw-bold">Manajemen Pasien</h2>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('patients.create') }}" class="btn btn-primary">+ Tambah Pasien</a>
            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#filterModal">Filter</button>

            <div class="dropdown">
                <button class="btn btn-outline-dark dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    ⚙️ Menu
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-4 d-flex gap-2">
            <input type="text" id="search" class="form-control" placeholder="Cari No RM atau Nama...">
            <button id="btnSearch" class="btn btn-primary">Search</button>
        </div>
    </div>

    <div id="patients-table">
        @include('patients.partials.table', ['patients'=>$patients])
    </div>
</div>

<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filter Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="filterForm">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label>Gender</label>
                            <select name="gender" class="form-select">
                                <option value="">Pilih</option>
                                <option value="male">Laki-laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label>Education</label>
                            <select name="education" class="form-select">
                                <option value="">Pilih</option>
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
                        <div class="col-md-4">
                            <label>Blood Type</label>
                            <select name="blood_type" class="form-select">
                                <option value="">Pilih</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                                <option value="O">O</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="applyFilter" class="btn btn-primary">Apply Filter</button>
                <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail Pasien</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="detailContent">
                <div class="text-center">Loading...</div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    function reloadTable(params = '') {
        fetch("{{ route('patients.filter') }}?" + params, {
            headers: {"X-Requested-With": "XMLHttpRequest"}
        })
        .then(res => res.text())
        .then(html => document.getElementById('patients-table').innerHTML = html);
    }

    document.getElementById('btnSearch').addEventListener('click', function() {
        let searchVal = document.getElementById('search').value;
        let params = new URLSearchParams();
        if (searchVal) params.append('search', searchVal.trim());
        reloadTable(params.toString());
    });

    document.getElementById('search').addEventListener('keyup', function(e) {
        if (e.key === "Enter") {
            document.getElementById('btnSearch').click();
        }
    });

    document.getElementById('applyFilter').addEventListener('click', function() {
        let params = new URLSearchParams(new FormData(document.getElementById('filterForm')));
        let searchVal = document.getElementById('search').value;
        if (searchVal) params.append('search', searchVal.trim());
        reloadTable(params.toString());
        bootstrap.Modal.getInstance(document.getElementById('filterModal')).hide();
    });

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('btn-detail')) {
            let id = e.target.dataset.id;
            let url = "{{ url('patients') }}/" + id + "/detail";
            document.getElementById('detailContent').innerHTML = "<div class='text-center'>Loading...</div>";

            fetch(url, {headers: {"X-Requested-With": "XMLHttpRequest"}})
                .then(res => res.text())
                .then(html => {
                    document.getElementById('detailContent').innerHTML = html;
                    new bootstrap.Modal(document.getElementById('detailModal')).show();
                });
        }
    });
</script>
@endsection
