<div class="table-responsive shadow-sm rounded mb-2" style="overflow-x:auto;">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark text-center">
            <tr>
                <th>No</th>
                <th>No RM</th>
                <th>Nama</th>
                <th>Gender</th>
                <th>Education</th>
                <th>Married Status</th>
                <th>Job</th>
                <th>Blood Type</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $i => $patient)
            <tr>
                <td>{{ $i + 1 }}</td>
                <td>{{ $patient['rm_number'] ?? '-' }}</td>
                <td>{{ trim(($patient['first_name'] ?? '') . ' ' . ($patient['last_name'] ?? '')) }}</td>
                <td>{{ $patient['gender'] ?? '-' }}</td>
                <td>{{ $patient['education'] ?? '-' }}</td>
                <td>{{ $patient['married_status'] ?? '-' }}</td>
                <td>{{ $patient['job'] ?? '-' }}</td>
                <td>{{ $patient['blood_type'] ?? '-' }}</td>
                <td class="text-center">
                    <button type="button" 
                            class="btn btn-sm btn-info btn-detail"
                            data-id="{{ $patient['id'] }}">
                        Detail
                    </button>
                    <a href="{{ route('patients.edit', $patient['id']) }}" 
                       class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('patients.destroy', $patient['id']) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="btn btn-sm btn-danger" 
                                onclick="return confirm('Yakin ingin menghapus pasien ini?')">
                            Hapus
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center">Tidak ada data pasien</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

@if(isset($pagination) && is_array($pagination))
<nav aria-label="Page navigation">
    <ul class="pagination justify-content-center">
        <li class="page-item {{ $pagination['current_page'] <= 1 ? 'disabled' : '' }}">
            <a class="page-link btn-page" href="#" data-page="{{ $pagination['current_page'] - 1 }}">Previous</a>
        </li>
        <li class="page-item disabled">
            <span class="page-link">Halaman {{ $pagination['current_page'] }} / {{ $pagination['last_page'] }}</span>
        </li>
        <li class="page-item {{ $pagination['current_page'] >= $pagination['last_page'] ? 'disabled' : '' }}">
            <a class="page-link btn-page" href="#" data-page="{{ $pagination['current_page'] + 1 }}">Next</a>
        </li>
    </ul>
</nav>
@endif
