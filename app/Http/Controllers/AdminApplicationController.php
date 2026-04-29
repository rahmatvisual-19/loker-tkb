<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan baris ini untuk fungsi hapus file

class AdminApplicationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $status = $request->input('status');
        $education_level = $request->input('education_level'); // Tangkap input filter pendidikan

        // Mengambil data pelamar beserta relasi lowongan (job)
        $applications = Application::with('job')
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('email', 'like', "%{$search}%")
                             ->orWhere('education_level', 'like', "%{$search}%");
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            ->when($education_level, function ($query, $education_level) {
                // Saring data berdasarkan level pendidikan jika filter dipilih
                return $query->where('education_level', $education_level);
            })
            ->latest()
            ->paginate(10); // Menampilkan 10 data per halaman

        return view('admin.applications.index', compact('applications'));
    }

    public function show(Application $application)
    {
        // Memuat halaman detail pelamar
        return view('admin.applications.show', compact('application'));
    }

    public function update(Request $request, Application $application)
    {
        // Validasi dan update status pelamar
        $request->validate([
            'status' => 'required|string|in:Menunggu,Direview,Wawancara,Diterima,Ditolak'
        ]);

        $application->update(['status' => $request->status]);

        return back()->with('success', 'Status pelamar berhasil diperbarui menjadi ' . $request->status);
    }

    public function destroy(Application $application)
    {
        // 1. Hapus file fisik dari folder storage jika filenya ada
        if ($application->photo_path && Storage::disk('public')->exists($application->photo_path)) {
            Storage::disk('public')->delete($application->photo_path);
        }
        
        if ($application->cv_path && Storage::disk('public')->exists($application->cv_path)) {
            Storage::disk('public')->delete($application->cv_path);
        }
        
        if ($application->supporting_doc_path && Storage::disk('public')->exists($application->supporting_doc_path)) {
            Storage::disk('public')->delete($application->supporting_doc_path);
        }

        // 2. Baru hapus data pelamar dari database
        $application->delete();
        
        return redirect()->route('applications.index')->with('success', 'Data pelamar beserta berkas CV dan Fotonya berhasil dihapus bersih!');
    }
}