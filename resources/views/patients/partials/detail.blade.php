<div class="row">
    <div class="col-md-4 text-center">
        <img src="{{ $patient['avatar'] ?? 'https://ui-avatars.com/api/?name=' . urlencode($patient['first_name'] ?? 'N/A') }}"
             class="img-thumbnail mb-3" width="150" alt="Foto Pasien">
    </div>
    <div class="col-md-8">
        <p><strong>Nama:</strong> {{ ($patient['first_name'] ?? '') . ' ' . ($patient['last_name'] ?? '') }}</p>
        <p><strong>No RM:</strong> {{ $patient['rm_number'] ?? '-' }}</p>
        <p><strong>Gender:</strong> {{ $patient['gender'] ?? '-' }}</p>
        <p><strong>Ethnic:</strong> {{ $patient['ethnic'] ?? '-' }}</p>
        <p><strong>Education:</strong> {{ $patient['education'] ?? '-' }}</p>
        <p><strong>Married Status:</strong> {{ $patient['married_status'] ?? '-' }}</p>
        <p><strong>Job:</strong> {{ $patient['job'] ?? '-' }}</p>
        <p><strong>Blood Type:</strong> {{ $patient['blood_type'] ?? '-' }}</p>
    </div>
</div>
