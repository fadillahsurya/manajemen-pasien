<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PatientController extends Controller
{
    private $baseUrl = 'https://mockapi.pkuwsb.id/api/patient';
    private $headers = [
        'X-username' => 'admin',
        'X-password' => 'secret',
    ];

    // Daftar pasien
    public function index(Request $request)
    {
        $page    = $request->get('page', 1);
        $perPage = 10;

        $params = ['page' => $page, 'per_page' => $perPage];
        $response = Http::withHeaders($this->headers)->get($this->baseUrl, $params);

        if ($response->successful()) {
            $data       = $response->json();
            $patients   = $data['data']['data'] ?? [];
            $pagination = [
                'current_page' => $data['data']['current_page'] ?? 1,
                'last_page'    => $data['data']['last_page'] ?? 1,
            ];
        } else {
            $patients   = [];
            $pagination = ['current_page' => 1, 'last_page' => 1];
        }

        if ($request->ajax()) {
            return view('patients.partials.table', compact('patients'))->render();
        }

        return view('patients.index', compact('patients', 'pagination'));
    }

    // Search pasien (No RM / Nama)
    public function search(Request $request)
    {
        $keyword = $request->get('search', '');
        $page    = $request->get('page', 1);

        $response = Http::withHeaders($this->headers)->get($this->baseUrl, [
            'search'   => $keyword,
            'page'     => $page,
            'per_page' => 10,
        ]);

        if ($response->successful()) {
            $data       = $response->json();
            $patients   = $data['data']['data'] ?? [];
            $pagination = [
                'current_page' => $data['data']['current_page'] ?? 1,
                'last_page'    => $data['data']['last_page'] ?? 1,
            ];

            return view('patients.partials.table', compact('patients', 'pagination'))->render();
        }

        return response()->json(['error' => 'Gagal mengambil data pasien'], 500);
    }

    // Filter pasien
    public function filter(Request $request)
    {
        $params = [
            'page'     => $request->get('page', 1),
            'per_page' => 10,
        ];

        foreach (['gender', 'education', 'blood_type', 'search'] as $field) {
            if ($request->filled($field)) {
                $params[$field] = $request->get($field);
            }
        }

        $response = Http::withHeaders($this->headers)->get($this->baseUrl, $params);

        if ($response->successful()) {
            $data       = $response->json();
            $patients   = $data['data']['data'] ?? [];
            $pagination = [
                'current_page' => $data['data']['current_page'] ?? 1,
                'last_page'    => $data['data']['last_page'] ?? 1,
            ];

            return view('patients.partials.table', compact('patients', 'pagination'));
        }

        return response()->json(['error' => 'Gagal mengambil data pasien'], 500);
    }

    // CRUD
    public function create()
    {
        return view('patients.create');
    }

    public function store(Request $request)
    {
        $payload = $request->only([
            'rm_number',
            'first_name',
            'last_name',
            'gender',
            'education',
            'married_status',
            'job',
            'blood_type',
        ]);

        foreach ($payload as $key => $value) {
            if ($value === '' || $value === null) {
                $payload[$key] = null;
            }
        }

        $response = Http::withHeaders($this->headers)->post($this->baseUrl, $payload);

        if ($response->successful()) {
            \Log::info("Response Create Patient", [
                'status'  => $response->status(),
                'body'    => $response->json(),
                'payload' => $payload,
            ]);
            return redirect()->route('patients.index')->with('success', 'Pasien berhasil ditambahkan.');
        }

        \Log::error("Create patient failed", [
            'status'  => $response->status(),
            'body'    => $response->body(),
            'payload' => $payload,
        ]);
        return back()->with('error', 'Gagal menambahkan pasien.');
    }

    public function edit($id)
    {
        $response = Http::withHeaders($this->headers)->get("{$this->baseUrl}/{$id}");
        $patient  = $response->successful() ? $response->json()['data'] ?? null : null;

        return $patient
            ? view('patients.edit', compact('patient'))
            : back()->with('error', 'Data pasien tidak ditemukan.');
    }

    public function update(Request $request, $id)
    {
        $payload = $request->only([
            'rm_number',
            'first_name',
            'last_name',
            'gender',
            'education',
            'married_status',
            'job',
            'blood_type',
        ]);

        foreach ($payload as $key => $value) {
            if ($value === '' || $value === null) {
                $payload[$key] = null;
            }
        }

        $response = Http::withHeaders($this->headers)->put("{$this->baseUrl}/{$id}", $payload);

        if ($response->successful()) {
            \Log::info("Response Update Patient", [
                'status'  => $response->status(),
                'body'    => $response->json(),
                'payload' => $payload,
            ]);
            return redirect()->route('patients.index')->with('success', 'Pasien berhasil diperbarui.');
        }

        \Log::error("Update patient failed", [
            'status'  => $response->status(),
            'body'    => $response->body(),
            'payload' => $payload,
        ]);
        return back()->with('error', 'Gagal memperbarui pasien.');
    }

    public function destroy($id)
    {
        $response = Http::withHeaders($this->headers)->delete("{$this->baseUrl}/{$id}");

        if ($response->successful()) {
            return redirect()->route('patients.index')->with('success', 'Pasien berhasil dihapus.');
        }

        return back()->with('error', 'Gagal menghapus pasien.');
    }

    public function detail($id)
    {
        $response = Http::withHeaders($this->headers)->get("{$this->baseUrl}/{$id}");

        if ($response->failed()) {
            return response("<div class='alert alert-danger'>Pasien tidak ditemukan.</div>");
        }

        $patient = $response->json()['data'] ?? null;

        if (!$patient) {
            return response("<div class='alert alert-danger'>Data pasien kosong.</div>");
        }

        return view('patients.partials.detail', compact('patient'));
    }

    public function show($id)
    {
        $response = Http::withHeaders($this->headers)->get("{$this->baseUrl}/{$id}");

        if ($response->successful()) {
            $patient = $response->json()['data'] ?? null;

            if (request()->ajax()) {
                return view('patients.partials.detail', compact('patient'));
            }

            return view('patients.partials.detail', compact('patient'));
        }

        return response()->json(['message' => 'Pasien tidak ditemukan'], 404);
    }
}
