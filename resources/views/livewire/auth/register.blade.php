<style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, #e0f2fe, #f1f5f9);
    }

    .auth-container {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .auth-card {
        background: #ffffff;
        width: 380px;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }

    .auth-card h2 {
        text-align: center;
        margin-bottom: 25px;
        color: #1f2937;
    }

    .form-group {
        margin-bottom: 16px;
    }

    .form-group label {
        display: block;
        font-size: 14px;
        margin-bottom: 6px;
        color: #374151;
    }

    .form-group input {
        width: 100%;
        padding: 10px 12px;
        border-radius: 8px;
        border: 1px solid #d1d5db;
        font-size: 14px;
    }

    .form-group input:focus {
        outline: none;
        border-color: #2563eb;
        box-shadow: 0 0 0 2px rgba(37,99,235,0.2);
    }

    .error {
        color: #dc2626;
        font-size: 12px;
        margin-top: 4px;
    }

    .btn {
        width: 100%;
        padding: 12px;
        background: #2563eb;
        color: #fff;
        border: none;
        border-radius: 10px;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
    }

    .btn:hover {
        background: #1e40af;
    }

    .text-center {
        text-align: center;
        margin-top: 18px;
        font-size: 14px;
    }

    .text-center a {
        color: #2563eb;
        text-decoration: none;
        font-weight: bold;
    }

    .text-center a:hover {
        text-decoration: underline;
    }
</style>

<div class="auth-container">
    <form wire:submit.prevent="register" class="auth-card">
        <h2>Buat Akun</h2>

        <div class="form-group">
            <label>Nama Lengkap</label>
            <input type="text" wire:model.defer="name">
            @error('name') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" wire:model.defer="email">
            @error('email') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Password</label>
            <input type="password" wire:model.defer="password">
            @error('password') <div class="error">{{ $message }}</div> @enderror
        </div>

        <div class="form-group">
            <label>Konfirmasi Password</label>
            <input type="password" wire:model.defer="password_confirmation">
        </div>

        <button class="btn" type="submit">Register</button>

        <div class="text-center">
            Sudah punya akun?
            <a href="/login">Login</a>
        </div>
    </form>
</div>
