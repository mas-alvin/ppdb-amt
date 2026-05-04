<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\StudentDocument;
use App\Models\User;
use App\Models\Wave;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $period = $request->query('period', 'weekly');

        // KPI Values
        $kpiValues = [
            'kpi_total_apps' => Registration::count(),
            'kpi_verified_docs' => StudentDocument::where('status', 'verified')->count(),
            'kpi_pending_review' => StudentDocument::where('status', 'pending')->count(),
            'kpi_rejected' => StudentDocument::where('status', 'rejected')->count(), // Updated to documents
        ];

        // Trend calculation
        if ($period === 'weekly') {
            $trend = Registration::select(
                DB::raw("to_char(created_at, 'ID') as label_index"),
                DB::raw("to_char(created_at, 'Dy') as label"),
                DB::raw('count(*) as value')
            )
            ->where('created_at', '>=', now()->subDays(7))
            ->groupBy('label_index', 'label')
            ->orderBy('label_index')
            ->get();
        } elseif ($period === 'monthly') {
            $trend = Registration::select(
                DB::raw("to_char(created_at, 'MM') as label_index"),
                DB::raw("to_char(created_at, 'Mon') as label"),
                DB::raw('count(*) as value')
            )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('label_index', 'label')
            ->orderBy('label_index')
            ->get();
        } else { // yearly
            $trend = Registration::select(
                DB::raw("to_char(created_at, 'YYYY') as label"),
                DB::raw('count(*) as value')
            )
            ->where('created_at', '>=', now()->subYears(5))
            ->groupBy('label')
            ->orderBy('label')
            ->get();
        }

        $trend = $trend->map(fn($item) => [
            'label' => $item->label,
            'value' => (int) $item->value
        ])->toArray();

        // Fallback if trend is empty
        if (empty($trend)) {
            $trend = [['label' => 'No Data', 'value' => 0]];
        }

        // Distribusi Tahapan Siswa
        $distribution = Registration::select('status as label', DB::raw('count(*) as value'))
            ->groupBy('status')
            ->get()
            ->map(function ($item) {
                $colors = [
                    'pending' => 'bg-amber-400',
                    'verified' => 'bg-emerald-500',
                    'rejected' => 'bg-red-500',
                    'draft' => 'bg-slate-300',
                ];
                return [
                    'label' => strtoupper($item->label),
                    'value' => $item->value,
                    'color' => $colors[$item->label] ?? 'bg-blue-500'
                ];
            })->toArray();

        // Aktivitas Pendaftar (10 terbaru)
        $activity = Registration::with('user')->latest()->limit(10)->get()->map(function ($reg) {
            return [
                'actor' => $reg->nama_lengkap,
                'action' => 'mendaftar di ' . ($reg->wave->name ?? 'Gelombang Aktif'),
                'time' => $reg->created_at->diffForHumans()
            ];
        })->toArray();

        // System Logs (Using recent user registrations/activities as simulation for now)
        $logs = User::latest()->limit(5)->get()->map(function ($user) {
            return [
                'level' => 'info',
                'message' => 'Akun baru: ' . $user->name . ' (' . $user->email . ')',
                'time' => $user->created_at->format('H:i:s')
            ];
        })->toArray();

        return view('pages.admin.dashboard', compact('kpiValues', 'trend', 'distribution', 'activity', 'logs'));
    }
}
