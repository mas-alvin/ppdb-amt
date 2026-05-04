<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Announcement;
use App\Models\Wave;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $registration = Registration::where('user_id', $user->id)->first();
        $progress = $user->calculateProgress();
        
        // All active announcements
        $announcements = Announcement::where('is_active', true)->latest()->get();
        
        // Active Wave for quota display
        $activeWave = Wave::where('status', 'open')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();

        $remainingQuota = 0;
        if ($activeWave) {
            $usedQuota = Registration::where('wave_id', $activeWave->id)->count();
            $remainingQuota = max(0, $activeWave->quota - $usedQuota);
        }

        return view('pages.students.dashboard', compact(
            'registration', 
            'progress', 
            'announcements', 
            'activeWave', 
            'remainingQuota'
        ));
    }
}
