@extends('layouts.adminapp')

@section('content')
<div class="container-fluid px-4 py-6 mt-5" style="margin-top: 80px;">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body bg-primary text-white">
                    <h1 class="h3 mb-1">📊 Hasil Survei Seluruh User</h1>
                    <p class="mb-0 opacity-75">Data hasil survei kepuasan dari semua pengguna</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Survey Results -->
    @forelse ($surveys as $survey)
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <!-- User Info Header -->
                    <div class="card-header bg-light">
                        <div class="d-flex align-items-center">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div>
                                <h5 class="mb-0 fw-bold">{{ $survey->user->name }}</h5>
                                <small class="text-muted">{{ $survey->created_at->format('d M Y, H:i') }}</small>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Survey Answers -->
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach ($survey->answers->sortBy('question_number') as $answer)
                                <div class="col-md-6 col-lg-4">
                                    <div class="d-flex justify-content-between align-items-center p-3 bg-light rounded border">
                                        <span class="fw-medium">Pertanyaan {{ $answer->question_number }}</span>
                                        <span class="badge rounded-pill fs-6 px-3 py-2
                                            @if($answer->score >= 4) bg-success
                                            @elseif($answer->score >= 3) bg-warning  
                                            @else bg-danger
                                            @endif">
                                            {{ $answer->score }}
                                        </span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <!-- Summary Stats -->
                        <div class="row mt-4 pt-3 border-top">
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div class="h4 mb-0 text-primary">{{ $survey->answers->count() }}</div>
                                    <small class="text-muted">Total Pertanyaan</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div class="h4 mb-0 text-success">{{ number_format($survey->answers->avg('score'), 1) }}</div>
                                    <small class="text-muted">Rata-rata Score</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div class="h4 mb-0 text-info">{{ $survey->answers->max('score') }}</div>
                                    <small class="text-muted">Score Tertinggi</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-center">
                                    <div class="h4 mb-0 text-warning">{{ $survey->answers->min('score') }}</div>
                                    <small class="text-muted">Score Terendah</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body text-center py-5">
                        <div class="text-muted mb-3" style="font-size: 3rem;">📝</div>
                        <h5 class="text-muted">Belum ada data survei</h5>
                        <p class="text-muted mb-0">Data akan muncul setelah ada user yang mengisi survei</p>
                    </div>
                </div>
            </div>
        </div>
    @endforelse
</div>
@endsection