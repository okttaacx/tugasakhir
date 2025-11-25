<?php

namespace App\Exports;

use App\Models\Pelaporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class PelaporanExport implements FromCollection, WithHeadings, WithMapping, WithStyles, ShouldAutoSize
{
    public function collection()
    {
        return Pelaporan::all();
    }

    public function headings(): array
    {
        return [
            // Judul kolom
            'Nama Pengelola',
            'Nama Perusahaan',
            'Alamat Perusahaan',
            'No. Telepon',
            'Kode Pos',
            'Jenis Usaha',
            'Nama Pemilik Perusahaan',
            'Alamat Pemilik Perusahaan',
            'Tanggal Pendirian',
            'Tanggal Perpindahan',
            'Status Perusahaan',
            'Indonesia (%)',
            'Luar Indonesia (%)',
            'Status Kepemilikan',
            'Status Permodalan',
            'Pemodalan',
            'Asal Negara',
            'Waktu Kerja Pria',

            'Jumlah Tenaga Kerja',
            'Pengupahan Tertinggi',
            'Pengupahan Terendah',
            'Fasilitas Keselamatan',
            'Fasilitas Kesejahteraan',
            'Program Jaminan Kesehatan',
            'Program JKK',
            'Program JHT',
            'Program JKM',
            'Program JP',

            'Perangkat Hubungan Industrial',
            'PHI Memiliki Tenaga Kerja',
            'Jumlah Penerimaan',
            'Jumlah Berhenti',
            'Program Pelatihan',
            'Program Pemagangan',

            'Nomor Pelaporan',
            'Tanggal Lapor',
            'Kewajiban Lapor Kembali',

            'Pengurus Perusahaan',
            'TK Laki',
            'TK Perempuan',
            'TK Disabilitas Laki',
            'TK Disabilitas Perempuan',
            'Pekerja Anak Laki',
            'Pekerja Anak Perempuan',
            'TKA Laki',
            'TKA Perempuan',
            'PKWT Laki',
            'PKWT Perempuan',
            'PKWTT Laki',
            'PKWTT Perempuan',
            'BPJS Kesehatan Laki',
            'BPJS Kesehatan Perempuan',
            'BPJS Ketenagakerjaan Laki',
            'BPJS Ketenagakerjaan Perempuan',
            'JKK Laki',
            'JKK Perempuan',
            'JHT Laki',
            'JHT Perempuan',
            'JKM Laki',
            'JKM Perempuan',
            'JP Laki',
            'JP Perempuan',
            'PP Ada',
            'PP Status Daftar',
            'PKB Ada',
            'PKB Status Daftar',
            'LKS Ada',
            'LKS Status Daftar',
            'Serikat Ada',
            'Serikat Status Daftar',
            'Koperasi Ada',
            'Koperasi Tanggal Berdiri',
            'Koperasi Anggota Laki',
            'Koperasi Anggota Perempuan',
        ];
    }

    public function map($row): array
    {
        return [
            $row->NamaPengelola,
            $row->namaPerusahaan,
            $row->alamatPerusahaan,
            $row->noTelp,
            $row->kodePos,
            $row->jenisUsaha,
            $row->NamaPemilikPerusahaan,
            $row->AlamatPemilikPerusahaan,
            $row->PendirianPerusahaan,
            $row->PerpindahanPerusahaan,
            $row->statusPerusahaan,
            $row->Indonesia,
            $row->LuarIndonesia,
            is_array($row->statusKepemilikan) ? implode(', ', $row->statusKepemilikan) : $row->statusKepemilikan,
            is_array($row->statusPermodalan) ? implode(', ', $row->statusPermodalan) : $row->statusPermodalan,
            $row->Pemodalan,
            $row->AsalNegara,
            is_array($row->waktuKerjaPria) ? implode(', ', $row->waktuKerjaPria) : $row->waktuKerjaPria,

            $row->JumlahTenagaKerja,
            $row->PengupahanTertinggi,
            $row->PengupahanTerendah,
            is_array($row->FasillitasKeselamatan) ? implode(', ', $row->FasillitasKeselamatan) : $row->FasillitasKeselamatan,
            is_array($row->FasilitasKesejahteraan) ? implode(', ', $row->FasilitasKesejahteraan) : $row->FasilitasKesejahteraan,
            $row->ProgramJaminanKesehatan,
            $row->ProgramJKK,
            $row->ProgramJHT,
            $row->ProgramJKM,
            $row->ProgramJP,

            $row->PerangkatHub,
            $row->PerangkatHubMemilikiTenagaKerja,
            $row->JumlahPenerimaan,
            $row->JumlahBerhenti,
            $row->ProgramPelatihan,
            $row->ProgramPemagangan,

            $row->NomorPelaporan,
            $row->TanggalLapor,
            $row->KewajibanLaporKembali,

            $row->PengurusPerusahaan,
            $row->TK_Laki,
            $row->TK_Perempuan,
            $row->TKDisabilitas_Laki,
            $row->TKDisabilitas_Perempuan,
            $row->PekerjaAnak_Laki,
            $row->PekerjaAnak_Perempuan,
            $row->TenagaKerjaAsing_Laki,
            $row->TenagaKerjaAsing_Perempuan,
            $row->PKWT_Laki,
            $row->PKWT_Perempuan,
            $row->PKWTT_Laki,
            $row->PKWTT_Perempuan,
            $row->BPJSKesehatan_Laki,
            $row->BPJSKesehatan_Perempuan,
            $row->BPJSKetenagakerjaan_Laki,
            $row->BPJSKetenagakerjaan_Perempuan,
            $row->JKK_Laki,
            $row->JKK_Perempuan,
            $row->JHT_Laki,
            $row->JHT_Perempuan,
            $row->JKM_Laki,
            $row->JKM_Perempuan,
            $row->JP_Laki,
            $row->JP_Perempuan,
            $row->PP_Ada,
            $row->PP_StatusDaftar,
            $row->PKB_Ada,
            $row->PKB_StatusDaftar,
            $row->LKS_Ada,
            $row->LKS_StatusDaftar,
            $row->Serikat_Ada,
            $row->Serikat_StatusDaftar,
            $row->Koperasi_Ada,
            $row->Koperasi_TanggalBerdiri,
            $row->Koperasi_Anggota_Laki,
            $row->Koperasi_Anggota_Perempuan,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Judul
        $sheet->mergeCells('A1:BV1');
        $sheet->setCellValue('A1', 'LAPORAN PELAPORAN PERUSAHAAN');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Header tabel
        $sheet->getStyle('A2:BV2')->getFont()->setBold(true);
        $sheet->getStyle('A2:BV2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle('A2:BV2')->getFill()->setFillType(Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FFD9D9D9');

        // Border semua sel
        $lastRow = $sheet->getHighestRow();
        $lastColumn = $sheet->getHighestColumn();
        $sheet->getStyle("A1:{$lastColumn}{$lastRow}")
            ->getBorders()->getAllBorders()
            ->setBorderStyle(Border::BORDER_THIN);

        return [];
    }
}
