<?php

namespace App\Http\Controllers;

use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\LokerController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    ProfileController,
    AdminController,
    ParticipantController,
    TrainingController,
    CourseController,
    HomeController
};
use App\Models\Visit;
use Illuminate\Support\Facades\Auth;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'showLogin')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegister')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->middleware('auth')->name('logout');
});

Route::middleware('auth')->prefix('profile')->name('profile.')->controller(ProfileController::class)->group(function () {
    Route::get('/', 'profile')->name('index');
    Route::get('/documents', 'showDocuments')->name('documents');
    Route::get('/change-password', 'showChangePassword')->name('change-password');
    Route::put('/update-password', 'updatePassword')->name('update-password');
    Route::get('/preview', 'preview')->name('preview');
    Route::put('/update', 'updateProfile')->name('update');
    Route::post('/store', 'storeProfile')->name('store');
    Route::post('/storeOrUpdate', 'storeOrUpdateProfile')->name('storeOrUpdate');
    Route::post('/documents/storeOrUpdate', 'storeOrUpdateDocuments')->name('documents.storeOrUpdate');
    Route::get('/{user}', 'show')->name('show');
});

Route::post('/admin/account-participants', [AuthController::class, 'store'])->middleware(['auth', 'role:super_admin'])->name('admin.account.store');
Route::middleware(['auth', 'role:super_admin|admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/remove-participant/{userId}', [AdminController::class, 'showRemovalForm'])->name('removeParticipantForm');
    Route::post('/remove-participant/{userId}', [AdminController::class, 'removeParticipant'])->name('removeParticipant');
    Route::patch('/participant/{id}/change-role', [AdminController::class, 'changeRole'])->name('change_role');
    Route::get('/account-participants', [AdminController::class, 'accountParticipants'])->name('account_participants');
    Route::get('/pelaporan_admin', [AdminController::class, 'indexPelaporan'])->name('pelaporan');
    Route::post('/verify-removal/{id}', [AdminController::class, 'verifyRemoval'])->name('verifyRemoval');

    Route::get('/withdrawals', [AdminController::class, 'withdrawalRequests'])->name('withdrawals');
    Route::post('/withdrawals/{id}/verify', [AdminController::class, 'verifyWithdrawal'])->name('withdrawals.verify');
    Route::post('/withdrawals/{id}/reject', [AdminController::class, 'rejectWithdrawal'])->name('withdrawals.reject');

    Route::get('/admin/complaints', [ComplaintController::class, 'admin'])->name('complaints');
    Route::get('/complaints/{id}/show', [ComplaintController::class, 'show'])->name('complaints.show');
    Route::post('/complaints/{id}/answer', [ComplaintController::class, 'answer'])->name('complaints.answer');
    Route::delete('/complaints/{id}/destroy', [ComplaintController::class, 'destroy'])->name('complaints.destroy');

    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/{filename}/{category}', [DocumentController::class, 'showFile'])->name('documents.show');
    Route::patch('/documents/{document}/update-status', [DocumentController::class, 'updateStatusAjax'])->name('documents.updateStatus');
    Route::patch('/documents/{id}/message', [DocumentController::class, 'message'])->name('documents.message');

    // Training management routes
    Route::get('/trainings', [TrainingController::class, 'index'])->name('trainings.index');
    Route::get('/trainings/create', [TrainingController::class, 'create'])->name('trainings.create');
    Route::post('/trainings', [TrainingController::class, 'store'])->name('trainings.store');
    Route::get('/trainings/{id}/edit', [TrainingController::class, 'edit'])->name('trainings.edit');
    Route::put('/trainings/{id}', [TrainingController::class, 'update'])->name('trainings.update');
    Route::delete('/trainings/{id}', [TrainingController::class, 'destroy'])->name('trainings.destroy');
    Route::get('/trainings/{id}/participants', [TrainingController::class, 'showParticipants'])->name('trainings.participants');
    Route::get('/trainings/{id}/export', [TrainingController::class, 'exportParticipants'])->name('trainings.export');
    
    // Routes untuk mengelola gambar individual
    Route::delete('/trainings/images/{image}/delete', [TrainingController::class, 'deleteImage'])->name('trainings.images.delete');
    Route::post('/trainings/images/{image}/set-primary', [TrainingController::class, 'setPrimaryImage'])->name('trainings.images.set-primary');
    
});

Route::middleware(['auth', 'role:user'])->get('/user/dashboard', fn() => view('user.dashboard'))->name('user.dashboard');

Route::resource('trainings', TrainingController::class);
Route::middleware('auth')->group(function () {
    Route::get('/trainings/{id}/register', [TrainingController::class, 'register'])->name('trainings.register');
    Route::post('/trainings/{id}/process', [TrainingController::class, 'processRegistration'])->name('trainings.process');
    
    Route::post('/profile/training/withdraw/{trainingId}', [ProfileController::class, 'withdraw'])->name('training.withdraw');
    Route::get('/training-participants', [TrainingController::class, 'showTrainingParticipants'])->name('training.participants');
});

// Routes untuk USER - melihat dan mendaftar pelatihan
Route::middleware('auth')->group(function () {
    Route::get('/trainings', [TrainingController::class, 'userIndex'])->name('trainings.user.index'); // halaman training untuk user
    Route::get('/trainings/{id}', [TrainingController::class, 'show'])->name('trainings.show'); // detail training
    Route::get('/trainings/{id}/register', [TrainingController::class, 'register'])->name('trainings.register');
    Route::post('/trainings/{id}/process', [TrainingController::class, 'processRegistration'])->name('trainings.process');
    Route::post('/profile/training/withdraw/{trainingId}', [ProfileController::class, 'withdraw'])->name('training.withdraw');
});

Route::controller(CourseController::class)->group(function () {
    Route::get('/courses', 'index')->name('courses.index');
    Route::post('/course/register', 'register')->name('course.register');
});

$courseNames = ['barista', 'barbershop', 'digital', 'fotografi', 'grafis', 'jaringan', 'kue', 'membatik', 'menjahit', 'service'];
foreach ($courseNames as $course) {
    Route::view("/courses/$course", "courses.details.$course")->name("courses.$course");
}

Route::middleware(['auth', 'role:super_admin|admin'])->prefix('admin/participants')->name('admin.participant.')->controller(ParticipantController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{id}', 'show')->name('show');
    Route::post('/document/confirm/{id}', 'confirmDocument')->name('document.confirm');
    Route::post('/document/{id}/{type}/revision', 'markAsRevision')->name('document.revision');
    Route::post('/{id}/send-revision', 'sendRevision')->name('sendRevision');
    Route::get('/export', 'export')->name('export');
    Route::post('/document/reject/{id}/{type}', 'rejectDocument')->name('document.reject');
    Route::get('/{user_id}/confirm-delete', 'confirmDelete')->name('confirmDelete');
    Route::post('/participants/{user_id}/delete', 'deleteParticipant')->name('delete');
    Route::get('/participant/{id}', 'show')->name('participant.show');
    Route::delete('/participant/{id}/delete', 'destroy')->name('participant.destroy');
    Route::get('/view-document/{userId}/{category}', 'viewDocument')->name('view.document');
    Route::get('/participants/export-xlsx', 'exportXlsx')->name('export.xlsx');
});

// Route::middleware('auth')->prefix('pelatihan')->name('pelatihan.')->controller(TrainingController::class)->group(function () {
//     Route::get('/{id}/preview',  'preview')->name('preview');
//     Route::post('/{id}/daftar',  'register')->name('register');
//     Route::get('/check-completion', 'checkProfileCompletion')->name('checkCompletion');
// });

Route::get('/complaints', [ComplaintController::class, 'index'])->name('complaints.index');
Route::get('/complaints/{id}', [ComplaintController::class, 'show'])->name('complaints.show');
Route::middleware(['auth'])->name('complaints.')->controller(ComplaintController::class)->group(function () {
    Route::post('/complaints',  'store')->name('store');
    Route::post('/complaints/{id}/like', 'like')->name('like');
});

Route::get('/pelaporan', [PelaporanController::class, 'index'])->name('pelaporan');
Route::get('/pelaporan/Create', [PelaporanController::class, 'create'])->name('pelaporan.create');
Route::post('/pelaporan', [PelaporanController::class, 'store'])->name('pelaporan.store');
Route::get('/export-excel', [PelaporanController::class, 'exportExcel']);

Route::get('/instagram-url', function () {
    return 'https://www.instagram.com/disnaker_kotabatu?igsh=MXVoOGFuNW4zZjMzcw%3D%3D&utm_source=qr';
})->name('instagram-url');

// Route untuk admin visit stats
Route::get('/admin/visit-stats', function () {
    $todayVisits = Visit::whereDate('visit_date', today())->count();
    $totalVisits = Visit::count();
    $guestVisits = Visit::whereNull('user_id')->whereDate('visit_date', today())->count();
    $userVisits = Visit::whereNotNull('user_id')->whereDate('visit_date', today())->count();

    $recentVisits = Visit::with('user')
        ->latest()
        ->limit(10)
        ->get();

    return view('admin.visit-stats', compact('todayVisits', 'totalVisits', 'guestVisits', 'userVisits', 'recentVisits'));
})->middleware(['auth', 'role:super_admin|admin'])->name('admin.visit_stats'); // Tambah middleware auth untuk admin

Route::get('/admin/visit-stats', [VisitController::class, 'index'])->name('admin.visits.index');

// Route untuk tampilan public/user (tanpa middleware auth)
Route::get('/berita', [NewsController::class, 'publicIndex'])->name('news.public.index');
Route::get('/berita/{id}', [NewsController::class, 'publicShow'])->name('news.public.show');

// Route test untuk guest
Route::get('/test-guest', function () {
    return '<h1>Test Page - Guest Visit</h1><p>IP: ' . request()->ip() . '</p><a href="/visit-stats">Lihat Stats</a>';
});

// Route test untuk user login
Route::get('/test-user', function () {
    if (Auth::check()) {
        return '<h1>Test Page - Logged User</h1><p>User: ' . Auth::user()->name . '</p><p>IP: ' . request()->ip() . '</p><a href="/visit-stats">Lihat Stats</a>';
    }
    return redirect('/login');
})->middleware('auth');

Route::get('/debug-tracking', function () {
    $request = request();
    $ip = $request->ip();
    $userAgent = $request->userAgent();
    $sessionId = session()->getId();
    $userId = auth()->id() ?? 'Guest';

    // Cek kondisi tracking
    $shouldTrack = $request->isMethod('GET') &&
        !$request->expectsJson() &&
        !$request->is('api/*') &&
        !str_starts_with($request->path(), '_') &&
        $request->path() !== 'favicon.ico';

    // Check existing visits
    $guestExists = \App\Models\Visit::whereNull('user_id')
        ->where('ip_address', $ip)
        ->where('visit_date', today())
        ->exists();

    $userExists = auth()->check() ? \App\Models\Visit::where('user_id', auth()->id())
        ->where('session_token', $sessionId)
        ->where('visit_date', today())
        ->exists() : false;

    return response()->json([
        'tracking_conditions' => [
            'is_get' => $request->isMethod('GET'),
            'not_expects_json' => !$request->expectsJson(),
            'not_api' => !$request->is('api/*'),
            'not_underscore' => !str_starts_with($request->path(), '_'),
            'not_favicon' => $request->path() !== 'favicon.ico',
            'should_track' => $shouldTrack
        ],
        'request_info' => [
            'method' => $request->method(),
            'path' => $request->path(),
            'ip' => $ip,
            'user_agent' => $userAgent,
            'session_id' => $sessionId,
            'user_id' => $userId,
            'is_auth' => auth()->check()
        ],
        'database_check' => [
            'guest_visit_exists_today' => $guestExists,
            'user_visit_exists_today' => $userExists,
            'total_visits_today' => \App\Models\Visit::whereDate('visit_date', today())->count(),
            'user_visits_today' => \App\Models\Visit::whereNotNull('user_id')->whereDate('visit_date', today())->count(),
            'guest_visits_today' => \App\Models\Visit::whereNull('user_id')->whereDate('visit_date', today())->count()
        ]
    ]);
});

Route::get('/admin/visits', [VisitController::class, 'index'])->name('admin.visits.index');

// Routes untuk Pelaporan
Route::prefix('pelaporan')->name('pelaporan.')->group(function () {
    Route::get('/', [PelaporanController::class, 'index'])->name('index');
    Route::get('/create', [PelaporanController::class, 'create'])->name('create');
    Route::post('/', [PelaporanController::class, 'store'])->name('store');
    Route::get('/{id}', [PelaporanController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [PelaporanController::class, 'edit'])->name('edit');
    Route::put('/{id}', [PelaporanController::class, 'update'])->name('update');
    Route::delete('/{id}', [PelaporanController::class, 'destroy'])->name('destroy');

    // Export routes
    Route::get('export/excel', [PelaporanController::class, 'exportExcel'])->name('export.excel');
    Route::post('export/excel-filtered', [PelaporanController::class, 'exportExcelFiltered'])->name('export.excel.filtered');
});

// Tambahkan di routes/web.php

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('news', NewsController::class);
});

Route::resource('news', NewsController::class);

Route::middleware('auth')->group(function () {
    Route::post('/survey', [SurveyController::class, 'store'])->name('survey.store');
    Route::get('/survey', [SurveyController::class, 'index'])->name('survey.index');
});

Route::get('/survey/form', fn() => view('survey.form'))->middleware('auth');
Route::get('/admin/survey', [SurveyController::class, 'adminView'])->name('admin.survey.index')->middleware('auth');
Route::get('/admin/news', [NewsController::class, 'index'])->name('admin.news.index');

Route::get('/survey/thankyou', function () {
    return view('survey.thankyou');
})->name('survey.thankyou');

Route::get('/survey/error', function () {
    return view('survey.error');
})->name('survey.error');

Route::get('/lokers', [LokerController::class, 'publicIndex'])->name('lokers.index');
Route::get('/lokers/{loker}', [LokerController::class, 'show'])->name('lokers.show');

// Routes untuk Admin (gunakan middleware auth dan role admin sesuai sistem Anda)
Route::get('/lokers', [LokerController::class, 'publicIndex'])->name('lokers.index');
Route::get('/lokers/{loker}', [LokerController::class, 'show'])->name('lokers.show');

// Routes untuk Admin
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('lokers', LokerController::class);
});

Route::get('/admin/visit-stats', [VisitController::class, 'index'])->middleware(['auth', 'role:super_admin|admin'])->name('admin.visit_stats');


Route::get('/trainings', [TrainingController::class, 'userIndex'])->name('trainings.user.index');
Route::get('/trainings/{id}', [TrainingController::class, 'show'])->name('trainings.show');

Route::middleware('auth')->group(function () {
    Route::get('/pelatihan/{id}/preview', [TrainingController::class, 'preview'])->name('pelatihan.preview');
    Route::post('/pelatihan/{id}/daftar', [TrainingController::class, 'register'])->name('pelatihan.register');
    Route::post('/profile/training/withdraw/{trainingId}', [ProfileController::class, 'withdraw'])->name('training.withdraw');
});

Route::get('/documents/view/{filename}/{category}', [DocumentController::class, 'showUserFile'])
    ->name('documents.show.user')
    ->middleware('auth');

Route::get('/app/Exports/LokerExport', [LokerController::class, 'export'])->name('admin.lokers.export');

Route::middleware(['auth', 'role:super_admin|admin'])->group(function() {
    Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/profile', [AdminController::class, 'profile'])->name('admin.profile');
    Route::put('/admin/profile', [AdminController::class, 'updateProfile'])->name('admin.updateProfile');
});

// Replace it with:
Route::middleware(['auth', 'role:super_admin|admin'])->group(function () {
Route::get('/admin/trainings/{id}/participants/export', [TrainingController::class, 'exportParticipants'])->name('admin.participant.export');
});

Route::middleware(['auth', 'role:super_admin|admin'])->group(function () {
Route::get('/trainings/{id}/participants', [TrainingController::class, 'showParticipants'])->name('trainings.participants');
});

// Routes untuk Pengaduan (User)
Route::middleware('auth')->prefix('pengaduan')->name('pengaduan.')->controller(PengaduanController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('/{id}', 'show')->name('show');
});

// Routes untuk Admin Pengaduan
Route::middleware(['auth', 'role:super_admin|admin'])->prefix('admin/pengaduan')->name('admin.pengaduan.')->controller(PengaduanController::class)->group(function () {
    Route::get('/', 'adminIndex')->name('index');
    Route::get('/{id}', 'adminShow')->name('show');
    Route::post('/{id}/reply', 'adminReply')->name('reply');
});
// Route::get('/contact', function() {
//     return view('contact');
// })->name('contact');

// Route::get('/', function () {
//     return view('home');
// });

// Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
// Route::post('/login', [AuthController::class, 'login']);
// Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
// Route::post('/register', [AuthController::class, 'register']);

// Route::middleware(['auth','role:user'])->group(function () {
    
//     Route::get('/user/dashboard', function () {
//         return view ('user.dashboard');
//     })->name('user.dashboard');
// });

// Route::middleware(['auth','role:super_admin'])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return view ('admin.dashboard');
//     })->name('admin.dashboard');
    
// });

// Route::middleware('auth')->group(function () {
//     Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//     Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
//     Route::get('/profile/documents', [ProfileController::class, 'showDocuments'])->name('profile.documents');
//     Route::get('/profile/change-password', [ProfileController::class, 'showChangePassword'])->name('profile.change-password');
//     Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');

// });

// Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
// Route::post('/profile/store', [ProfileController::class, 'storeProfile'])->name('profile.store');
// Route::post('/profile/storeOrUpdate', [ProfileController::class, 'storeOrUpdateProfile'])->name('profile.storeOrUpdate');
// Route::get('/profile/documents', [ProfileController::class, 'showDocuments'])->name('profile.documents');
// Route::post('/profile/documents/storeOrUpdate', [ProfileController::class, 'storeOrUpdateDocuments'])->name('profile.documents.storeOrUpdate');
// Route::post('/profile/storeOrUpdate', [ProfileController::class, 'storeOrUpdateProfile'])->name('profile.storeOrUpdate');
// Route::post('/profile/documents/storeOrUpdate', [ProfileController::class, 'storeOrUpdateDocuments'])->name('profile.documents.storeOrUpdate');
// Route::get('/profile/change-password', [ProfileController::class, 'showChangePassword'])->name('profile.change-password');
// Route::put('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
// Route::get('/profile/check-completion', [TrainingController::class, 'checkProfileCompletion'])->name('profile.checkCompletion');
// Route::get('/profile/preview', [ProfileController::class, 'preview'])->name('profile.preview');
// Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

// Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
// Route::get('/admin/participants', [ParticipantController::class, 'index'])->name('admin.participant_management');
// Route::get('/admin/participant/{id}', [ParticipantController::class, 'show'])->name('participant.show');
// Route::delete('/admin/participant/{id}/delete', [ParticipantController::class, 'destroy'])->name('participant.destroy');
// Route::get('/admin/trainings', [TrainingController::class, 'index'])->name('admin.training_management');
// Route::get('/admin/account-participants', [AdminController::class, 'accountParticipants'])->name('admin.account_participants');
// Route::patch('/admin/participant/{id}/change-role', [AdminController::class, 'changeRole'])->name('admin.change_role');

// Route::resource('trainings', TrainingController::class);
// Route::post('/trainings/{id}/process', [TrainingController::class, 'processRegistration'])->name('trainings.process');
// Route::get('/trainings/{id}/register', [TrainingController::class, 'register'])->name('trainings.register');

// Route::get('/participants', [ParticipantController::class, 'index'])->name('participant.index');
// Route::post('/document/confirm/{id}', [ParticipantController::class, 'confirmDocument'])->name('document.confirm');
// // Route untuk view dokumen
// Route::post('/document/confirm/{id}/{type}', [ParticipantController::class, 'confirmDocument'])->name('document.confirm');
// Route::post('/document/reject/{id}/{type}', [ParticipantController::class, 'rejectDocument'])->name('document.reject');
// Route::get('view-document/{type}/{userId}', [ParticipantController::class, 'viewDocument'])->name('view.document');
// Route::post('/profile/documents', [ParticipantController::class, 'storeOrUpdateDocuments'])->name('profile.documents.storeOrUpdate');
// Route::get('/participants/export', [ParticipantController::class, 'export'])->name('participant.export');
// Route::resource('trainings', TrainingController::class);
// Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/course', [CourseController::class, 'index'])->name('course');
// Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
// Route::get('/profile/show/{user}', [ProfileController::class, 'show'])->name('profile.show');

// Route::get('/admin/trainings', [TrainingController::class, 'index'])->name('trainings.index');
// Route::get('/admin/trainings/create', [TrainingController::class, 'create'])->name('trainings.create');
// Route::post('/admin/trainings', [TrainingController::class, 'store'])->name('trainings.store');
// Route::get('/admin/trainings/{id}/edit', [TrainingController::class, 'edit'])->name('trainings.edit');
// Route::put('/admin/trainings/{id}', [TrainingController::class, 'update'])->name('trainings.update');
// Route::delete('/admin/trainings/{id}', [TrainingController::class, 'destroy'])->name('trainings.destroy');

// Route::get('/admin/trainings', [TrainingController::class, 'index'])->name('admin.training_management');
// // Route untuk menghapus peserta
// Route::delete('/admin/participants/{id}', [ParticipantController::class, 'destroy'])->name('participant.destroy');

// Route::get('/about', function () {
//     return view('about');
// })->name('about');

// //course
// Route::get('/courses', function () {
//     return view('courses.index');
// })->name('courses.index');

// Route::get('/courses/barista', function () {
//     return view('courses.details.barista');
// })->name('courses.barista');

// Route::get('/courses/barbershop', function () {
//     return view('courses.details.barbershop');
// })->name('courses.barbershop');

// Route::get('/courses/digital', function () {
//     return view('courses.details.digital');
// })->name('courses.digital');

// Route::get('/courses/fotografi', function () {
//     return view('courses.details.fotografi');
// })->name('courses.fotografi');

// Route::get('/courses/grafis', function () {
//     return view('courses.details.grafis');
// })->name('courses.grafis');

// Route::get('/courses/jaringan', function () {
//     return view('courses.details.jaringan');
// })->name('courses.jaringan');

// Route::get('/courses/kue', function () {
//     return view('courses.details.kue');
// })->name('courses.kue');

// Route::get('/courses/membatik', function () {
//     return view('courses.details.membatik');
// })->name('courses.membatik');

// Route::get('/courses/menjahit', function () {
//     return view('courses.details.menjahit');
// })->name('courses.menjahit');

// Route::get('/courses/service', function () {
//     return view('courses.details.service');
// })->name('courses.service');

// Route::get('/contact', function () {
//     return view('contact');
// })->name('contact');

// Route::get('/trainings/{id}/participants', [TrainingController::class, 'showParticipants'])->name('trainings.participants');
// // Route untuk preview dan daftar pelatihan
// Route::get('/pelatihan/preview', [TrainingController::class, 'preview'])->name('trainings.preview');
// Route::post('/pelatihan/register', [TrainingController::class, 'register'])->name('course.register');

// // Route untuk menampilkan halaman preview
// Route::get('/pelatihan/{id}/preview', [TrainingController::class, 'preview'])->name('pelatihan.preview');
// // Route untuk meng-handle pendaftaran
// Route::post('/pelatihan/{id}/daftar', [TrainingController::class, 'register'])->name('course.register');

// // Route untuk preview pelatihan sebelum daftar
// Route::middleware('auth')->group(function () {
//     Route::get('/pelatihan/{id}/preview', [TrainingController::class, 'preview'])->name('pelatihan.preview');
//     Route::post('/pelatihan/{id}/daftar', [TrainingController::class, 'register'])->name('course.register');
// });

// Route::post('/course/register', [CourseController::class, 'register'])->name('course.register');

// Route::post('/participants/{id}/revisi', [ParticipantController::class, 'sendRevision'])->name('participant.sendRevision');
// Route::get('/profile/documents', [ParticipantController::class, 'showDocuments'])->name('profile.documents');

// Route::post('/participants/{id}/send-revision', [ParticipantController::class, 'sendRevision'])->name('participant.sendRevision');
// Route::post('/documents/{id}/{type}/revision', [ParticipantController::class, 'markAsRevision'])->name('document.revision');

// Route::post('/documents/{id}/{type}/revision', [ParticipantController::class, 'markAsRevision'])->name('document.revision');
// Route::post('/participant/{id}/send-revision', [ParticipantController::class, 'sendRevision'])->name('participant.sendRevision');

// // Route untuk menampilkan halaman dokumen
// Route::get('/profile/documents', [ProfileController::class, 'showDocuments'])->name('profile.documents');

// // Route untuk menyimpan atau memperbarui dokumen
// Route::post('/profile/documents', [ProfileController::class, 'storeOrUpdateDocuments'])->name('profile.documents.storeOrUpdate');
// Route::delete('/admin/participants/{user_id}', [ParticipantController::class, 'destroy'])->name('participant.destroy');
// Route::get('/training-participants', [TrainingController::class, 'showTrainingParticipants'])->name('training.participants');
// Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
// Route::get('/pelatihan/daftar', [TrainingController::class, 'register'])->middleware('profile.complete')->name('pelatihan.daftar');
// Route::get('/profile/preview', [ProfileController::class, 'showPreview'])->name('profile.preview');

// Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
// Route::get('/profile/preview', [ProfileController::class, 'showPreview'])->name('profile.preview');
// Route::delete('/trainings/{id}', [TrainingController::class, 'destroy'])->name('trainings.destroy');
// Route::post('/trainings/{trainingId}/register', [ParticipantController::class, 'registerForTraining'])->name('trainings.register');

// // Route untuk menampilkan konfirmasi penghapusan
// Route::get('/participants/{user_id}/confirm-delete', [ParticipantController::class, 'confirmDelete'])->name('participant.confirmDelete');

// // Route untuk menghapus peserta dan menyimpan pesan
// Route::get('/profile/trainings', [ProfileController::class, 'showTrainings'])->name('profile.training');
// Route::get('/trainings/registered', [TrainingController::class, 'registeredTrainings'])->name('trainings.registered');
// Route::get('/profile/trainings', [ProfileController::class, 'showTrainings'])->name('profile.training');
// Route::get('/pelatihan/daftar', [TrainingController::class, 'register'])->middleware('profile.complete')->name('pelatihan.daftar');
// Route::get('/trainings', [ProfileController::class, 'showTrainings'])->name('trainings');
// Route::get('/profile/preview', [ProfileController::class, 'showPreview'])->name('profile.preview');
// Route::get('/registrations', [YourController::class, 'showRegistrations'])->name('registrations.index');
// Route::get('/profile/preview', [ProfileController::class, 'showPreview'])->name('profile.preview');
// Route::get('/profile/{id}', [ProfileController::class, 'show'])->name('profile.show');
// Route::get('/trainings', [ProfileController::class, 'showTrainings'])->name('trainings');
// Route::get('/profile/trainings', [ProfileController::class, 'showTrainings'])->name('profile.trainings');

// Route::post('/profile/training/withdraw/{trainingId}', [ProfileController::class, 'withdraw'])->name('training.withdraw');
// Route::get('/admin/withdrawals', [AdminController::class, 'withdrawalRequests'])->name('admin.withdrawals');
// Route::post('/admin/withdrawals/{id}/verify', [AdminController::class, 'verifyWithdrawal'])->name('admin.withdrawals.verify');
// Route::post('/admin/withdrawals/{id}/reject', [AdminController::class, 'rejectWithdrawal'])->name('admin.withdrawals.reject');

// Route::get('admin/remove-participant/{userId}', [AdminController::class, 'showRemovalForm'])->name('admin.removeParticipantForm');
// Route::post('admin/remove-participant/{userId}', [AdminController::class, 'removeParticipant'])->name('admin.removeParticipant');
// Route::post('admin/verify-removal/{id}', [AdminController::class, 'verifyRemoval'])->name('admin.verifyRemoval');