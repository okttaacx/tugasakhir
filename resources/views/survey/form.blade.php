@extends('layouts.appuser')

@section('title', 'Survei Kepuasan Pelanggan')

@section('content')
    <style>
        /* Survey Form Styling - Inline CSS */
        .survey-container {
            min-height: 100vh;
            padding: 2rem 0;
            background-color: #f9fafb;
        }

        .survey-wrapper {
            max-width: 56rem;
            margin: 0 auto;
            padding: 0 1rem;
        }

        .survey-header {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            text-align: center;
        }

        .survey-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .survey-header p {
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .survey-form-container {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .question-item {
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
        }

        .question-item:not(:first-child) {
            border-top: 1px solid #e5e7eb;
            padding-top: 1.5rem;
        }

        .question-container {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
        }

        .question-number {
            flex-shrink: 0;
            width: 2.5rem;
            height: 2.5rem;
            background: linear-gradient(to right, #2563eb, #2563eb);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        .question-number span {
            color: white;
            font-weight: 700;
            font-size: 0.875rem;
        }

        .question-content {
            flex: 1;
        }

        .question-title {
            font-size: 1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 1rem;
            line-height: 1.6;
        }

        .rating-options {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .rating-option {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem;
            border-radius: 0.375rem;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .rating-option:hover {
            background-color: #f9fafb;
        }

        .rating-option input[type="radio"] {
            width: 1rem;
            height: 1rem;
            accent-color: #2563eb;
            border-color: #d1d5db;
        }

        .rating-option input[type="radio"]:focus {
            outline: 2px solid #3b82f6;
            outline-offset: 2px;
        }

        .rating-option label {
            font-size: 0.875rem;
            color: #374151;
            cursor: pointer;
            margin: 0;
        }

        .survey-footer {
            border-top: 1px solid #e5e7eb;
            padding-top: 1.5rem;
            margin-top: 2rem;
        }

        .survey-footer p {
            font-size: 0.75rem;
            color: #6b7280;
            text-align: center;
            margin: 0;
        }

        .submit-container {
            text-align: center;
        }

        .submit-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 2rem;
            background-color: #2563eb;
            color: white;
            font-weight: 600;
            border-radius: 0.5rem;
            border: none;
            cursor: pointer;
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            transition: all 0.2s;
            font-size: 1rem;
        }

        .submit-btn:hover {
            background-color: #1d4ed8;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transform: translateY(-1px);
        }

        .submit-btn:focus {
            outline: none;
            box-shadow: 0 0 0 4px rgba(191, 219, 254, 0.5);
        }

        .submit-btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .submit-btn svg {
            width: 1.25rem;
            height: 1.25rem;
        }

        @keyframes spin {
            from { transform: rotate(0deg); }
            to { transform: rotate(360deg); }
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .survey-container {
                padding: 1rem 0;
            }
            
            .survey-wrapper {
                padding: 0 0.5rem;
            }
            
            .question-container {
                gap: 0.75rem;
            }
            
            .question-number {
                width: 2rem;
                height: 2rem;
            }
            
            .question-number span {
                font-size: 0.75rem;
            }
            
            .submit-btn {
                padding: 0.75rem 1.5rem;
                font-size: 0.875rem;
            }
        }
    </style>

    <div class="survey-container">
        <div class="survey-wrapper">
            <!-- Header -->
            <div class="survey-header">
                <h1>Survei Kepuasan Pelanggan</h1>
                <p>Bantu kami meningkatkan layanan dengan mengisi survei berikut</p>
            </div>

            <!-- Survey Form -->
            <form action="{{ route('survey.store') }}" method="POST" id="surveyForm">
                @csrf

                @php
                    $questions = [
                        'Bagaimana pendapat Saudara tentang kesesuaian persyaratan pelayanan dengan jenis pelayanannya.',
                        'Bagaimana pemahaman Saudara tentang kemudahan prosedur pelayanan di unit ini.',
                        'Bagaimana pendapat Saudara tentang kecepatan waktu dalam memberikan pelayanan.',
                        'Bagaimana pendapat Saudara tentang kewajaran biaya/tarif dalam pelayanan.',
                        'Bagaimana pendapat Saudara tentang kesesuaian produk pelayanan antara yang tercantum dalam standar pelayanan dengan hasil yang diberikan.',
                        'Bagaimana pendapat Saudara tentang kompetensi/kemampuan petugas dalam pelayanan.',
                        'Bagamana pendapat saudara perilaku petugas dalam pelayanan terkait kesopanan dan keramahan',
                        'Bagaimana pendapat Saudara tentang penanganan pengaduan pengguna layanan',
                        'Bagaimana pendapat Saudara tentang kualitas sarana dan prasarana',
                        'Bagaimana pendapat anda tentang transparansi pelayanan yang diberikan',
                        'Bagaimana integritas petugas pelayanan dalam memberikan pelayanan',
                    ];

                    $ratingLabels = [
                        1 => 'Sangat Tidak Puas',
                        2 => 'Tidak Puas',
                        3 => 'Biasa',
                        4 => 'Puas',
                        5 => 'Sangat Puas',
                    ];
                @endphp

                <div class="survey-form-container">
                    @foreach ($questions as $index => $question)
                        <div class="question-item">
                            <div class="question-container">
                                <!-- Question Number Badge -->
                                <div class="question-number">
                                    <span>{{ sprintf('%02d', $index + 1) }}</span>
                                </div>

                                <!-- Question Content -->
                                <div class="question-content">
                                    <h3 class="question-title">{{ $question }}</h3>

                                    <!-- Rating Options -->
                                    <div class="rating-options">
                                        @foreach ($ratingLabels as $value => $label)
                                            <div class="rating-option">
                                                <input type="radio" 
                                                       name="answers[{{ $index + 1 }}]" 
                                                       value="{{ $value }}" 
                                                       id="q{{ $index + 1 }}_{{ $value }}"
                                                       required>
                                                <label for="q{{ $index + 1 }}_{{ $value }}">{{ $label }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Additional Info Text -->
                    <div class="survey-footer">
                        <p>
                            Kami berharap Anda dapat memberikan penilaian yang sebenarnya agar kami dapat terus
                            meningkatkan pelayanan. Terima kasih atas partisipasi Anda.
                        </p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="submit-container">
                    <button type="submit" class="submit-btn" id="submitBtn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        <span>Kirim Survey</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('surveyForm');
            const submitButton = document.getElementById('submitBtn');

            form.addEventListener('submit', function(e) {
                submitButton.innerHTML = `
                    <svg class="animate-spin" fill="none" viewBox="0 0 24 24">
                        <circle style="opacity: 0.25;" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path style="opacity: 0.75;" fill="currentColor" d="m4 12a8 8 0 0 1 8-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 0 1 4 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Mengirim Survey...</span>
                `;
                submitButton.disabled = true;
            });
        });
</script>
@endsection