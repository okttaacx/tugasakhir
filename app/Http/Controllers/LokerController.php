<?php

namespace App\Http\Controllers;

use App\Models\Loker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Exports\LokersExport;
use Maatwebsite\Excel\Facades\Excel;

class LokerController extends Controller
{
    // Admin Methods
    public function index(Request $request)
    {
        $query = Loker::query();
        
        // Filter berdasarkan periode
        if ($request->filled('period')) {
            $period = $request->period;
            $startDate = null;
            $endDate = Carbon::now();
            
            switch ($period) {
                case 'today':
                    $startDate = Carbon::today();
                    break;
                case 'week':
                    $startDate = Carbon::now()->startOfWeek();
                    break;
                case 'month':
                    $startDate = Carbon::now()->startOfMonth();
                    break;
                case 'year':
                    $startDate = Carbon::now()->startOfYear();
                    break;
                case 'custom':
                    if ($request->filled('start_date') && $request->filled('end_date')) {
                        $startDate = Carbon::parse($request->start_date);
                        $endDate = Carbon::parse($request->end_date)->endOfDay();
                    }
                    break;
            }
            
            if ($startDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
        }
        
        $lokers = $query->latest()->get();
        
        // Statistik
        $stats = [
            'total' => $lokers->count(),
            'published' => $lokers->where('is_published', 1)->count(),
            'draft' => $lokers->where('is_published', 0)->count(),
        ];
        
        return view('admin.lokers.index', compact('lokers', 'stats'));
    }

    public function create()
    {
        return view('admin.lokers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
            'is_published' => 'nullable'
        ]);

        $data = $request->only(['title', 'deskripsi']);
        $data['is_published'] = $request->has('is_published') ? 1 : 0;

        if ($request->hasFile('poster')) {
            $data['poster'] = $request->file('poster')->store('lokers', 'public');
        }

        Loker::create($data);

        return redirect()->route('admin.lokers.index')->with('success', 'Lowongan berhasil ditambahkan');
    }

    public function edit(Loker $loker)
    {
        return view('admin.lokers.edit', compact('loker'));
    }

    public function update(Request $request, Loker $loker)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'deskripsi' => 'nullable|string',
            'is_published' => 'nullable'
        ]);

        $data = $request->only(['title', 'deskripsi']);
        $data['is_published'] = $request->has('is_published') ? 1 : 0;

        if ($request->hasFile('poster')) {
            if ($loker->poster) {
                Storage::disk('public')->delete($loker->poster);
            }
            $data['poster'] = $request->file('poster')->store('lokers', 'public');
        }

        $loker->update($data);

        return redirect()->route('admin.lokers.index')->with('success', 'Lowongan berhasil diperbarui');
    }

    public function destroy(Loker $loker)
    {
        if ($loker->poster) {
            Storage::disk('public')->delete($loker->poster);
        }
        $loker->delete();

        return redirect()->route('admin.lokers.index')->with('success', 'Lowongan berhasil dihapus');
    }

    public function export(Request $request)
    {
        $period = $request->get('period', 'all');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');
        
        $export = new LokersExport($period, $startDate, $endDate);
        $spreadsheet = $export->export();
        
        $fileName = 'lowongan_' . $period . '_' . now()->format('Y-m-d') . '.xlsx';
        
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        
        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $fileName . '"');
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output');
        exit();
    }

    // User Methods
    public function publicIndex()
    {
        $lokers = Loker::published()->latest()->get();
        return view('lokers.index', compact('lokers'));
    }

    public function show(Loker $loker)
    {
        if (!$loker->is_published) {
            abort(404);
        }
        return view('lokers.show', compact('loker'));
    }
}