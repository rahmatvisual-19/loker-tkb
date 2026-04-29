<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Category;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        // Menangkap input pencarian (jika ada)
        $search = $request->input('search');

        // Mengambil data job beserta relasi category-nya untuk menghindari N+1 query problem
        $jobs = Job::with('category')
            ->when($search, function ($query, $search) {
                return $query->where('title', 'like', "%{$search}%")
                             ->orWhere('location', 'like', "%{$search}%")
                             ->orWhere('type', 'like', "%{$search}%");
            })
            ->latest()
            ->get();

        // Tambahkan baris ini untuk mengirim data kategori ke halaman index
        $categories = Category::all();

        // Tambahkan 'categories' ke dalam compact
        return view('admin.jobs.index', compact('jobs', 'categories'));
    }

    public function create()
    {
        // Mengambil semua kategori untuk ditampilkan di dropdown form Create
        $categories = Category::all(); 
        
        return view('admin.jobs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // Validasi input form (agar aman)
        $request->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id', // Memastikan ID kategori ada di database
            'min_education' => 'required|string|in:SMA/SMK,D3,S1,S2,Bebas', // Tambahan validasi min_education
            'location'      => 'required|string|max:255',
            'type'          => 'required|string|max:255',
            'status'        => 'required|string|max:255',
            'salary_range'  => 'required|string|max:255',
            'qualification' => 'required|string',
            'description'   => 'required|string',
            'facilities'    => 'required|string',
            'apply_link'    => 'nullable|url',
            'title'         => 'required',
            'priority'      => 'required',
        ]);

        Job::create($request->all());
        
        return redirect()->route('jobs.index')->with('success', 'Loker berhasil ditambahkan');
    }

    public function edit(Job $job)
    {
        // Mengambil semua kategori untuk ditampilkan di dropdown form Edit
        $categories = Category::all(); 
        
        return view('admin.jobs.edit', compact('job', 'categories'));
    }

    public function update(Request $request, Job $job)
    {
        // Validasi input form saat update
        $request->validate([
            'title'         => 'required|string|max:255',
            'category_id'   => 'required|exists:categories,id',
            'min_education' => 'required|string|in:SMA/SMK,D3,S1,S2,Bebas', // Tambahan validasi min_education
            'location'      => 'required|string|max:255',
            'type'          => 'required|string|max:255',
            'status'        => 'required|string|max:255',
            'salary_range'  => 'required|string|max:255',
            'qualification' => 'required|string',
            'description'   => 'required|string',
            'facilities'    => 'required|string',
            'apply_link'    => 'nullable|url',
            'title'         => 'required',
            'priority'      => 'required',
        ]);

        $job->update($request->all());
        
        return redirect()->route('jobs.index')->with('success', 'Loker berhasil diupdate');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        
        return redirect()->route('jobs.index')->with('success', 'Loker berhasil dihapus');
    }
    
}