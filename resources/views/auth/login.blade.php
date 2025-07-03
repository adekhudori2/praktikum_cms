<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Login — Sistem Pendaftaran Mahasiswa</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Muli:300,400,700,900&display=swap" rel="stylesheet">
    <style>
      body {
        background: linear-gradient(120deg, #e0e7ff 0%, #f8fafc 100%);
        min-height: 100vh;
        font-family: 'Muli', 'Montserrat', Arial, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .login-card {
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 8px 32px rgba(0,0,0,0.12);
        max-width: 410px;
        width: 100%;
        padding: 38px 32px 32px 32px;
        position: relative;
      }
      .login-card:before {
        content: '';
        position: absolute;
        top: -32px;
        left: 50%;
        transform: translateX(-50%);
        width: 80px;
        height: 80px;
        background: #0d6efd;
        border-radius: 50%;
        box-shadow: 0 4px 24px rgba(13,110,253,0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
      }
      .login-card .academic-icon {
        position: absolute;
        top: -18px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 2.8rem;
        color: #fff;
        z-index: 2;
      }
      .login-title {
        font-family: 'Montserrat', Arial, sans-serif;
        font-size: 2rem;
        font-weight: 700;
        color: #0d6efd;
        text-align: center;
        margin-bottom: 8px;
        margin-top: 32px;
      }
      .login-desc {
        text-align: center;
        color: #555;
        margin-bottom: 24px;
        font-size: 1.05rem;
      }
      .role-selector {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
      }
      .role-option {
        flex: 1;
        padding: 15px 0 10px 0;
        border: 2px solid #e0e7ff;
        border-radius: 10px;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s ease;
        background: #f8fafc;
        font-family: 'Montserrat', Arial, sans-serif;
      }
      .role-option:hover {
        border-color: #0d6efd;
        background: #e0e7ff;
      }
      .role-option.active {
        border-color: #0d6efd;
        background: #0d6efd;
        color: white;
      }
      .role-option input[type="radio"] {
        display: none;
      }
      .role-icon {
        font-size: 2rem;
        margin-bottom: 8px;
        display: block;
      }
      .alert-sm {
        padding: 0.5rem 0.75rem;
        font-size: 0.95rem;
        margin-bottom: 1rem;
        background: #e9f7fe;
        color: #0d6efd;
        border-radius: 6px;
        text-align: center;
      }
      .role-option.wrong-role {
        border-color: #dc3545;
        background: #f8d7da;
        color: #721c24;
      }
      .form-input {
        width: 100%;
        padding: 11px 13px;
        border: 1.5px solid #e0e7ff;
        border-radius: 8px;
        margin-bottom: 18px;
        font-size: 1rem;
        background: #f8fafc;
        font-family: 'Muli', Arial, sans-serif;
      }
      .form-input:focus {
        border-color: #0d6efd;
        outline: none;
        background: #fff;
      }
      .login-btn {
        width: 100%;
        padding: 11px;
        background: #0d6efd;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 1.08rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
        font-family: 'Montserrat', Arial, sans-serif;
        margin-top: 8px;
      }
      .login-btn:hover {
        background: #084298;
      }
      .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border-radius: 6px;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        text-align: center;
      }
      @media (max-width: 500px) {
        .login-card { padding: 18px 6px 18px 6px; }
        .login-title { font-size: 1.3rem; }
      }
    </style>
  </head>

  <body>
    <div class="login-card">
      <div class="academic-icon">🎓</div>
      <div class="login-title">Sistem Pendaftaran Mahasiswa</div>
      <div class="login-desc">Silakan pilih role dan login untuk melanjutkan ke sistem akademik.</div>
      <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        @if ($errors->any())
          <div class="alert-danger">{{ $errors->first() }}</div>
        @endif
        <div class="role-selector">
          <label class="role-option" onclick="selectRole('mahasiswa')">
            <input type="radio" name="role" value="mahasiswa" checked>
            <span class="role-icon">👨‍🎓</span>
            <strong>Mahasiswa</strong><br>
            <small>Akses dashboard mahasiswa</small>
          </label>
          <label class="role-option" onclick="selectRole('admin')">
            <input type="radio" name="role" value="admin">
            <span class="role-icon">👨‍💼</span>
            <strong>Admin</strong><br>
            <small>Akses dashboard admin</small>
          </label>
        </div>
        <div class="alert-sm">
          <strong>Penting:</strong> Pilih role yang sesuai dengan akun Anda. Admin hanya bisa login sebagai admin, mahasiswa hanya bisa login sebagai mahasiswa.
        </div>
        <input type="text" name="username" class="form-input" placeholder="Username" required autofocus>
        <input type="password" name="password" class="form-input" placeholder="Password" required>
        <button type="submit" class="login-btn">Login</button>
      </form>
    </div>
    <script>
      function selectRole(role) {
        document.querySelectorAll('.role-option').forEach(option => {
          option.classList.remove('active', 'wrong-role');
        });
        event.target.closest('.role-option').classList.add('active');
        document.querySelector(`input[value="${role}"]`).checked = true;
      }
      document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('input[value="mahasiswa"]').closest('.role-option').classList.add('active');
        const errorMessages = document.querySelectorAll('.alert-danger');
        errorMessages.forEach(error => {
          if (error.textContent.includes('Role yang dipilih tidak sesuai')) {
            const selectedRole = document.querySelector('input[name="role"]:checked');
            if (selectedRole) {
              selectedRole.closest('.role-option').classList.add('wrong-role');
            }
          }
        });
      });
    </script>
  </body>
</html>
