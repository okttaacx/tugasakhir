@extends('layouts.adminapp')

@section('title', 'Manajemen Dokumen')

@section('content')
<div class="container-fluid px-4 py-4">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="page-title mb-2">
                        <i class="fas fa-file-alt text-warning me-3"></i>
                        Manajemen Dokumen
                    </h2>
                    <p class="text-muted mb-0">Kelola dan verifikasi dokumen peserta pelatihan</p>
                </div>
                <div class="stats-cards d-flex gap-3">
                    <div class="mini-card bg-primary">
                        <div class="mini-card-content">
                            <i class="fas fa-file-upload"></i>
                            <div>
                                <span class="mini-card-number">{{ $documents->total() }}</span>
                                <span class="mini-card-label">Total</span>
                            </div>
                        </div>
                    </div>
                    <div class="mini-card bg-warning">
                        <div class="mini-card-content">
                            <i class="fas fa-clock"></i>
                            <div>
                                <span class="mini-card-number">{{ $documents->where('ktp_status', 'pending')->count() + $documents->where('kk_status', 'pending')->count() + $documents->where('ijazah_status', 'pending')->count() + $documents->where('ak1_status', 'pending')->count() }}</span>
                                <span class="mini-card-label">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="row mb-4">
            <div class="col-12">
                <div class="alert alert-success alert-modern alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content Card -->
    <div class="row">
        <div class="col-12">
            <div class="card modern-card">
                <div class="card-header modern-card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-list me-2"></i>
                            Daftar Dokumen Peserta
                        </h5>
                        <div class="header-actions">
                            <button class="btn btn-outline-light btn-sm me-2" onclick="refreshTable()">
                                <i class="fas fa-sync-alt me-1"></i>
                                Refresh
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-modern mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center" width="60">#</th>
                                    <th width="200">
                                        <i class="fas fa-user me-2"></i>
                                        Peserta
                                    </th>
                                    <th class="text-center" width="150">
                                        <i class="fas fa-id-card me-2"></i>
                                        KTP
                                    </th>
                                    <th class="text-center" width="150">
                                        <i class="fas fa-home me-2"></i>
                                        KK
                                    </th>
                                    <th class="text-center" width="150">
                                        <i class="fas fa-graduation-cap me-2"></i>
                                        Ijazah
                                    </th>
                                    <th class="text-center" width="150">
                                        <i class="fas fa-certificate me-2"></i>
                                        AK1
                                    </th>
                                    <th class="text-center" width="120">
                                        <i class="fas fa-cogs me-2"></i>
                                        Aksi
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($documents as $document)
                                    <tr class="table-row">
                                        <td class="text-center fw-bold">{{ $loop->iteration }}</td>
                                        <td>
                                            <div class="user-info">
                                                <div class="user-avatar">
                                                    <i class="fas fa-user-circle"></i>
                                                </div>
                                                <div class="user-details">
                                                    <span class="user-name">{{ $document->user->name }}</span>
                                                    <small class="user-email text-muted">{{ $document->user->email }}</small>
                                                </div>
                                            </div>
                                        </td>
                                        @foreach (['ktp', 'kk', 'ijazah', 'ak1'] as $doc)
                                        <td class="text-center">
                                            <div class="document-cell">
                                                @if ($document->$doc)
                                                    <div class="document-actions mb-2">
                                                        <a href="{{ route('admin.documents.show', [$document->{$doc . '_filename'}, $doc]) }}" 
                                                           target="_blank" 
                                                           class="btn btn-view btn-sm"
                                                           title="Lihat Dokumen">
                                                            <i class="fas fa-eye"></i>
                                                        </a>
                                                    </div>
                                                @endif
                                                
                                                <select name="{{ $doc }}_status" 
                                                        class="form-select form-select-sm status-select update-status" 
                                                        data-document-id="{{ $document->id }}" 
                                                        data-field="{{ $doc }}_status">
                                                    <option value="pending" {{ $document->{$doc . '_status'} == 'pending' ? 'selected' : '' }}>
                                                        Pending
                                                    </option>
                                                    <option value="confirmed" {{ $document->{$doc . '_status'} == 'confirmed' ? 'selected' : '' }}>
                                                        Confirmed
                                                    </option>
                                                    <option value="rejected" {{ $document->{$doc . '_status'} == 'rejected' ? 'selected' : '' }}>
                                                        Rejected
                                                    </option>
                                                </select>
                                            </div>
                                        </td>
                                        @endforeach
                                        <td class="text-center">
                                            <button class="btn btn-message btn-sm"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#messageModal"
                                                    data-id="{{ $document->user->id }}"
                                                    data-message="{{ optional($document->user->revisi)->revisi_message ?? '' }}"
                                                    title="Kirim Pesan">
                                                <i class="fas fa-comment-dots"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-5">
                                            <div class="empty-state">
                                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                                <h5 class="text-muted">Tidak Ada Dokumen</h5>
                                                <p class="text-muted">Belum ada dokumen yang disubmit oleh peserta</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($documents->hasPages())
                <div class="card-footer bg-transparent border-top-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="pagination-info">
                            <small class="text-muted">
                                Menampilkan {{ $documents->firstItem() }} - {{ $documents->lastItem() }} 
                                dari {{ $documents->total() }} data
                            </small>
                        </div>
                        <div class="pagination-wrapper">
                            {{ $documents->links() }}
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Message Modal -->
<div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content modern-modal">
            <div class="modal-header modern-modal-header">
                <h5 class="modal-title" id="messageModalLabel">
                    <i class="fas fa-paper-plane me-2"></i>
                    Kirim Pesan Revisi
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="messageForm" action="" method="POST">
                @csrf
                @method('PATCH')
                <input type="hidden" name="document_id" id="document_id">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="messages" class="form-label fw-semibold">
                            <i class="fas fa-edit me-2"></i>
                            Pesan Revisi
                        </label>
                        <textarea name="messages" 
                                  id="messages" 
                                  class="form-control modern-textarea" 
                                  rows="5" 
                                  placeholder="Masukkan pesan revisi untuk peserta..."
                                  required></textarea>
                        <div class="form-text">
                            <i class="fas fa-info-circle me-1"></i>
                            Pesan ini akan dikirim kepada peserta untuk perbaikan dokumen
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-2"></i>
                        Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>
                        Kirim Pesan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Modern Card Styles */
.modern-card {
    border: none;
    border-radius: 16px;
    box-shadow: 
        0 10px 40px rgba(0, 0, 0, 0.1),
        0 4px 16px rgba(0, 0, 0, 0.05);
    background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
    overflow: hidden;
    transition: all 0.3s ease;
}

.modern-card:hover {
    transform: translateY(-2px);
    box-shadow: 
        0 20px 60px rgba(0, 0, 0, 0.15),
        0 8px 32px rgba(0, 0, 0, 0.1);
}

.modern-card-header {
    background: linear-gradient(135deg, 
        var(--primary-blue) 0%, 
        var(--secondary-blue) 50%, 
        var(--dark-steel) 100%);
    border: none;
    padding: 1.5rem 2rem;
    position: relative;
    overflow: hidden;
}

.modern-card-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: repeating-linear-gradient(
        45deg,
        transparent,
        transparent 2px,
        rgba(255, 255, 255, 0.05) 2px,
        rgba(255, 255, 255, 0.05) 4px
    );
    pointer-events: none;
}

.card-title {
    color: var(--text-white) !important;
    font-weight: 600;
    font-size: 1.25rem;
}

.header-actions .btn {
    border-radius: 8px;
    font-weight: 500;
    transition: all 0.3s ease;
}

.header-actions .btn:hover {
    transform: scale(1.05);
}

/* Page Title */
.page-title {
    color: var(--dark-steel);
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 0.5rem;
}

/* Mini Stats Cards */
.stats-cards {
    gap: 1rem;
}

.mini-card {
    border-radius: 12px;
    padding: 1rem 1.5rem;
    color: white;
    min-width: 120px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.mini-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
}

.mini-card-content {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.mini-card-content i {
    font-size: 1.5rem;
    opacity: 0.8;
}

.mini-card-number {
    display: block;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1;
}

.mini-card-label {
    display: block;
    font-size: 0.75rem;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Modern Table */
.table-modern {
    border-collapse: separate;
    border-spacing: 0;
}

.table-modern thead th {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
    border: none;
    padding: 1.25rem 1rem;
    font-weight: 600;
    color: var(--dark-steel);
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    position: relative;
}

.table-modern thead th:first-child {
    border-top-left-radius: 12px;
}

.table-modern thead th:last-child {
    border-top-right-radius: 12px;
}

.table-modern tbody .table-row {
    border: none;
    transition: all 0.3s ease;
    position: relative;
}

.table-row:hover {
    background: linear-gradient(90deg, 
        rgba(255, 140, 0, 0.03) 0%, 
        rgba(255, 140, 0, 0.01) 100%);
    transform: scale(1.005);
}

.table-modern tbody td {
    padding: 1.25rem 1rem;
    border-top: 1px solid rgba(0, 0, 0, 0.05);
    vertical-align: middle;
}

/* User Info Styling */
.user-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.user-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-blue), var(--warning-orange));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.user-details {
    display: flex;
    flex-direction: column;
    gap: 0.25rem;
}

.user-name {
    font-weight: 600;
    color: var(--dark-steel);
    font-size: 0.95rem;
}

.user-email {
    font-size: 0.8rem;
    color: var(--light-steel);
}

/* Document Cell */
.document-cell {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
}

.document-actions {
    display: flex;
    gap: 0.25rem;
}

.btn-view {
    background: linear-gradient(135deg, #17a2b8, #138496);
    border: none;
    color: white;
    width: 32px;
    height: 32px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-view:hover {
    background: linear-gradient(135deg, #138496, #117a8b);
    transform: scale(1.1);
    color: white;
}

.status-select {
    border-radius: 8px;
    border: 2px solid #e2e8f0;
    font-size: 0.8rem;
    font-weight: 500;
    transition: all 0.3s ease;
    min-width: 100px;
}

.status-select:focus {
    border-color: var(--warning-orange);
    box-shadow: 0 0 0 0.2rem rgba(255, 140, 0, 0.25);
}

.status-select option[value="pending"] {
    background-color: #fef3cd;
    color: #664d03;
}

.status-select option[value="confirmed"] {
    background-color: #d1e7dd;
    color: #0f5132;
}

.status-select option[value="rejected"] {
    background-color: #f8d7da;
    color: #721c24;
}

/* Message Button */
.btn-message {
    background: linear-gradient(135deg, var(--warning-orange), #e67e00);
    border: none;
    color: white;
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.btn-message:hover {
    background: linear-gradient(135deg, #e67e00, #cc6600);
    transform: scale(1.1);
    color: white;
    box-shadow: 0 4px 12px rgba(255, 140, 0, 0.3);
}

/* Empty State */
.empty-state {
    padding: 3rem 2rem;
    text-align: center;
}

.empty-state i {
    color: #cbd5e0;
}

.empty-state h5 {
    color: #718096;
    margin-bottom: 0.5rem;
}

.empty-state p {
    color: #a0aec0;
    font-size: 0.9rem;
}

/* Modern Modal */
.modern-modal .modal-content {
    border: none;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
}

.modern-modal-header {
    background: linear-gradient(135deg, var(--primary-blue), var(--secondary-blue));
    color: white;
    padding: 1.5rem 2rem;
    border: none;
}

.modern-modal-header .modal-title {
    font-weight: 600;
    font-size: 1.25rem;
}

.modern-modal .modal-body {
    padding: 2rem;
}

.modern-textarea {
    border: 2px solid #e2e8f0;
    border-radius: 12px;
    padding: 1rem;
    transition: all 0.3s ease;
    resize: vertical;
}

.modern-textarea:focus {
    border-color: var(--warning-orange);
    box-shadow: 0 0 0 0.2rem rgba(255, 140, 0, 0.25);
}

.modern-textarea::placeholder {
    color: #a0aec0;
}

/* Alert Modern */
.alert-modern {
    border: none;
    border-radius: 12px;
    padding: 1rem 1.5rem;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

/* Pagination */
.pagination-wrapper .page-link {
    border: none;
    margin: 0 2px;
    border-radius: 8px;
    color: var(--dark-steel);
    transition: all 0.3s ease;
}

.pagination-wrapper .page-link:hover {
    background: var(--warning-orange);
    color: white;
    transform: translateY(-1px);
}

.pagination-wrapper .page-item.active .page-link {
    background: var(--primary-blue);
    color: white;
}

.pagination-info {
    color: var(--light-steel);
    font-size: 0.875rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .stats-cards {
        flex-direction: column;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .table-responsive {
        border-radius: 12px;
    }
    
    .user-info {
        flex-direction: column;
        text-align: center;
    }
    
    .document-cell {
        gap: 0.25rem;
    }
    
    .status-select {
        font-size: 0.75rem;
        min-width: 80px;
    }
}

@media (max-width: 576px) {
    .modern-card-header {
        padding: 1rem;
    }
    
    .table-modern thead th,
    .table-modern tbody td {
        padding: 0.75rem 0.5rem;
        font-size: 0.8rem;
    }
    
    .btn-view,
    .btn-message {
        width: 28px;
        height: 28px;
        font-size: 0.8rem;
    }
}
</style>
@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {
    // Status update functionality
    document.querySelectorAll('.update-status').forEach(function(selectElement) {
        selectElement.addEventListener('change', function() {
            let documentId = this.dataset.documentId;
            let field = this.dataset.field;
            let status = this.value;

            // Add loading state
            this.style.opacity = '0.6';
            this.disabled = true;

            fetch(`/admin/documents/${documentId}/update-status`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    field: field,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Add success feedback
                    showNotification('Status berhasil diperbarui', 'success');
                    
                    // Update select styling based on status
                    updateSelectStyling(this, status);
                } else {
                    showNotification('Gagal memperbarui status', 'error');
                    // Revert to previous value if failed
                    this.value = this.dataset.previousValue || 'pending';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Terjadi kesalahan', 'error');
                this.value = this.dataset.previousValue || 'pending';
            })
            .finally(() => {
                // Remove loading state
                this.style.opacity = '1';
                this.disabled = false;
            });

            // Store previous value for potential revert
            this.dataset.previousValue = this.value;
        });
    });

    // Message modal functionality
    document.querySelectorAll('.btn-message').forEach(button => {
        button.addEventListener('click', function () {
            let documentId = this.dataset.id;
            let message = this.dataset.message || '';
            let form = document.getElementById('messageForm');
            let inputDocumentId = document.getElementById('document_id');
            let messageInput = document.getElementById('messages');

            form.action = `/admin/documents/${documentId}/message`; 
            inputDocumentId.value = documentId;
            messageInput.value = message;
        });
    });

    // Initialize select styling
    document.querySelectorAll('.status-select').forEach(function(select) {
        updateSelectStyling(select, select.value);
    });
});

function updateSelectStyling(selectElement, status) {
    selectElement.classList.remove('status-pending', 'status-confirmed', 'status-rejected');
    selectElement.classList.add(`status-${status}`);
    
    // Update colors based on status
    switch(status) {
        case 'pending':
            selectElement.style.background = 'linear-gradient(135deg, #fef3cd, #fdf6d8)';
            selectElement.style.color = '#664d03';
            selectElement.style.borderColor = '#f0d06b';
            break;
        case 'confirmed':
            selectElement.style.background = 'linear-gradient(135deg, #d1e7dd, #d8eddf)';
            selectElement.style.color = '#0f5132';
            selectElement.style.borderColor = '#86ca95';
            break;
        case 'rejected':
            selectElement.style.background = 'linear-gradient(135deg, #f8d7da, #fadadd)';
            selectElement.style.color = '#721c24';
            selectElement.style.borderColor = '#e48b94';
            break;
    }
}

function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-modern notification-toast`;
    notification.innerHTML = `
        <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>
        ${message}
    `;
    
    // Add notification styles
    notification.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        z-index: 1060;
        min-width: 300px;
        animation: slideInRight 0.5s ease;
    `;
    
    document.body.appendChild(notification);
    
    // Remove notification after 3 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.5s ease';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 500);
    }, 3000);
}

function refreshTable() {
    location.reload();
}

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    .notification-toast {
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
        border: none;
    }
`;
document.head.appendChild(style);
</script>    
@endpush