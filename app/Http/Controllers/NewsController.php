<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class NewsController extends Controller
{
    public function __construct()
    {
        // Middleware untuk admin routes
        $this->middleware(function ($request, $next) {
            if (!auth()->user() || !auth()->user()->hasAnyRole(['admin', 'super_admin'])) {
                abort(403, 'Unauthorized');
            }
            return $next($request);
        })->except(['publicIndex', 'publicShow']); // Kecualikan method public
    }

    // Method untuk tampilan admin (existing)
    public function index()
    {
        $news = News::with('author')
            ->orderBy('created_at', 'desc')
            ->paginate(12);

        return view('news.index', compact('news'));
    }

    // Method baru untuk tampilan user/public
    public function publicIndex()
    {
        // Ambil 5 berita terbaru untuk slideshow
        $slideshowNews = News::where('status', 'published')
            ->with('author')
            ->orderBy('published_at', 'desc')
            ->limit(5)
            ->get();

        // Ambil berita lainnya untuk card list (skip yang sudah di slideshow)
        $cardNews = News::where('status', 'published')
            ->with('author')
            ->orderBy('published_at', 'desc')
            ->skip(5)
            ->paginate(10);

        return view('news.public.index', compact('slideshowNews', 'cardNews'));
    }

    // Method untuk halaman baca berita lengkap
    public function publicShow($id)
    {
        $news = News::where('status', 'published')
            ->with('author')
            ->findOrFail($id);

        // Increment view count jika ada field views di database
        // $news->increment('views');

        return view('news.public.show', compact('news'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published'
        ]);

        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $request->file('thumbnail')->store('news/thumbnails', 'public');
        }

        $news = News::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'thumbnail' => $thumbnailPath,
            'status' => $validated['status'],
            'author_id' => auth()->id(),
            'published_at' => $validated['status'] === 'published' ? now() : null
        ]);

        return redirect()->route('news.index')->with('success', 'Berita berhasil dibuat!');
    }

    public function show(News $news)
    {
        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:draft,published'
        ]);

        if ($request->hasFile('thumbnail')) {
            // Hapus thumbnail lama
            if ($news->thumbnail) {
                Storage::disk('public')->delete($news->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('news/thumbnails', 'public');
        }

        $validated['published_at'] = $validated['status'] === 'published' ?
            ($news->published_at ?? now()) : null;

        $news->update($validated);

        return redirect()->route('news.show', $news)->with('success', 'Berita berhasil diupdate!');
    }

    public function destroy(News $news)
    {
        if ($news->thumbnail) {
            Storage::disk('public')->delete($news->thumbnail);
        }

        $news->delete();

        return redirect()->route('news.index')->with('success', 'Berita berhasil dihapus!');
    }
}
