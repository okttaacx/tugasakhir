<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    // Method untuk menampilkan halaman home dengan data pelatihan
    public function index()
    {
        // Ambil semua data pelatihan dari database dengan relasi images
        $trainings = Training::with(['images', 'primaryImage'])->get();

        // TAMBAHAN: Hitung kunjungan hari ini dan kemarin
        $visitorsToday = DB::table('visits')->whereDate('created_at', today())->count();
        $visitorsYesterday = DB::table('visits')->whereDate('created_at', Carbon::yesterday())->count();

        // PERBAIKAN: Hitung total program pelatihan dari database
        $totalTrainings = Training::count();

        // Ambil berita terbaru untuk slideshow
        $latestNews = \App\Models\News::where('status', 'published')
            ->with('author')
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get();

        // Ambil pelatihan terbaru untuk slideshow dengan relasi images
        $latestTrainings = Training::with(['images', 'primaryImage'])
            ->orderBy('start_date', 'desc')
            ->limit(3)
            ->get();

        // Gabungkan dan selang-seling news dan training untuk slideshow
        $slideshowItems = $this->createAlternatingSlideshow($latestNews, $latestTrainings);

        // Ambil berita lainnya untuk card list (skip yang sudah di slideshow)
        $cardNews = \App\Models\News::where('status', 'published')
            ->with('author')
            ->orderBy('published_at', 'desc')
            ->skip(3)
            ->paginate(10);

        // PERBAIKAN: Ambil pelatihan untuk cards (skip yang sudah di slideshow) dengan relasi images
        $cardTrainings = Training::with(['images', 'primaryImage'])
            ->orderBy('start_date', 'desc')
            ->skip(3) // Skip 3 yang sudah digunakan di slideshow
            ->paginate(10);

        // Kirim data pelatihan ke view home dengan totalTrainings
        return view('home', compact('trainings', 'visitorsToday', 'visitorsYesterday', 'slideshowItems', 'cardNews', 'cardTrainings', 'totalTrainings'));
    }

    /**
     * Method untuk membuat slideshow yang selang-seling antara news dan training
     * Updated untuk mendukung multiple images dengan primary image
     */
    private function createAlternatingSlideshow($news, $trainings)
    {
        $slideshow = [];
        $newsIndex = 0;
        $trainingIndex = 0;
        $maxItems = 6; // Maksimal 6 item di slideshow

        for ($i = 0; $i < $maxItems; $i++) {
            if ($i % 2 == 0) {
                // Index genap: tampilkan news
                if ($newsIndex < $news->count()) {
                    $slideshow[] = [
                        'type' => 'news',
                        'data' => $news[$newsIndex],
                        'title' => $news[$newsIndex]->title,
                        'description' => strip_tags($news[$newsIndex]->content),
                        'image' => $news[$newsIndex]->thumbnail,
                        'date' => $news[$newsIndex]->published_at,
                        'author' => $news[$newsIndex]->author->name ?? 'Admin',
                        'url' => route('news.public.show', $news[$newsIndex]->id),
                        'badge' => 'Berita Terbaru'
                    ];
                    $newsIndex++;
                }
            } else {
                // Index ganjil: tampilkan training
                if ($trainingIndex < $trainings->count()) {
                    $training = $trainings[$trainingIndex];
                    
                    // Ambil gambar primary menggunakan accessor
                    $trainingImage = $training->primary_image;
                    
                    $slideshow[] = [
                        'type' => 'training',
                        'data' => $training,
                        'title' => $training->title,
                        'description' => $training->description,
                        'image' => $trainingImage,
                        'date' => $training->start_date,
                        'author' => 'Dinas Tenaga Kerja',
                        'url' => route('pelatihan.preview', $training->id),
                        'badge' => 'Program Pelatihan'
                    ];
                    $trainingIndex++;
                }
            }
        }

        return collect($slideshow);
    }

    // Method untuk menampilkan halaman review profil user
    public function showProfilePreview()
    {
        $user = Auth::user();
        $profile = Profile::where('user_id', $user->id)->first();

        if (!$profile) {
            return redirect()->route('profile')->with('error', 'Profil belum lengkap. Silakan lengkapi profil terlebih dahulu.');
        }

        return view('trainings.preview', compact('profile'));
    }

    // Method untuk mendaftarkan user ke pelatihan
    public function registerCourse(Request $request)
    {
        // Logic untuk mendaftarkan user ke pelatihan di sini
        // Misal tambahkan data user ke tabel pendaftaran pelatihan, dsb.

        return redirect()->route('home')->with('success', 'Anda berhasil mendaftar ke pelatihan.');
    }

    public function about()
    {
        return view('about');
    }
}