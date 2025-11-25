<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class VisitController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->get('period', 'daily');
        $date = $request->get('date', now()->format('Y-m-d'));
        $month = $request->get('month', now()->format('Y-m'));
        $year = $request->get('year', now()->format('Y'));

        // Debug: Check if we're getting parameters
        \Log::info('VisitController params:', compact('period', 'date', 'month', 'year'));

        // dd([
        //     'request_all' => $request->all(),
        //     'period' => $period,
        //     'month' => $month
        // ]);

        // Initialize default values
        $stats = ['total' => 0, 'guests' => 0, 'users' => 0, 'period_label' => 'No Data'];
        $chartData = collect();
        $tableData = collect();

        // Get data based on period
        try {
            switch ($period) {
                case 'monthly':
                    $stats = $this->getMonthlyStats($month);
                    $chartData = $this->getMonthlyChartData($month);
                    $tableData = $this->getMonthlyTableData($month);
                    break;
                case 'yearly':
                    $stats = $this->getYearlyStats($year);
                    $chartData = $this->getYearlyChartData($year);
                    $tableData = $this->getYearlyTableData($year);
                    break;
                default: // daily
                    $stats = $this->getDailyStats($date);
                    $chartData = $this->getDailyChartData($date);
                    $tableData = $this->getDailyTableData($date);
                    break;
            }
        } catch (\Exception $e) {
            \Log::error('VisitController error: ' . $e->getMessage());
        }

        // Debug: Check what we got
        \Log::info('VisitController results:', [
            'stats' => $stats,
            'chartData_count' => $chartData->count(),
            'tableData_count' => $tableData->count()
        ]);

        // Legacy data for compatibility
        $todayVisits = DB::table('visits')->whereDate('visit_date', today())->count();
        $totalVisits = DB::table('visits')->count();
        $guestVisits = DB::table('visits')->whereDate('visit_date', today())->whereNull('user_id')->count();
        $userVisits = DB::table('visits')->whereDate('visit_date', today())->whereNotNull('user_id')->count();

        $recentVisits = DB::table('visits')
            ->leftJoin('users', 'visits.user_id', '=', 'users.id')
            ->select('visits.*', 'users.name as user_name')
            ->orderBy('visits.created_at', 'desc')
            ->limit(10)
            ->get();

        return view('admin.visit-stats', [
            'stats' => $stats,
            'recentVisits' => $recentVisits,
            'chartData' => $chartData,
            'tableData' => $tableData,
            'period' => $period,
            'date' => $date,
            'month' => $month,
            'year' => $year,
            'todayVisits' => $todayVisits,
            'totalVisits' => $totalVisits,
            'guestVisits' => $guestVisits,
            'userVisits' => $userVisits
        ]);
    }

    private function getDailyStats($date)
    {
        $total = DB::table('visits')->whereDate('visit_date', $date)->count();
        $guests = DB::table('visits')->whereDate('visit_date', $date)->whereNull('user_id')->count();
        $users = DB::table('visits')->whereDate('visit_date', $date)->whereNotNull('user_id')->count();

        return [
            'total' => $total,
            'guests' => $guests,
            'users' => $users,
            'period_label' => Carbon::parse($date)->format('d F Y')
        ];
    }

    private function getDailyChartData($date)
    {
        return DB::table('visits')
            ->select(DB::raw('HOUR(created_at) as hour, COUNT(*) as count'))
            ->whereDate('visit_date', $date)
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();
    }

    private function getDailyTableData($date)
    {
        $selectedDate = Carbon::parse($date);

        return DB::table('visits')
            ->select(
                DB::raw('DATE(visit_date) as date'),
                DB::raw('COUNT(*) as total'),
                DB::raw('COUNT(CASE WHEN user_id IS NULL THEN 1 END) as guests'),
                DB::raw('COUNT(CASE WHEN user_id IS NOT NULL THEN 1 END) as users')
            )
            ->whereYear('visit_date', $selectedDate->year)
            ->whereMonth('visit_date', $selectedDate->month)
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($item) {
                $item->formatted_date = Carbon::parse($item->date)->format('d F Y');
                $item->day_name = Carbon::parse($item->date)->format('l');
                return $item;
            });
    }

    private function getMonthlyStats($month)
    {
        $selectedMonth = Carbon::parse($month . '-01');

        $total = DB::table('visits')
            ->whereYear('visit_date', $selectedMonth->year)
            ->whereMonth('visit_date', $selectedMonth->month)
            ->count();

        $guests = DB::table('visits')
            ->whereYear('visit_date', $selectedMonth->year)
            ->whereMonth('visit_date', $selectedMonth->month)
            ->whereNull('user_id')
            ->count();

        $users = DB::table('visits')
            ->whereYear('visit_date', $selectedMonth->year)
            ->whereMonth('visit_date', $selectedMonth->month)
            ->whereNotNull('user_id')
            ->count();

        return [
            'total' => $total,
            'guests' => $guests,
            'users' => $users,
            'period_label' => $selectedMonth->format('F Y')
        ];
    }

    private function getMonthlyChartData($month)
    {
        $selectedMonth = Carbon::parse($month . '-01');

        return DB::table('visits')
            ->select(DB::raw('DAY(visit_date) as day, COUNT(*) as count'))
            ->whereYear('visit_date', $selectedMonth->year)
            ->whereMonth('visit_date', $selectedMonth->month)
            ->groupBy('day')
            ->orderBy('day')
            ->get();
    }

    private function getMonthlyTableData($month)
    {
        $selectedMonth = Carbon::parse($month . '-01');

        return DB::table('visits')
            ->select(
                DB::raw('YEAR(visit_date) as year'),
                DB::raw('MONTH(visit_date) as month'),
                DB::raw('COUNT(*) as total'),
                DB::raw('COUNT(CASE WHEN user_id IS NULL THEN 1 END) as guests'),
                DB::raw('COUNT(CASE WHEN user_id IS NOT NULL THEN 1 END) as users')
            )
            ->whereYear('visit_date', $selectedMonth->year)
            ->groupBy('year', 'month')
            ->orderBy('month', 'desc')
            ->get()
            ->map(function ($item) {
                $item->formatted_month = Carbon::create($item->year, $item->month, 1)->format('F Y');
                return $item;
            });
    }

    private function getYearlyStats($year)
    {
        $total = DB::table('visits')->whereYear('visit_date', $year)->count();
        $guests = DB::table('visits')->whereYear('visit_date', $year)->whereNull('user_id')->count();
        $users = DB::table('visits')->whereYear('visit_date', $year)->whereNotNull('user_id')->count();

        return [
            'total' => $total,
            'guests' => $guests,
            'users' => $users,
            'period_label' => "Tahun $year"
        ];
    }

    private function getYearlyChartData($year)
    {
        return DB::table('visits')
            ->select(DB::raw('MONTH(visit_date) as month, COUNT(*) as count'))
            ->whereYear('visit_date', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    private function getYearlyTableData($year)
    {
        return DB::table('visits')
            ->select(
                DB::raw('YEAR(visit_date) as year'),
                DB::raw('COUNT(*) as total'),
                DB::raw('COUNT(CASE WHEN user_id IS NULL THEN 1 END) as guests'),
                DB::raw('COUNT(CASE WHEN user_id IS NOT NULL THEN 1 END) as users')
            )
            ->groupBy('year')
            ->orderBy('year', 'desc')
            ->get();
    }
}
