<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    // Tampilkan daftar absensi
    public function index(Request $request)
    {
        $attendances = Attendance::with('user')
            ->when($request->input('name'), function ($query, $name) {
                $query->whereHas('user', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                });
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.absensi.index', compact('attendances'));
    }

    // Download laporan absensi dalam bentuk PDF
    public function downloadPdf()
{
    // Ambil data absensi lengkap dengan relasi user
    $attendances = Attendance::with('user')->get();

    // Load view PDF
    $pdf = Pdf::loadView('pages.absensi.pdf', compact('attendances'));

    // Unduh file PDF dengan nama laporan-absensi.pdf
    return $pdf->download('laporan-absensi.pdf');
}
    // Fitur download by user
public function downloadUserPdf($user_id)
{
    // Ambil data absensi berdasarkan user_id
    $attendances = Attendance::with('user')
        ->where('user_id', $user_id)
        ->get();

    // Ambil informasi user untuk judul laporan
    $user = $attendances->first()->user ?? null;

    if (!$user) {
        return redirect()->back()->with('error', 'No attendance data found for this user.');
    }

    // Load view PDF dengan data absensi user
    $pdf = Pdf::loadView('pages.absensi.user-pdf', compact('attendances', 'user'));

    // Unduh file PDF dengan nama berdasarkan nama user
    $filename = 'laporan-absensi-' . $user->name . '.pdf';
    return $pdf->download($filename);
}
   // Fitur Filter Tanggal
public function downloadFilteredPdf($filter)
{
    // Tentukan range tanggal berdasarkan filter
    $startDate = null;
    $endDate = Carbon::now();

    switch ($filter) {
        case 'today':
            $startDate = Carbon::today();
            break;

        case 'this-week':
            $startDate = Carbon::now()->startOfWeek();
            break;

        case 'this-month':
            $startDate = Carbon::now()->startOfMonth();
            break;

        default:
            return redirect()->back()->with('error', 'Filter tidak valid.');
    }

    // Ambil data absensi sesuai range tanggal
    $attendances = Attendance::with('user')
        ->whereBetween('date', [$startDate, $endDate])
        ->get();

    // Jika data tidak ada
    if ($attendances->isEmpty()) {
        return redirect()->back()->with('error', "Absensi untuk {$filter} tidak tersedia.");
    }

    // Generate PDF
    $pdf = Pdf::loadView('pages.absensi.filtered-pdf', compact('attendances', 'filter'));

    // Unduh file PDF
    $filename = "laporan-absensi-{$filter}.pdf";
    return $pdf->download($filename);
}


}
