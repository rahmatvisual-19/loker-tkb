<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    // Menampilkan form lamaran dan pre-screening
    public function create(Job $job)
    {
        // Pastikan lowongan masih aktif, jika tidak lemparkan error 404
        if (!$job->is_active) {
            abort(404, 'Lowongan ini sudah ditutup.');
        }

        return view('frontend.apply', compact('job'));
    }

    // Memproses data lamaran yang disubmit
    public function store(Request $request, Job $job)
    {
        // 1. VALIDASI DUPLIKASI (Email + Job ID)
        $exists = Application::where('job_id', $job->id)
                             ->where('email', $request->email)
                             ->exists();

        if ($exists) {
            return back()->withInput()->withErrors(['email' => 'Anda sudah pernah melamar untuk posisi ini menggunakan email tersebut. Silakan tunggu informasi selanjutnya dari tim kami.']);
        }

        // 2. VALIDASI PRE-SCREENING BACKEND (Cegah Bypass HTML)
        $eduWeights = ['Bebas' => 0, 'SMA/SMK' => 1, 'D3' => 2, 'S1' => 3, 'S2' => 4];
        $jobMinWeight = $eduWeights[$job->min_education] ?? 0;
        $applicantWeight = $eduWeights[$request->education_level] ?? 0;

        if ($applicantWeight < $jobMinWeight) {
             return back()->withInput()->withErrors(['education_level' => 'Kualifikasi pendidikan Anda tidak memenuhi syarat minimal untuk posisi ini.']);
        }

        // 3. VALIDASI FORM UTAMA
        $validated = $request->validate([
            // Bagian 1
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'whatsapp' => 'required|string|max:20',
            'birth_place' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'gender' => 'required|in:Laki-laki,Perempuan',
            'domicile' => 'required|string|max:255',
            'portfolio_link' => 'nullable|url',
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',

            // Bagian 2
            'education_level' => 'required|string',
            'institution_name' => 'required|string|max:255',
            'major' => 'required|string|max:255',
            'gpa' => 'required|numeric',

            // Bagian 3 (Pembaruan Logika Pengalaman)
            'experience_type' => 'required|in:experienced,fresh_with_exp,fresh_no_exp',
            'experiences' => 'nullable|array',
            'experiences.*.company_name' => 'nullable|string|max:255',
            'experiences.*.job_position' => 'nullable|string|max:255',
            'experiences.*.work_start_date' => 'nullable|string|max:50',
            'experiences.*.work_end_date' => 'nullable|string|max:50',
            'experiences.*.job_description' => 'nullable|string',

            // Bagian 4
            'height' => 'required|numeric',
            'weight' => 'required|numeric',
            'is_color_blind' => 'required|boolean',
            'disease_history' => 'nullable|string',
            'expected_salary' => 'required|string|max:255',
            'willing_out_of_town' => 'required|boolean',
            'notice_period' => 'required|string|max:255',

            // Bagian 5
            'cv' => 'required|mimes:pdf|max:2048',
            'supporting_doc' => 'nullable|mimes:pdf,jpg,jpeg,png|max:2048',
            
            // Pernyataan Final
            'agreement' => 'accepted'
        ]);

        // 4. PROSES UPLOAD FILE DENGAN PENAMAAN CUSTOM
        $nameSlug = Str::slug($validated['name']); 
        $timestamp = time(); 

        $photoExt = $request->file('photo')->getClientOriginalExtension();
        $photoFilename = "{$nameSlug}-photo-{$timestamp}.{$photoExt}";
        $photoPath = $request->file('photo')->storeAs('applications/photos', $photoFilename, 'public');

        $cvExt = $request->file('cv')->getClientOriginalExtension();
        $cvFilename = "{$nameSlug}-cv-{$timestamp}.{$cvExt}";
        $cvPath = $request->file('cv')->storeAs('applications/cvs', $cvFilename, 'public');

        $supportingDocPath = null;
        if ($request->hasFile('supporting_doc')) {
            $docExt = $request->file('supporting_doc')->getClientOriginalExtension();
            $docFilename = "{$nameSlug}-doc-{$timestamp}.{$docExt}";
            $supportingDocPath = $request->file('supporting_doc')->storeAs('applications/docs', $docFilename, 'public');
        }

        // 4.5 FORMAT DATA PENGALAMAN KERJA (ARRAY -> JSON)
        $experiences = [];
        // Hanya simpan pengalaman jika pelamar bukan tipe "fresh_no_exp"
        if ($request->experience_type !== 'fresh_no_exp' && $request->has('experiences')) {
            foreach ($request->experiences as $exp) {
                if (!empty($exp['company_name'])) {
                    $endDate = isset($exp['is_currently_working']) ? 'Saat Ini' : ($exp['work_end_date'] ?? null);
                    $experiences[] = [
                        'company_name' => $exp['company_name'] ?? '',
                        'job_position' => $exp['job_position'] ?? '',
                        'work_start_date' => $exp['work_start_date'] ?? '',
                        'work_end_date' => $endDate,
                        'job_description' => $exp['job_description'] ?? '',
                    ];
                }
            }
        }

        // Menentukan status is_fresh_graduate untuk database
        // True jika memilih "fresh_with_exp" atau "fresh_no_exp"
        $isFreshGraduate = in_array($request->experience_type, ['fresh_with_exp', 'fresh_no_exp']);

        // 5. SIMPAN KE DATABASE
        Application::create([
            'job_id' => $job->id,
            'status' => 'Menunggu',
            
            // Bagian 1
            'name' => $validated['name'],
            'email' => $validated['email'],
            'whatsapp' => $validated['whatsapp'],
            'birth_place' => $validated['birth_place'],
            'birth_date' => $validated['birth_date'],
            'gender' => $validated['gender'],
            'domicile' => $validated['domicile'],
            'portfolio_link' => $validated['portfolio_link'],
            'photo_path' => $photoPath,

            // Bagian 2
            'education_level' => $validated['education_level'],
            'institution_name' => $validated['institution_name'],
            'major' => $validated['major'],
            'gpa' => $validated['gpa'],

            // Bagian 3
            'is_fresh_graduate' => $isFreshGraduate,
            'work_experiences' => empty($experiences) ? null : $experiences,

            // Bagian 4
            'height' => $validated['height'],
            'weight' => $validated['weight'],
            'is_color_blind' => $validated['is_color_blind'],
            'disease_history' => $validated['disease_history'],
            'expected_salary' => $validated['expected_salary'],
            'willing_out_of_town' => $validated['willing_out_of_town'],
            'notice_period' => $validated['notice_period'],

            // Bagian 5
            'cv_path' => $cvPath,
            'supporting_doc_path' => $supportingDocPath,
        ]);

        return redirect()->route('applications.success')->with('success', 'Lamaran berhasil dikirim!');
    }

    // Fungsi untuk memproses pencarian status lamaran
    public function checkStatus(Request $request)
    {
        $email = $request->input('email');
        
        // Cari aplikasi berdasarkan email jika ada input, ambil beserta nama lokernya
        $applications = collect();
        if ($email) {
            $applications = Application::where('email', $email)->with('job')->latest()->get();
        }

        return view('frontend.cek-status', compact('applications', 'email'));
    }
}