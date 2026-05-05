<?php

namespace App\Http\Controllers;

use App\Models\LowonganModel;
use App\Models\PerusahaanModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin_dashboard.index', [
            'activeMenu' => 'dashboard',
            'breadcrumb' => 'Welcome to Dashboard',
            'title' => 'JTIntern - Sistem Rekomendasi Tempat Magang',
            'totalMahasiswa' => User::count(),
            'totalLowongan' => LowonganModel::count(),
            'totalPerusahaan' => PerusahaanModel::count(),
            'totalRekomendasi' => 340,
            'latestLowongan' => LowonganModel::with('perusahaan')->latest()->take(3)->get(),
        ]);
    }
}
