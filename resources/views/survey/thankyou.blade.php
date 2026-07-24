@extends('layouts.appuser')

@section('title', 'Terima Kasih')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height: calc(100vh - 200px); padding-top: 120px;">
    <div class="bg-white p-5 rounded text-center shadow-lg">
        <h1 class="text-dark mb-3 fw-bold" style="font-size: 2.5rem;">Terima Kasih!</h1>
        <p class="text-muted mb-4">Kami sangat menghargai waktu Anda untuk mengisi survei ini.<br>
            Masukan Anda membantu kami meningkatkan layanan.</p>
        <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
    </div>
</div>
@endsection
