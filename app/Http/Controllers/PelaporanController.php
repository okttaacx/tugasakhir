<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pelaporan;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PelaporanController extends Controller
{
    public function index()
    {
        $pelaporans = Pelaporan::latest()->paginate(10);
        return view('pelaporan', compact('pelaporans'));
    }

    public function create()
    {
        return view('pelaporan-admin');
    }

    public function show($id)
    {
        $pelaporan = Pelaporan::findOrFail($id);
        return view('pelaporan.show', compact('pelaporan'));
    }

    public function edit($id)
    {
        $pelaporan = Pelaporan::findOrFail($id);
        return view('pelaporan.edit', compact('pelaporan'));
    }

    public function update(Request $request, $id)
    {
        $pelaporan = Pelaporan::findOrFail($id);

        $validated = $request->validate([
            // A. KEADAAN PERUSAHAAN
            'NamaPengelola'             => 'required|string|max:255',
            'namaPerusahaan'            => 'required|string|max:255',
            'alamatPerusahaan'          => 'required|string|max:255',
            'noTelp'                    => 'required|string|max:50',
            'kodePos'                   => 'required|string|max:10',
            'jenisUsaha'                => 'required|string|max:255',
            'NamaPemilikPerusahaan'     => 'required|string|max:255',
            'AlamatPemilikPerusahaan'   => 'required|string|max:255',
            'PendirianPerusahaan'       => 'required|date',
            'PerpindahanPerusahaan'     => 'required|date',
            'statusPerusahaan'          => 'required|string',
            'Indonesia'                 => 'required|integer',
            'LuarIndonesia'             => 'required|integer',
            'statusKepemilikan'         => 'required|array',
            'statusPermodalan'          => 'required|array',
            'Pemodalan'                 => 'required|string',
            'AsalNegara'                => 'required|string|max:255',
            'pengurusPerusahaan'        => 'nullable|array',

            // B. KEADAAN KETENAGAKERJAAN
            'waktuKerjaPria'            => 'required|string', // Changed from array to string
            'JumlahTenagaKerjaLaki'     => 'required|integer|min:0',
            'JumlahTenagaKerjaPerempuan' => 'required|integer|min:0',
            'JumlahTenagaKerja'         => 'required|integer|min:0',
            'TenagaKerjaDisabilitasLaki' => 'required|integer|min:0',
            'TenagaKerjaDisabilitasPerempuan' => 'required|integer|min:0',
            'PekerjaAnakLaki'           => 'required|integer|min:0',
            'PekerjaAnakPerempuan'      => 'required|integer|min:0',
            'TenagaKerjaAsingLaki'      => 'required|integer|min:0',
            'TenagaKerjaAsingPerempuan' => 'required|integer|min:0',
            'PKWTLaki'                  => 'required|integer|min:0',
            'PKWTPerempuan'             => 'required|integer|min:0',
            'PKWTTLaki'                 => 'required|integer|min:0',
            'PKWTTPerempuan'            => 'required|integer|min:0',
            'PengupahanTertinggi'       => 'required|string',
            'PengupahanTerendah'        => 'required|string',
            'FasillitasKeselamatan'     => 'required|array',
            'FasilitasKesejahteraan'    => 'required|array',

            // BPJS dan Jaminan
            'BPJSKesehatanLaki'         => 'required|integer|min:0',
            'BPJSKesehatanPerempuan'    => 'required|integer|min:0',
            'ProgramJaminanKesehatan'   => 'required|string',
            'BPJSKetenagakerjaanLaki'   => 'required|integer|min:0',
            'BPJSKetenagakerjaanPerempuan' => 'required|integer|min:0',
            'JKKLaki'                   => 'required|integer|min:0',
            'JKKPerempuan'              => 'required|integer|min:0',
            'ProgramJKK'                => 'required|string',
            'JHTLaki'                   => 'required|integer|min:0',
            'JHTPerempuan'              => 'required|integer|min:0',
            'ProgramJHT'                => 'required|string',
            'JKMLaki'                   => 'required|integer|min:0',
            'JKMPerempuan'              => 'required|integer|min:0',
            'ProgramJKM'                => 'required|string',
            'JPLaki'                    => 'required|integer|min:0',
            'JPPerempuan'               => 'required|integer|min:0',
            'ProgramJP'                 => 'required|string',

            // Perangkat Hubungan Industrial
            'PerangkatHub'              => 'required|string',
            'PerangkatHubMemilikiTenagaKerja' => 'required|string',
            'PP'                        => 'required|in:Ada,Tidak',
            'PPDaftarDisnaker'          => 'nullable|in:Sudah,Belum',
            'PKB'                       => 'required|in:Ada,Tidak',
            'PKBDaftarDisnaker'         => 'nullable|in:Sudah,Belum',
            'LKSBipartit'               => 'required|in:Ada,Tidak',
            'LKSBipartitDaftarDisnaker' => 'nullable|in:Sudah,Belum',
            'SerikatPekerja'            => 'required|in:Ada,Tidak',
            'SerikatPekerjaDaftarDisnaker' => 'nullable|in:Sudah,Belum',
            'KoperasiPekerja'           => 'required|in:Ada,Tidak',
            'KoperasiTanggalBerdiri'    => 'nullable|date',
            'KoperasiAnggotaLaki'       => 'nullable|integer|min:0',
            'KoperasiAnggotaPerempuan'  => 'nullable|integer|min:0',

            'JumlahPenerimaan'          => 'required|integer',
            'JumlahBerhenti'            => 'required|integer',
            'ProgramPelatihan'          => 'required|string',
            'ProgramPemagangan'         => 'required|string',

            // D. TANGGAL LAPOR DAN KEWAJIBAN MELAPOR KEMBALI
            'NomorPelaporan'            => 'required|integer',
            'TanggalLapor'              => 'required|integer',
            'KewajibanLaporKembali'     => 'required|integer',
        ]);

        // Convert arrays to JSON for storage
        $validated['statusKepemilikan'] = json_encode($validated['statusKepemilikan']);
        $validated['statusPermodalan'] = json_encode($validated['statusPermodalan']);
        $validated['FasillitasKeselamatan'] = json_encode($validated['FasillitasKeselamatan']);
        $validated['FasilitasKesejahteraan'] = json_encode($validated['FasilitasKesejahteraan']);

        if (isset($validated['pengurusPerusahaan'])) {
            $validated['pengurusPerusahaan'] = json_encode($validated['pengurusPerusahaan']);
        }

        $pelaporan->update($validated);

        return redirect()->route('pelaporan.index')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pelaporan = Pelaporan::findOrFail($id);
        $pelaporan->delete();

        return redirect()->route('pelaporan.index')->with('success', 'Laporan berhasil dihapus.');
    }

    public function store(Request $request)
    {
        // Add debug logging
        \Log::info('Form data received:', $request->all());

        $validated = $request->validate([
            // A. KEADAAN PERUSAHAAN
            'NamaPengelola'             => 'required|string|max:255',
            'namaPerusahaan'            => 'required|string|max:255',
            'alamatPerusahaan'          => 'required|string|max:255',
            'noTelp'                    => 'required|string|max:50',
            'kodePos'                   => 'required|string|max:10',
            'jenisUsaha'                => 'required|string|max:255',
            'NamaPemilikPerusahaan'     => 'required|string|max:255',
            'AlamatPemilikPerusahaan'   => 'required|string|max:255',
            'PendirianPerusahaan'       => 'required|date',
            'PerpindahanPerusahaan'     => 'required|date',
            'statusPerusahaan'          => 'required|string',
            'Indonesia'                 => 'required|integer',
            'LuarIndonesia'             => 'required|integer',
            'statusKepemilikan'         => 'required|array',
            'statusPermodalan'          => 'required|array',
            'Pemodalan'                 => 'required|string',
            'AsalNegara'                => 'required|string|max:255',
            'pengurusPerusahaan'        => 'nullable|array',

            // B. KEADAAN KETENAGAKERJAAN - Fix waktuKerjaPria validation
            'waktuKerjaPria'            => 'required|string',
            'JumlahTenagaKerjaLaki'     => 'required|integer|min:0',
            'JumlahTenagaKerjaPerempuan' => 'required|integer|min:0',
            'JumlahTenagaKerja'         => 'required|integer|min:0',
            'TenagaKerjaDisabilitasLaki' => 'required|integer|min:0',
            'TenagaKerjaDisabilitasPerempuan' => 'required|integer|min:0',
            'PekerjaAnakLaki'           => 'required|integer|min:0',
            'PekerjaAnakPerempuan'      => 'required|integer|min:0',
            'TenagaKerjaAsingLaki'      => 'required|integer|min:0',
            'TenagaKerjaAsingPerempuan' => 'required|integer|min:0',
            'PKWTLaki'                  => 'required|integer|min:0',
            'PKWTPerempuan'             => 'required|integer|min:0',
            'PKWTTLaki'                 => 'required|integer|min:0',
            'PKWTTPerempuan'            => 'required|integer|min:0',
            'PengupahanTertinggi'       => 'required|string',
            'PengupahanTerendah'        => 'required|string',
            'FasillitasKeselamatan'     => 'required|array',
            'FasilitasKesejahteraan'    => 'required|array',

            // BPJS dan Jaminan
            'BPJSKesehatanLaki'         => 'required|integer|min:0',
            'BPJSKesehatanPerempuan'    => 'required|integer|min:0',
            'BPJSKetenagakerjaanLaki'   => 'required|integer|min:0',
            'BPJSKetenagakerjaanPerempuan' => 'required|integer|min:0',
            'JKKLaki'                   => 'required|integer|min:0',
            'JKKPerempuan'              => 'required|integer|min:0',
            'ProgramJKK'                => 'required|string',
            'JHTLaki'                   => 'required|integer|min:0',
            'JHTPerempuan'              => 'required|integer|min:0',
            'ProgramJHT'                => 'required|string',
            'JKMLaki'                   => 'required|integer|min:0',
            'JKMPerempuan'              => 'required|integer|min:0',
            'ProgramJKM'                => 'required|string',
            'JPLaki'                    => 'required|integer|min:0',
            'JPPerempuan'               => 'required|integer|min:0',
            'ProgramJP'                 => 'required|string',

            // Perangkat Hubungan Industrial
            'PerangkatHub'              => 'required|string',
            'PerangkatHubMemilikiTenagaKerja' => 'required|string',
            'PP'                        => 'required|in:Ada,Tidak',
            'PPDaftarDisnaker'          => 'nullable|in:Sudah,Belum',
            'PKB'                       => 'required|in:Ada,Tidak',
            'PKBDaftarDisnaker'         => 'nullable|in:Sudah,Belum',
            'LKSBipartit'               => 'required|in:Ada,Tidak',
            'LKSBipartitDaftarDisnaker' => 'nullable|in:Sudah,Belum',
            'SerikatPekerja'            => 'required|in:Ada,Tidak',
            'SerikatPekerjaDaftarDisnaker' => 'nullable|in:Sudah,Belum',
            'KoperasiPekerja'           => 'required|in:Ada,Tidak',
            'KoperasiTanggalBerdiri'    => 'nullable|date',
            'KoperasiAnggotaLaki'       => 'nullable|integer|min:0',
            'KoperasiAnggotaPerempuan'  => 'nullable|integer|min:0',

            'JumlahPenerimaan'          => 'required|integer',
            'JumlahBerhenti'            => 'required|integer',
            'ProgramPelatihan'          => 'required|string',
            'ProgramPemagangan'         => 'required|string',

            // D. TANGGAL LAPOR DAN KEWAJIBAN MELAPOR KEMBALI
            'NomorPelaporan'            => 'required|integer',
            'TanggalLapor'              => 'required|integer',
            'KewajibanLaporKembali'     => 'required|integer',
        ]);

        \Log::info('Validation passed', $validated);

        // Convert arrays to JSON for storage
        $validated['statusKepemilikan'] = json_encode($validated['statusKepemilikan']);
        $validated['statusPermodalan'] = json_encode($validated['statusPermodalan']);
        $validated['FasillitasKeselamatan'] = json_encode($validated['FasillitasKeselamatan']);
        $validated['FasilitasKesejahteraan'] = json_encode($validated['FasilitasKesejahteraan']);

        if (isset($validated['pengurusPerusahaan'])) {
            $validated['pengurusPerusahaan'] = json_encode($validated['pengurusPerusahaan']);
        }

        try {
            $pelaporan = Pelaporan::create($validated);
            \Log::info('Data saved successfully:', $pelaporan->toArray());

            return redirect()->back()->with('success', 'Laporan berhasil dikirim.');
        } catch (\Exception $e) {
            \Log::error('Error saving data: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    // ... rest of your export methods remain the same
    public function exportExcel()
    {
        $pelaporans = Pelaporan::all();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $headers = [
            'ID',
            'Nama Pengelola',
            'Nama Perusahaan',
            'Alamat Perusahaan',
            'No. Telepon',
            'Kode Pos',
            'Jenis Usaha',
            'Nama Pemilik',
            'Alamat Pemilik',
            'Tanggal Pendirian',
            'Tanggal Perpindahan',
            'Status Perusahaan',
            'TK Indonesia',
            'TK Luar Indonesia',
            'Status Kepemilikan',
            'Status Permodalan',
            'Pemodalan',
            'Asal Negara',
            'Pengurus Perusahaan',
            'Waktu Kerja Pria',
            'TK Laki-laki',
            'TK Perempuan',
            'Jumlah TK',
            'TK Disabilitas Laki',
            'TK Disabilitas Perempuan',
            'Pekerja Anak Laki',
            'Pekerja Anak Perempuan',
            'TK Asing Laki',
            'TK Asing Perempuan',
            'PKWT Laki',
            'PKWT Perempuan',
            'PKWTT Laki',
            'PKWTT Perempuan',
            'Pengupahan Max',
            'Pengupahan Min',
            'Fasilitas Keselamatan',
            'Fasilitas Kesejahteraan',
            'BPJS Kesehatan Laki',
            'BPJS Kesehatan Perempuan',
            'BPJS Kesehatan',
            'BPJS Ketenagakerjaan Laki',
            'BPJS Ketenagakerjaan Perempuan',
            'JKK Laki',
            'JKK Perempuan',
            'JKK',
            'JHT Laki',
            'JHT Perempuan',
            'JHT',
            'JKM Laki',
            'JKM Perempuan',
            'JKM',
            'JP Laki',
            'JP Perempuan',
            'JP',
            'Perangkat Hub',
            'Perangkat Hub TK',
            'PP',
            'PP Daftar Disnaker',
            'PKB',
            'PKB Daftar Disnaker',
            'LKS Bipartit',
            'LKS Bipartit Daftar Disnaker',
            'Serikat Pekerja',
            'Serikat Pekerja Daftar Disnaker',
            'Koperasi Pekerja',
            'Koperasi Tanggal Berdiri',
            'Koperasi Anggota Laki',
            'Koperasi Anggota Perempuan',
            'Jumlah Penerimaan',
            'Jumlah Berhenti',
            'Program Pelatihan',
            'Program Pemagangan',
            'No. Pelaporan',
            'Tanggal Lapor',
            'Kewajiban Lapor Kembali',
            'Tanggal Dibuat'
        ];

        // Set header row
        $column = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($column . '1', $header);
            $sheet->getStyle($column . '1')->getFont()->setBold(true);
            $column++;
        }

        // Fill data
        $row = 2;
        foreach ($pelaporans as $pelaporan) {
            $sheet->setCellValue('A' . $row, $pelaporan->id);
            $sheet->setCellValue('B' . $row, $pelaporan->NamaPengelola);
            $sheet->setCellValue('C' . $row, $pelaporan->namaPerusahaan);
            $sheet->setCellValue('D' . $row, $pelaporan->alamatPerusahaan);
            $sheet->setCellValue('E' . $row, $pelaporan->noTelp);
            $sheet->setCellValue('F' . $row, $pelaporan->kodePos);
            $sheet->setCellValue('G' . $row, $pelaporan->jenisUsaha);
            $sheet->setCellValue('H' . $row, $pelaporan->NamaPemilikPerusahaan);
            $sheet->setCellValue('I' . $row, $pelaporan->AlamatPemilikPerusahaan);
            $sheet->setCellValue('J' . $row, $pelaporan->PendirianPerusahaan);
            $sheet->setCellValue('K' . $row, $pelaporan->PerpindahanPerusahaan);
            $sheet->setCellValue('L' . $row, $pelaporan->statusPerusahaan);
            $sheet->setCellValue('M' . $row, $pelaporan->Indonesia);
            $sheet->setCellValue('N' . $row, $pelaporan->LuarIndonesia);
            $sheet->setCellValue('O' . $row, is_array($pelaporan->statusKepemilikan) ? implode(', ', $pelaporan->statusKepemilikan) : $pelaporan->statusKepemilikan);
            $sheet->setCellValue('P' . $row, is_array($pelaporan->statusPermodalan) ? implode(', ', $pelaporan->statusPermodalan) : $pelaporan->statusPermodalan);
            $sheet->setCellValue('Q' . $row, $pelaporan->Pemodalan);
            $sheet->setCellValue('R' . $row, $pelaporan->AsalNegara);
            $sheet->setCellValue('S' . $row, is_array($pelaporan->pengurusPerusahaan) ? implode(', ', $pelaporan->pengurusPerusahaan) : $pelaporan->pengurusPerusahaan);
            $sheet->setCellValue('T' . $row, $pelaporan->waktuKerjaPria);
            $sheet->setCellValue('U' . $row, $pelaporan->JumlahTenagaKerjaLaki);
            $sheet->setCellValue('V' . $row, $pelaporan->JumlahTenagaKerjaPerempuan);
            $sheet->setCellValue('W' . $row, $pelaporan->JumlahTenagaKerja);
            $sheet->setCellValue('X' . $row, $pelaporan->TenagaKerjaDisabilitasLaki);
            $sheet->setCellValue('Y' . $row, $pelaporan->TenagaKerjaDisabilitasPerempuan);
            $sheet->setCellValue('Z' . $row, $pelaporan->PekerjaAnakLaki);
            $sheet->setCellValue('AA' . $row, $pelaporan->PekerjaAnakPerempuan);
            $sheet->setCellValue('AB' . $row, $pelaporan->TenagaKerjaAsingLaki);
            $sheet->setCellValue('AC' . $row, $pelaporan->TenagaKerjaAsingPerempuan);
            $sheet->setCellValue('AD' . $row, $pelaporan->PKWTLaki);
            $sheet->setCellValue('AE' . $row, $pelaporan->PKWTPerempuan);
            $sheet->setCellValue('AF' . $row, $pelaporan->PKWTTLaki);
            $sheet->setCellValue('AG' . $row, $pelaporan->PKWTTPerempuan);
            $sheet->setCellValue('AH' . $row, $pelaporan->PengupahanTertinggi);
            $sheet->setCellValue('AI' . $row, $pelaporan->PengupahanTerendah);
            $sheet->setCellValue('AJ' . $row, is_array($pelaporan->FasillitasKeselamatan) ? implode(', ', $pelaporan->FasillitasKeselamatan) : $pelaporan->FasillitasKeselamatan);
            $sheet->setCellValue('AK' . $row, is_array($pelaporan->FasilitasKesejahteraan) ? implode(', ', $pelaporan->FasilitasKesejahteraan) : $pelaporan->FasilitasKesejahteraan);
            $sheet->setCellValue('AL' . $row, $pelaporan->BPJSKesehatanLaki);
            $sheet->setCellValue('AM' . $row, $pelaporan->BPJSKesehatanPerempuan);
            $sheet->setCellValue('AN' . $row, $pelaporan->ProgramJaminanKesehatan);
            $sheet->setCellValue('AO' . $row, $pelaporan->BPJSKetenagakerjaanLaki);
            $sheet->setCellValue('AP' . $row, $pelaporan->BPJSKetenagakerjaanPerempuan);
            $sheet->setCellValue('AQ' . $row, $pelaporan->JKKLaki);
            $sheet->setCellValue('AR' . $row, $pelaporan->JKKPerempuan);
            $sheet->setCellValue('AS' . $row, $pelaporan->ProgramJKK);
            $sheet->setCellValue('AT' . $row, $pelaporan->JHTLaki);
            $sheet->setCellValue('AU' . $row, $pelaporan->JHTPerempuan);
            $sheet->setCellValue('AV' . $row, $pelaporan->ProgramJHT);
            $sheet->setCellValue('AW' . $row, $pelaporan->JKMLaki);
            $sheet->setCellValue('AX' . $row, $pelaporan->JKMPerempuan);
            $sheet->setCellValue('AY' . $row, $pelaporan->ProgramJKM);
            $sheet->setCellValue('AZ' . $row, $pelaporan->JPLaki);
            $sheet->setCellValue('BA' . $row, $pelaporan->JPPerempuan);
            $sheet->setCellValue('BB' . $row, $pelaporan->ProgramJP);
            $sheet->setCellValue('BC' . $row, $pelaporan->PerangkatHub);
            $sheet->setCellValue('BD' . $row, $pelaporan->PerangkatHubMemilikiTenagaKerja);
            $sheet->setCellValue('BE' . $row, $pelaporan->PP);
            $sheet->setCellValue('BF' . $row, $pelaporan->PPDaftarDisnaker);
            $sheet->setCellValue('BG' . $row, $pelaporan->PKB);
            $sheet->setCellValue('BH' . $row, $pelaporan->PKBDaftarDisnaker);
            $sheet->setCellValue('BI' . $row, $pelaporan->LKSBipartit);
            $sheet->setCellValue('BJ' . $row, $pelaporan->LKSBipartitDaftarDisnaker);
            $sheet->setCellValue('BK' . $row, $pelaporan->SerikatPekerja);
            $sheet->setCellValue('BL' . $row, $pelaporan->SerikatPekerjaDaftarDisnaker);
            $sheet->setCellValue('BM' . $row, $pelaporan->KoperasiPekerja);
            $sheet->setCellValue('BN' . $row, $pelaporan->KoperasiTanggalBerdiri);
            $sheet->setCellValue('BO' . $row, $pelaporan->KoperasiAnggotaLaki);
            $sheet->setCellValue('BP' . $row, $pelaporan->KoperasiAnggotaPerempuan);
            $sheet->setCellValue('BQ' . $row, $pelaporan->JumlahPenerimaan);
            $sheet->setCellValue('BR' . $row, $pelaporan->JumlahBerhenti);
            $sheet->setCellValue('BS' . $row, $pelaporan->ProgramPelatihan);
            $sheet->setCellValue('BT' . $row, $pelaporan->ProgramPemagangan);
            $sheet->setCellValue('BU' . $row, $pelaporan->NomorPelaporan);
            $sheet->setCellValue('BV' . $row, $pelaporan->TanggalLapor);
            $sheet->setCellValue('BW' . $row, $pelaporan->KewajibanLaporKembali);
            $sheet->setCellValue('BX' . $row, $pelaporan->created_at->format('Y-m-d H:i:s'));
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'BX') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan-pelaporan-' . date('Y-m-d') . '.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    // Export filtered XLSX
    public function exportExcelFiltered(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Pelaporan::query();
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }

        $pelaporans = $query->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Headers for filtered export (simplified)
        $headers = [
            'ID',
            'Nama Pengelola',
            'Nama Perusahaan',
            'Alamat',
            'No. Telp',
            'TK Laki-laki',
            'TK Perempuan',
            'Jumlah TK',
            'TK Disabilitas Laki',
            'TK Disabilitas Perempuan',
            'TK Asing Laki',
            'TK Asing Perempuan',
            'PKWT Total',
            'PKWTT Total',
            'BPJS Kesehatan Total',
            'BPJS Ketenagakerjaan Total',
            'PP Status',
            'PKB Status',
            'Koperasi Status',
            'Tanggal Dibuat'
        ];

        $column = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($column . '1', $header);
            $sheet->getStyle($column . '1')->getFont()->setBold(true);
            $column++;
        }

        // Data
        $row = 2;
        foreach ($pelaporans as $pelaporan) {
            $sheet->setCellValue('A' . $row, $pelaporan->id);
            $sheet->setCellValue('B' . $row, $pelaporan->NamaPengelola);
            $sheet->setCellValue('C' . $row, $pelaporan->namaPerusahaan);
            $sheet->setCellValue('D' . $row, $pelaporan->alamatPerusahaan);
            $sheet->setCellValue('E' . $row, $pelaporan->noTelp);
            $sheet->setCellValue('F' . $row, $pelaporan->JumlahTenagaKerjaLaki);
            $sheet->setCellValue('G' . $row, $pelaporan->JumlahTenagaKerjaPerempuan);
            $sheet->setCellValue('H' . $row, $pelaporan->JumlahTenagaKerja);
            $sheet->setCellValue('I' . $row, $pelaporan->TenagaKerjaDisabilitasLaki);
            $sheet->setCellValue('J' . $row, $pelaporan->TenagaKerjaDisabilitasPerempuan);
            $sheet->setCellValue('K' . $row, $pelaporan->TenagaKerjaAsingLaki);
            $sheet->setCellValue('L' . $row, $pelaporan->TenagaKerjaAsingPerempuan);
            $sheet->setCellValue('M' . $row, $pelaporan->PKWTLaki + $pelaporan->PKWTPerempuan);
            $sheet->setCellValue('N' . $row, $pelaporan->PKWTTLaki + $pelaporan->PKWTTPerempuan);
            $sheet->setCellValue('O' . $row, $pelaporan->BPJSKesehatanLaki + $pelaporan->BPJSKesehatanPerempuan);
            $sheet->setCellValue('P' . $row, $pelaporan->BPJSKetenagakerjaanLaki + $pelaporan->BPJSKetenagakerjaanPerempuan);
            $sheet->setCellValue('Q' . $row, $pelaporan->PP);
            $sheet->setCellValue('R' . $row, $pelaporan->PKB);
            $sheet->setCellValue('S' . $row, $pelaporan->KoperasiPekerja);
            $sheet->setCellValue('T' . $row, $pelaporan->created_at->format('Y-m-d H:i:s'));
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'T') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        $writer = new Xlsx($spreadsheet);
        $filename = 'laporan-filtered-' . date('Y-m-d') . '.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
