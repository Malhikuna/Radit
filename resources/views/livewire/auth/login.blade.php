<style>
    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background: #f3f4f6;
    }

    .container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        width: 360px;
        background: #ffffff;
        padding: 24px;
        border-radius: 10px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .title {
        text-align: center;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    .input {
        width: 100%;
        padding: 10px;
        margin-bottom: 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
    }

    .btn {
        width: 100%;
        padding: 10px;
        background: #2563eb;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 15px;
    }

    .btn:hover {
        background: #1d4ed8;
    }

    .divider {
        text-align: center;
        margin: 20px 0;
        color: #999;
    }

    .social a {
        display: block;
        text-align: center;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 6px;
        margin-bottom: 10px;
        text-decoration: none;
        color: #333;
    }

    .social a:hover {
        background: #f9fafb;
    }

    .footer {
        text-align: center;
        font-size: 13px;
        margin-top: 15px;
    }

    .footer a {
        color: #2563eb;
        text-decoration: none;
    }
</style>

<div class="container">
    <form wire:submit.prevent="login" class="card">
        <div class="title">Login</div>

        <input
            type="email"
            wire:model.defer="email"
            placeholder="Email"
            class="input"
        >

        <input
            type="password"
            wire:model.defer="password"
            placeholder="Password"
            class="input"
        >

        @error('email')
            <p style="color:red; font-size:13px">{{ $message }}</p>
        @enderror

        <button type="submit" class="btn">
            Login
        </button>

        <div class="divider">atau</div>

        <div class="social">
            <a href="/auth/google">Login dengan Google</a>
            <a href="/auth/github">Login dengan GitHub</a>
        </div>

        <div class="footer">
            Belum punya akun?
            <a href="/register">Register</a>
        </div>
    </form>
</div>
