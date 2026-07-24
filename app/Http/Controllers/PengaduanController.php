<?php

namespace App\Http\Controllers;

use App\Models\Pengaduan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengaduanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilan pengaduan untuk user
     */
    public function index()
    {
        $pengaduan = Pengaduan::where('user_id', Auth::id())->latest()->get();
        return view('pengaduan.index', compact('pengaduan'));
    }

    /**
     * Form untuk membuat pengaduan baru
     */
    public function create()
    {
        return view('pengaduan.create');
    }

    /**
     * Simpan pengaduan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'institusi' => 'required|string|max:255',
            'alamat_institusi' => 'required|string',
            'no_telp' => 'required|string|max:20',
            'masalah_pengaduan' => 'required|string'
        ]);

        Pengaduan::create([
            'user_id' => Auth::id(),
            'nama_lengkap' => $request->nama_lengkap,
            'institusi' => $request->institusi,
            'alamat_institusi' => $request->alamat_institusi,
            'no_telp' => $request->no_telp,
            'masalah_pengaduan' => $request->masalah_pengaduan,
            'status' => 'pending'
        ]);

        return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim!');
    }

    /**
     * Detail pengaduan untuk user
     */
    public function show($id)
    {
        $pengaduan = Pengaduan::where('id', $id)
                             ->where('user_id', Auth::id())
                             ->firstOrFail();
        return view('pengaduan.show', compact('pengaduan'));
    }

    /**
     * Dashboard admin untuk melihat semua pengaduan
     */
    public function adminIndex()
    {
        $pengaduan = Pengaduan::with('user')->latest()->get();
        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    /**
     * Detail pengaduan untuk admin
     */
    public function adminShow($id)
    {
        $pengaduan = Pengaduan::with('user')->findOrFail($id);
        return view('admin.pengaduan.show', compact('pengaduan'));
    }

    /**
     * Balas pengaduan oleh admin
     */
    public function adminReply(Request $request, $id)
    {
        $request->validate([
            'balasan_admin' => 'required|string'
        ]);

        $pengaduan = Pengaduan::findOrFail($id);
        $pengaduan->update([
            'balasan_admin' => $request->balasan_admin,
            'tanggal_balasan' => now(),
            'status' => 'dibalas'
        ]);

        return redirect()->route('admin.pengaduan.index')->with('success', 'Balasan berhasil dikirim!');
    }
}