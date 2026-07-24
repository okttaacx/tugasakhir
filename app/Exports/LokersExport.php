<?php

namespace App\Exports;

use App\Models\Loker;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Carbon\Carbon;

class LokersExport
{
    protected $period;
    protected $startDate;
    protected $endDate;

    public function __construct($period = 'all', $startDate = null, $endDate = null)
    {
        $this->period = $period;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set title
        $sheet->setCellValue('A1', 'LAPORAN LOWONGAN PEKERJAAN');
        $sheet->mergeCells('A1:F1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set headers
        $headers = [
            'ID', 'Judul Lowongan', 'Deskripsi', 'Status', 'Tanggal Dibuat', 'Tanggal Diperbarui'
        ];
        
        $column = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($column . '2', $header);
            $column++;
        }

        // Style headers
        $sheet->getStyle('A2:F2')->getFont()->setBold(true);
        $sheet->getStyle('A2:F2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:F2')->getFill()->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFD9D9D9');

        // Get data
        $lokers = $this->getData();
        $row = 3;

        foreach ($lokers as $loker) {
            $sheet->setCellValue('A' . $row, $loker->id);
            $sheet->setCellValue('B' . $row, $loker->title);
            $sheet->setCellValue('C' . $row, strip_tags($loker->deskripsi));
            $sheet->setCellValue('D' . $row, $loker->is_published ? 'Published' : 'Draft');
            $sheet->setCellValue('E' . $row, $loker->created_at->format('d/m/Y H:i'));
            $sheet->setCellValue('F' . $row, $loker->updated_at->format('d/m/Y H:i'));
            $row++;
        }

        // Add borders
        $lastRow = $row - 1;
        $sheet->getStyle("A1:F{$lastRow}")
            ->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        // Auto size columns
        foreach (range('A', 'F') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return $spreadsheet;
    }

    private function getData()
    {
        $query = Loker::query();

        if ($this->period !== 'all') {
            $startDate = null;
            $endDate = Carbon::now();

            switch ($this->period) {
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
                    if ($this->startDate && $this->endDate) {
                        $startDate = Carbon::parse($this->startDate);
                        $endDate = Carbon::parse($this->endDate)->endOfDay();
                    }
                    break;
            }

            if ($startDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }
        }

        return $query->latest()->get();
    }
}