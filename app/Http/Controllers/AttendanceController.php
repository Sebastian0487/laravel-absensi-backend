<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    //index
    public function index(Request $request)
    {
        $attendances = Attendance::with('user')
            ->when($request->input('name'), function ($query, $name) {
                $query->whereHas('user', function ($query) use ($name) {
                    $query->where('name', 'like', '%' . $name . '%');
                });
            })->orderBy('id', 'desc')->paginate(10);
        return view('pages.absensi.index', compact('attendances'));
    }
    //UPDATE
      public function update(Request $request, $id)
    {
        $attendance = Attendance::find($id);
        $attendance->is_approved = $request->is_approved;
        $attendance->save();
        return redirect()->route('attendances.index')->with('success', 'Attendance updated successfully');
    }
    //destroy
    public function destroy($id)
    {
        $attendance = Attendance::findOrFail($id);
        $attendance->delete();
        
        return redirect()->route('attendances.index')->with('success', 'Attendance deleted successfully');
    }
}