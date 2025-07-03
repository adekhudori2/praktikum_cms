<div class="modal-overlay" id="modalOverlay" style="display: none;">
    <div class="modal-container" id="modalContainer">
        <div class="modal-header">
            <h3 class="modal-title" id="modalTitle">Modal Title</h3>
            <button class="modal-close" onclick="closeModal()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="modal-body" id="modalBody">
            <!-- Modal content will be inserted here -->
        </div>
        <div class="modal-footer" id="modalFooter">
            <!-- Modal footer buttons will be inserted here -->
        </div>
    </div>
</div>

<style>
.modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 10000;
    animation: fadeIn 0.3s ease;
}

.modal-container {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
    max-width: 90vw;
    max-height: 90vh;
    overflow: hidden;
    animation: slideIn 0.3s ease;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
}

.modal-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.25rem;
    color: #6b7280;
    cursor: pointer;
    padding: 0.5rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.modal-close:hover {
    background: #f3f4f6;
    color: #374151;
}

.modal-body {
    padding: 1.5rem;
    max-height: 60vh;
    overflow-y: auto;
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    padding: 1.5rem;
    border-top: 1px solid #e5e7eb;
    background: #f9fafb;
}

.modal-btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.5rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    font-size: 1rem;
}

.modal-btn-primary {
    background: #3b82f6;
    color: white;
}

.modal-btn-primary:hover {
    background: #2563eb;
}

.modal-btn-secondary {
    background: #6b7280;
    color: white;
}

.modal-btn-secondary:hover {
    background: #4b5563;
}

.modal-btn-danger {
    background: #ef4444;
    color: white;
}

.modal-btn-danger:hover {
    background: #dc2626;
}

.modal-overlay.fade-out {
    animation: fadeOut 0.3s ease;
}

.modal-container.slide-out {
    animation: slideOut 0.3s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes fadeOut {
    from { opacity: 1; }
    to { opacity: 0; }
}

@keyframes slideIn {
    from { 
        opacity: 0;
        transform: translateY(-20px) scale(0.95);
    }
    to { 
        opacity: 1;
        transform: translateY(0) scale(1);
    }
}

@keyframes slideOut {
    from { 
        opacity: 1;
        transform: translateY(0) scale(1);
    }
    to { 
        opacity: 0;
        transform: translateY(-20px) scale(0.95);
    }
}

@media (max-width: 768px) {
    .modal-container {
        margin: 1rem;
        max-width: calc(100vw - 2rem);
    }
    
    .modal-header,
    .modal-body,
    .modal-footer {
        padding: 1rem;
    }
    
    .modal-footer {
        flex-direction: column;
    }
}
</style>

<script>
function openModal(title, content, footer = null) {
    const overlay = document.getElementById('modalOverlay');
    const modalTitle = document.getElementById('modalTitle');
    const modalBody = document.getElementById('modalBody');
    const modalFooter = document.getElementById('modalFooter');
    
    modalTitle.textContent = title;
    modalBody.innerHTML = content;
    
    if (footer) {
        modalFooter.innerHTML = footer;
        modalFooter.style.display = 'flex';
    } else {
        modalFooter.style.display = 'none';
    }
    
    overlay.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    const overlay = document.getElementById('modalOverlay');
    overlay.classList.add('fade-out');
    overlay.querySelector('.modal-container').classList.add('slide-out');
    
    setTimeout(() => {
        overlay.style.display = 'none';
        overlay.classList.remove('fade-out');
        overlay.querySelector('.modal-container').classList.remove('slide-out');
        document.body.style.overflow = 'auto';
    }, 300);
}

function confirmDelete(title, message, deleteUrl) {
    const content = `
        <div class="confirm-delete">
            <div class="confirm-icon">
                <i class="fas fa-exclamation-triangle" style="font-size: 3rem; color: #f59e0b;"></i>
            </div>
            <p style="text-align: center; margin: 1rem 0; color: #6b7280;">${message}</p>
        </div>
    `;
    
    const footer = `
        <button class="modal-btn modal-btn-secondary" onclick="closeModal()">
            <i class="fas fa-times"></i> Batal
        </button>
        <form action="${deleteUrl}" method="POST" style="display: inline;">
            <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').getAttribute('content')}">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="modal-btn modal-btn-danger">
                <i class="fas fa-trash"></i> Ya, Hapus
            </button>
        </form>
    `;
    
    openModal(title, content, footer);
}

// Close modal when clicking outside
document.getElementById('modalOverlay').addEventListener('click', function(e) {
    if (e.target === this) {
        closeModal();
    }
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && document.getElementById('modalOverlay').style.display === 'flex') {
        closeModal();
    }
});

// Global modal functions
window.openModal = openModal;
window.closeModal = closeModal;
window.confirmDelete = confirmDelete;
</script> 