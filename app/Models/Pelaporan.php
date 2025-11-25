<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelaporan extends Model
{
    use HasFactory;

    protected $fillable = [
        // A. KEADAAN PERUSAHAAN
        'NamaPengelola',
        'namaPerusahaan',
        'alamatPerusahaan',
        'noTelp',
        'kodePos',
        'jenisUsaha',
        'NamaPemilikPerusahaan',
        'AlamatPemilikPerusahaan',
        'PendirianPerusahaan',
        'PerpindahanPerusahaan',
        'statusPerusahaan',
        'Indonesia',
        'LuarIndonesia',
        'statusKepemilikan',
        'statusPermodalan',
        'Pemodalan',
        'AsalNegara',
        'pengurusPerusahaan',

        // B. KEADAAN KETENAGAKERJAAN
        'waktuKerjaPria',
        'JumlahTenagaKerjaLaki',
        'JumlahTenagaKerjaPerempuan',
        'JumlahTenagaKerja',
        'TenagaKerjaDisabilitasLaki',
        'TenagaKerjaDisabilitasPerempuan',
        'PekerjaAnakLaki',
        'PekerjaAnakPerempuan',
        'TenagaKerjaAsingLaki',
        'TenagaKerjaAsingPerempuan',
        'PKWTLaki',
        'PKWTPerempuan',
        'PKWTTLaki',
        'PKWTTPerempuan',
        'PengupahanTertinggi',
        'PengupahanTerendah',
        'FasillitasKeselamatan',
        'FasilitasKesejahteraan',

        // BPJS dan Jaminan
        'BPJSKesehatanLaki',
        'BPJSKesehatanPerempuan',
        'ProgramJaminanKesehatan',
        'BPJSKetenagakerjaanLaki',
        'BPJSKetenagakerjaanPerempuan',
        'JKKLaki',
        'JKKPerempuan',
        'ProgramJKK',
        'JHTLaki',
        'JHTPerempuan',
        'ProgramJHT',
        'JKMLaki',
        'JKMPerempuan',
        'ProgramJKM',
        'JPLaki',
        'JPPerempuan',
        'ProgramJP',

        // Perangkat Hubungan Industrial
        'PerangkatHub',
        'PerangkatHubMemilikiTenagaKerja',
        'PP',
        'PPDaftarDisnaker',
        'PKB',
        'PKBDaftarDisnaker',
        'LKSBipartit',
        'LKSBipartitDaftarDisnaker',
        'SerikatPekerja',
        'SerikatPekerjaDaftarDisnaker',
        'KoperasiPekerja',
        'KoperasiTanggalBerdiri',
        'KoperasiAnggotaLaki',
        'KoperasiAnggotaPerempuan',

        'JumlahPenerimaan',
        'JumlahBerhenti',
        'ProgramPelatihan',
        'ProgramPemagangan',

        // D. TANGGAL LAPOR DAN KEWAJIBAN MELAPOR KEMBALI
        'NomorPelaporan',
        'TanggalLapor',
        'KewajibanLaporKembali',
    ];

    protected $casts = [
        'statusKepemilikan'       => 'array',
        'statusPermodalan'        => 'array',
        'FasillitasKeselamatan'   => 'array',
        'FasilitasKesejahteraan'  => 'array',
        'pengurusPerusahaan'      => 'array',
        'PendirianPerusahaan'     => 'date',
        'PerpindahanPerusahaan'   => 'date',
        'KoperasiTanggalBerdiri'  => 'date',
    ];
}
