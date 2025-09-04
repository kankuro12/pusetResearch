<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <title>Admin Login</title>
    <style>
        :root{
            --card-bg: #ffffff;
            --accent-start: #4fd1c5;
            --accent-end: #60d09a;
            --muted: #6b7280;
        }
        html,body{
            height:100%;
            font-family: 'Inter', system-ui, -apple-system, 'Segoe UI', Roboto, 'Helvetica Neue', Arial;
            background: radial-gradient(1200px 600px at 10% 10%, rgba(96,208,154,0.08), transparent 10%),
                        radial-gradient(1000px 500px at 90% 90%, rgba(79,209,197,0.06), transparent 10%),
                        linear-gradient(180deg, #f8fafc 0%, #f1f6f4 100%);
        }

        .center-wrap{
            min-height:100%;
            display:flex;
            align-items:center;
            justify-content:center;
            padding: 40px 20px;
        }

        .card-login{
            width:100%;
            max-width:460px;
            background: var(--card-bg);
            border-radius:16px;
            box-shadow: 0 10px 30px rgba(15,23,42,0.08);
            padding:28px;
            border: 1px solid rgba(15,23,42,0.03);
            transform: translateY(10px);
            animation: floatIn .45s ease-out forwards;
        }

        @keyframes floatIn{
            from{opacity:0; transform: translateY(18px);}
            to{opacity:1; transform: translateY(0);}
        }

        .brand{
            display:flex;
            align-items:center;
            gap:12px;
            margin-bottom:18px;
        }

        .brand .logo{
            width:52px;
            height:52px;
            border-radius:10px;
            background: linear-gradient(135deg,var(--accent-start),var(--accent-end));
            display:flex;
            align-items:center;
            justify-content:center;
            color:#fff;
            font-weight:700;
            font-size:18px;
            box-shadow: 0 6px 18px rgba(96,208,154,0.15);
        }

        .brand h3{
            margin:0;
            font-size:20px;
            font-weight:700;
            color:#0f172a;
        }

        .lead{
            color:var(--muted);
            margin-bottom:18px;
        }

        .form-control{
            padding:14px 14px 14px 44px;
            height:auto;
            border-radius:12px;
            border:1px solid rgba(15,23,42,0.06);
            transition: box-shadow .15s ease, border-color .15s ease;
            background: #fff;
        }

        .form-group {
            position:relative;
        }

        .input-icon{
            position:absolute;
            left:12px;
            top:50%;
            transform:translateY(-50%);
            width:20px;
            height:20px;
            opacity:0.9;
        }

        /* show/hide password button */
        .toggle-password{
            position:absolute;
            right:12px;
            top:50%;
            transform:translateY(-50%);
            background:transparent;
            border:none;
            padding:6px;
            display:flex;
            align-items:center;
            justify-content:center;
            cursor:pointer;
            border-radius:8px;
        }

        .toggle-password svg{ width:20px; height:20px; color:#94A3B8; }

        .form-control:focus{
            box-shadow: 0 6px 20px rgba(79,209,197,0.12);
            border-color: var(--accent-start);
            outline: none;
        }

        .btn-gradient{
            background: linear-gradient(90deg,var(--accent-start),var(--accent-end));
            border:none;
            color:#fff;
            padding:12px 18px;
            border-radius:12px;
            font-weight:600;
            transition: transform .08s ease, box-shadow .08s ease;
        }

        .btn-gradient:active{transform:translateY(1px)}

        .small-link{
            color:var(--muted);
            font-size:13px;
        }

        .captcha-wrap{margin:12px 0 8px}

        @media (max-width:575px){
            .card-login{padding:20px}
            .brand h3{font-size:18px}
        }
    </style>
</head>

<body>
    <div class="center-wrap">
        <div class="card-login">
            <div class="brand">
                <div>
                    <h3>Admin Portal</h3>
                    <div class="lead">Sign in to manage your application</div>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <form action="{{ Route('admin.login') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 12c2.761 0 5-2.239 5-5s-2.239-5-5-5-5 2.239-5 5 2.239 5 5 5z" stroke="#94A3B8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <input type="email" class="form-control" id="email" name="{{ $loginInfo['u'] }}" placeholder="Email" required>
                </div>

                <div class="form-group mb-3">
                    <svg class="input-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="11" width="18" height="9" rx="2" stroke="#94A3B8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 11V8a5 5 0 0110 0v3" stroke="#94A3B8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <input type="password" class="form-control" id="password" name="{{ $loginInfo['p'] }}" placeholder="Password" required>
                    <button type="button" class="toggle-password" id="toggleAdminPassword" aria-label="Show password" title="Show password">
                         <!-- eye icon (initial: closed eye) -->
                         <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke="#94A3B8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" stroke="#94A3B8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                     </button>
                </div>

                <div class="captcha-wrap">
                    {!! app('captcha')->display(['data-callback' => 'onAdminRecaptchaSuccess', 'data-expired-callback' => 'onAdminRecaptchaExpired', 'data-error-callback' => 'onAdminRecaptchaError']) !!}
                    @if ($errors->has('g-recaptcha-response'))
                        <div class="text-danger small mt-1">{{ $errors->first('g-recaptcha-response') }}</div>
                    @endif
                </div>

                <div class="d-flex align-items-center justify-content-between mt-3">
                    <div>
                        <a href="#" class="small-link">Forgot password?</a>
                    </div>
                    <div>
                        <button type="submit" id="adminLoginBtn" class="btn btn-gradient" disabled style="opacity:0.6; cursor:not-allowed;">Login</button>
                    </div>
                </div>
            </form>
            <div class="text-center mt-4 small-link">Powered by {{config('app.name')}}</div>
        </div>
    </div>

    {!! app('captcha')->renderJs() !!}
    <script>
        console.log('Admin login reCAPTCHA callbacks loaded');

        // Expose toggle function and attach after DOM ready to avoid reference errors
        function _toggleAdminPasswordImpl() {
            const pwd = document.getElementById('password');
            const btn = document.getElementById('toggleAdminPassword');
            if (!pwd || !btn) return;

            if (pwd.type === 'password') {
                pwd.type = 'text';
                btn.setAttribute('aria-label', 'Hide password');
                btn.setAttribute('title', 'Hide password');
                btn.innerHTML = '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M1 12s4-7 11-7 11 7 11 7-4 7-11 7S1 12 1 12z" stroke="#94A3B8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="12" cy="12" r="3" stroke="#94A3B8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
            } else {
                pwd.type = 'password';
                btn.setAttribute('aria-label', 'Show password');
                btn.setAttribute('title', 'Show password');
                btn.innerHTML = '<svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><rect x="3" y="11" width="18" height="9" rx="2" stroke="#94A3B8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/><path d="M7 11V8a5 5 0 0110 0v3" stroke="#94A3B8" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>';
            }
        }

        window.toggleAdminPassword = function(){ _toggleAdminPasswordImpl(); };

        document.addEventListener('DOMContentLoaded', function(){
            const btn = document.getElementById('toggleAdminPassword');
            if (btn) btn.addEventListener('click', _toggleAdminPasswordImpl);
        });

        function enableAdminLoginButton() {
            const btn = document.getElementById('adminLoginBtn');
            if (btn) {
                btn.disabled = false;
                btn.style.opacity = '1';
                btn.style.cursor = 'pointer';
            }
        }

        function disableAdminLoginButton() {
            const btn = document.getElementById('adminLoginBtn');
            if (btn) {
                btn.disabled = true;
                btn.style.opacity = '0.6';
                btn.style.cursor = 'not-allowed';
            }
        }

        window.onAdminRecaptchaSuccess = function(response) {
            console.log('Admin reCAPTCHA success', response);
            enableAdminLoginButton();
        };

        window.onAdminRecaptchaExpired = function() {
            console.log('Admin reCAPTCHA expired');
            disableAdminLoginButton();
        };

        window.onAdminRecaptchaError = function() {
            console.log('Admin reCAPTCHA error');
            disableAdminLoginButton();
        };
    </script>
</body>

</html>
