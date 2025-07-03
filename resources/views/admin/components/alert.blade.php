@if (session('success'))
    <div class="alert alert-success" id="alert-{{ uniqid() }}">
        <div class="alert-content">
            <i class="fas fa-check-circle"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button class="alert-close" onclick="closeAlert(this)">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-error" id="alert-{{ uniqid() }}">
        <div class="alert-content">
            <i class="fas fa-exclamation-triangle"></i>
            <span>{{ session('error') }}</span>
        </div>
        <button class="alert-close" onclick="closeAlert(this)">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning" id="alert-{{ uniqid() }}">
        <div class="alert-content">
            <i class="fas fa-exclamation-triangle"></i>
            <span>{{ session('warning') }}</span>
        </div>
        <button class="alert-close" onclick="closeAlert(this)">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info" id="alert-{{ uniqid() }}">
        <div class="alert-content">
            <i class="fas fa-info-circle"></i>
            <span>{{ session('info') }}</span>
        </div>
        <button class="alert-close" onclick="closeAlert(this)">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-error" id="alert-{{ uniqid() }}">
        <div class="alert-content">
            <i class="fas fa-exclamation-triangle"></i>
            <div>
                <strong>Terjadi kesalahan:</strong>
                <ul style="margin-top: 0.5rem; margin-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <button class="alert-close" onclick="closeAlert(this)">
            <i class="fas fa-times"></i>
        </button>
    </div>
@endif

<style>
.alert {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    padding: 1rem;
    border-radius: 0.5rem;
    margin-bottom: 1rem;
    border: 1px solid;
    animation: slideIn 0.3s ease;
}

.alert-content {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    flex: 1;
}

.alert-content i {
    margin-top: 0.125rem;
    flex-shrink: 0;
}

.alert-close {
    background: none;
    border: none;
    color: inherit;
    cursor: pointer;
    padding: 0.25rem;
    border-radius: 0.25rem;
    transition: all 0.3s ease;
    flex-shrink: 0;
}

.alert-close:hover {
    background: rgba(0, 0, 0, 0.1);
}

.alert-success {
    background: #d1fae5;
    color: #065f46;
    border-color: #a7f3d0;
}

.alert-error {
    background: #fef2f2;
    color: #991b1b;
    border-color: #fecaca;
}

.alert-warning {
    background: #fef3c7;
    color: #92400e;
    border-color: #fcd34d;
}

.alert-info {
    background: #dbeafe;
    color: #1e40af;
    border-color: #93c5fd;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.alert.fade-out {
    animation: slideOut 0.3s ease forwards;
}

@keyframes slideOut {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-10px);
    }
}
</style>

<script>
function closeAlert(button) {
    const alert = button.closest('.alert');
    alert.classList.add('fade-out');
    setTimeout(() => {
        alert.remove();
    }, 300);
}

// Auto-hide alerts after 5 seconds
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    alerts.forEach(alert => {
        setTimeout(() => {
            if (alert && alert.parentNode) {
                alert.classList.add('fade-out');
                setTimeout(() => {
                    if (alert && alert.parentNode) {
                        alert.remove();
                    }
                }, 300);
            }
        }, 5000);
    });
});
</script> 