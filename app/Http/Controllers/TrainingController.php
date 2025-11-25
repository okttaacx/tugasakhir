<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\TrainingImage;
use App\Models\Registration;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainingController extends Controller
{
    // Menampilkan daftar pelatihan dengan pagination dan pencarian berdasarkan judul
    public function index(Request $request)
{
    $search = $request->input('search');

    $query = Training::with(['images']);

    if ($search) {
        $query->where('title', 'like', '%' . $search . '%');
    }

    $trainings = $query->paginate(9);

    return view('admin.trainings', compact('trainings', 'search'));
}

    // Menampilkan form tambah pelatihan
    public function create()
    {
        return view('admin.training-create');
    }

    // Menyimpan pelatihan baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'nullable|date',
            'end_time' => 'nullable',
            'capacity' => 'required|integer',
            'location' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Simpan data pelatihan baru
        $training = Training::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
            'capacity' => $request->capacity,
            'location' => $request->location,
        ]);

        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            $this->handleImageUploads($request->file('images'), $training->id);
        }

        return redirect()->route('admin.trainings.index')->with('success', 'Pelatihan berhasil ditambahkan.');
    }

    // Menampilkan form edit pelatihan
    public function edit($id)
    {
        $training = Training::with('images')->findOrFail($id);
        return view('admin.training-edit', compact('training'));
    }

    // Menyimpan perubahan pelatihan ke database
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'nullable|date',
            'end_time' => 'nullable',
            'capacity' => 'required|integer',
            'location' => 'required|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $training = Training::findOrFail($id);

        // Update data pelatihan
        $training->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'start_time' => $request->start_time,
            'end_date' => $request->end_date,
            'end_time' => $request->end_time,
            'capacity' => $request->capacity,
            'location' => $request->location,
        ]);

        // Handle new image uploads
        if ($request->hasFile('images')) {
            $this->handleImageUploads($request->file('images'), $training->id);
        }

        return redirect()->route('admin.trainings.index')->with('success', 'Pelatihan berhasil diperbarui.');
    }

    // Helper method untuk handle multiple image uploads
    private function handleImageUploads($images, $trainingId)
    {
        $isFirstImage = TrainingImage::where('training_id', $trainingId)->count() === 0;
        $sortOrder = TrainingImage::where('training_id', $trainingId)->max('sort_order') ?? 0;

        foreach ($images as $image) {
            $path = $image->store('training-images', 'public');
            
            TrainingImage::create([
                'training_id' => $trainingId,
                'image_path' => $path,
                'is_primary' => $isFirstImage, // Gambar pertama jadi primary
                'sort_order' => ++$sortOrder,
            ]);

            $isFirstImage = false; // Hanya gambar pertama yang jadi primary
        }
    }

    // Method untuk menghapus gambar individual
    public function deleteImage($imageId)
    {
        $image = TrainingImage::findOrFail($imageId);
        
        // Hapus file dari storage
        Storage::delete('public/' . $image->image_path);
        
        // Jika ini gambar primary dan masih ada gambar lain, set gambar lain sebagai primary
        if ($image->is_primary) {
            $nextImage = TrainingImage::where('training_id', $image->training_id)
                ->where('id', '!=', $image->id)
                ->orderBy('sort_order')
                ->first();
            
            if ($nextImage) {
                $nextImage->update(['is_primary' => true]);
            }
        }
        
        $image->delete();

        return response()->json(['success' => true]);
    }

    // Method untuk set gambar sebagai primary
    public function setPrimaryImage($imageId)
    {
        $image = TrainingImage::findOrFail($imageId);
        
        // Reset semua gambar dalam training ini menjadi bukan primary
        TrainingImage::where('training_id', $image->training_id)
            ->update(['is_primary' => false]);
        
        // Set gambar terpilih sebagai primary
        $image->update(['is_primary' => true]);

        return response()->json(['success' => true]);
    }

    // Menghapus pelatihan dari database
    public function destroy($id)
    {
        $training = Training::findOrFail($id);

        // Hapus semua gambar terkait
        foreach ($training->images as $image) {
            Storage::delete('public/' . $image->image_path);
        }
        $training->images()->delete();

        // Hapus gambar lama jika ada
        if ($training->image) {
            Storage::delete('public/' . $training->image);
        }

        $training->delete();

        return redirect()->route('admin.trainings.index')->with('success', 'Pelatihan berhasil dihapus.');
    }

    // Method lainnya tetap sama...
    public function showParticipants($id, Request $request)
    {
        $training = Training::findOrFail($id);

        $query = User::with('profile')
            ->whereHas('registrations', function ($q) use ($id) {
                $q->where('training_id', $id);
            });

        if ($request->filled('universal_search')) {
            $search = $request->input('universal_search');
            $query->where(function ($q) use ($search) {
                $q->where('email', 'like', '%' . $search . '%')
                    ->orWhereHas('profile', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        $participants = $query->get();

        return view('admin.training-participants', compact('training', 'participants'));
    }

    // public function exportParticipants($id)
    // {
    //     $training = Training::findOrFail($id);
    //     $participants = User::with('profile')
    //         ->whereHas('registrations', function ($q) use ($id) {
    //             $q->where('training_id', $id);
    //         })
    //         ->get();

    //     $fileName = 'participants_training_' . $training->id . '.csv';
    //     $headers = [
    //         "Content-Type" => "text/csv",
    //         "Content-Disposition" => "attachment; filename=$fileName",
    //     ];

    //     $callback = function () use ($participants) {
    //         $file = fopen('php://output', 'w');
    //         fputcsv($file, ['Name', 'Email', 'NIK', 'TTL', 'Gender', 'Desa', 'Kecamatan', 'No. Telepon']);
    //         foreach ($participants as $participant) {
    //             fputcsv($file, [
    //                 $participant->profile->name ?? 'N/A',
    //                 $participant->email,
    //                 $participant->profile->nik ?? 'N/A',
    //                 $participant->profile->ttl ?? 'N/A',
    //                 $participant->profile->gender ?? 'N/A',
    //                 $participant->profile->desa ?? 'N/A',
    //                 $participant->profile->kecamatan ?? 'N/A',
    //                 $participant->profile->nomor ?? 'N/A',
    //             ]);
    //         }
    //         fclose($file);
    //     };

    //     return response()->stream($callback, 200, $headers);
    // }

    public function preview($trainingId)
    {
        $profile = auth()->user()->profile;
        $document = Document::where('user_id', auth()->id())->first();
        $training = Training::with('images')->findOrFail($trainingId);

        $isProfileComplete = $profile && 
                            !empty($profile->name) && 
                            !empty($profile->nik) && 
                            !empty($profile->ttl) && 
                            !empty($profile->gender) && 
                            !empty($profile->jalan) && 
                            !empty($profile->desa) && 
                            !empty($profile->kecamatan) && 
                            !empty($profile->pendidikan) && 
                            !empty($profile->nomor);

        $isDocumentComplete = $document && 
                             !empty($document->ktp) && 
                             !empty($document->kk) && 
                             !empty($document->ijazah) && 
                             !empty($document->ak1);

        $isDocumentConfirmed = $document && 
                              $document->ktp_status == 'confirmed' && 
                              $document->kk_status == 'confirmed' && 
                              $document->ijazah_status == 'confirmed' && 
                              $document->ak1_status == 'confirmed';

        return view('trainings.preview', compact(
            'profile', 
            'document', 
            'training', 
            'isProfileComplete', 
            'isDocumentComplete', 
            'isDocumentConfirmed'
        ));
    }

    public function register(Request $request, $trainingId)
    {
        $userId = auth()->id();

        $countRegistrations = Registration::where('user_id', $userId)->count();

        if ($countRegistrations >= 2) {
            return redirect()->back()->with('error', 'Anda hanya bisa mendaftar maksimal 2 pelatihan.');
        }

        $isRegistered = Registration::where('user_id', $userId)
            ->where('training_id', $trainingId)
            ->exists();

        if ($isRegistered) {
            return redirect()->back()->with('error', 'Anda sudah terdaftar dalam pelatihan ini.');
        }

        Registration::create([
            'user_id' => $userId,
            'training_id' => $trainingId,
            'status' => 'pending',
        ]);

        return redirect()->back()->with('success', 'Anda berhasil mendaftar ke pelatihan.');
    }

    public function userIndex(Request $request)
    {
        $search = $request->input('search');

        $query = Training::with(['primaryImage', 'images']);

        if ($search) {
            $query->where('title', 'like', '%' . $search . '%');
        }

        $trainings = $query->paginate(9);

        return view('user.trainings', compact('trainings', 'search'));
    }

    public function show($id)
    {
        $training = Training::with('images')->findOrFail($id);

        $isRegistered = false;
        if (auth()->check()) {
            $isRegistered = Registration::where('user_id', auth()->id())
                ->where('training_id', $id)
                ->exists();
        }

        return view('user.training-detail', compact('training', 'isRegistered'));
    }

    public function exportParticipants($id, Request $request)
{
    $training = Training::findOrFail($id);
    
    // Build query with search filter
    $query = User::with('profile')
        ->whereHas('registrations', function ($q) use ($id) {
            $q->where('training_id', $id);
        });

    // Apply search filter if exists
    if ($request->filled('universal_search')) {
        $search = $request->input('universal_search');
        $query->where(function ($q) use ($search) {
            $q->where('email', 'like', '%' . $search . '%')
                ->orWhereHas('profile', function ($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                });
        });
    }

    $participants = $query->get();

    $fileName = 'participants_training_' . $training->id . '_' . date('Y-m-d_H-i-s') . '.csv';
    
    $headers = [
        "Content-Type" => "text/csv",
        "Content-Disposition" => "attachment; filename=$fileName",
        "Pragma" => "no-cache",
        "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
        "Expires" => "0"
    ];

    $callback = function () use ($participants) {
        $file = fopen('php://output', 'w');
        
        // Add BOM for UTF-8 Excel compatibility
        fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));
        
        // CSV Headers
        fputcsv($file, [
            'Nama', 
            'Email', 
            'NIK', 
            'TTL', 
            'Umur', 
            'Gender', 
            'Jalan', 
            'Desa', 
            'Kecamatan', 
            'Pendidikan', 
            'No. Telepon'
        ]);

        foreach ($participants as $participant) {
            // Calculate age
            $age = 'N/A';
            if ($participant->profile && $participant->profile->ttl) {
                try {
                    $birthday = new \DateTime($participant->profile->ttl);
                    $today = new \DateTime();
                    $age = $today->diff($birthday)->y . ' tahun';
                } catch (\Exception $e) {
                    $age = 'N/A';
                }
            }

            fputcsv($file, [
                $participant->profile->name ?? 'N/A',
                $participant->email,
                $participant->profile->nik ?? 'N/A', // Full NIK for export
                $participant->profile->ttl ?? 'N/A',
                $age,
                $participant->profile->gender ?? 'N/A',
                $participant->profile->jalan ?? 'N/A',
                $participant->profile->desa ?? 'N/A',
                $participant->profile->kecamatan ?? 'N/A',
                $participant->profile->pendidikan ?? 'N/A',
                $participant->profile->nomor ?? 'N/A',
            ]);
        }
        fclose($file);
    };

    return response()->stream($callback, 200, $headers);
}
}