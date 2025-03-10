<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Attendance;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count(); // Menghitung total users
        $totalAttendances = Attendance::count(); // Menghitung total attendances

         // Mengambil data absensi terbaru
         $recentAttendances = Attendance::with('user')
         ->orderBy('date', 'desc') // Urutkan berdasarkan tanggal terbaru
         ->take(5) // Ambil 5 data terbaru
         ->get();

     // Kirim data ke view
     return view('pages.dashboard', compact('totalUsers', 'totalAttendances', 'recentAttendances'));
    }
}
