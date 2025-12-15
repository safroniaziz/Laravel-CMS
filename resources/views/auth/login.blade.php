<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CMS Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #1a246a 0%, #2d3a8c 100%);
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 420px;
        }

        .login-card {
            background: white;
            border-radius: 16px;
            padding: 48px 40px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.2);
        }

        /* Header */
        .login-header {
            text-align: center;
            margin-bottom: 36px;
        }

        .logo-icon {
            width: 60px;
            height: 60px;
            background: #1a246a;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }

        .logo-icon i {
            font-size: 26px;
            color: white;
        }

        .login-header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 6px;
        }

        .login-header p {
            font-size: 14px;
            color: #64748b;
        }

        /* Alert */
        .alert {
            padding: 12px 14px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fee2e2;
            color: #b91c1c;
        }

        .alert ul {
            list-style: none;
        }

        /* Form */
        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
            font-size: 14px;
        }

        .form-input {
            width: 100%;
            padding: 12px 12px 12px 42px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .form-input:focus {
            outline: none;
            border-color: #1a246a;
            box-shadow: 0 0 0 3px rgba(26, 36, 106, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        /* Options */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
        }

        .remember-check {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember-check input {
            width: 16px;
            height: 16px;
            accent-color: #1a246a;
        }

        .remember-check span {
            font-size: 13px;
            color: #4b5563;
        }

        .forgot-link {
            font-size: 13px;
            color: #1a246a;
            text-decoration: none;
            font-weight: 500;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        /* Button */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: #1a246a;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: background 0.2s;
        }

        .btn-login:hover {
            background: #151d54;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #6b7280;
            text-decoration: none;
        }

        .back-link:hover {
            color: #1a246a;
        }

        /* Copyright */
        .copyright {
            text-align: center;
            margin-top: 24px;
            font-size: 12px;
            color: rgba(255,255,255,0.6);
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo-icon">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <h1>Admin Panel</h1>
                <p>Sign in to your account</p>
            </div>

            @if(session('error'))
            <div class="alert alert-warning" style="background: #fff3cd; border-left: 4px solid #ffc107; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                <i class="fas fa-exclamation-triangle" style="color: #ffc107; margin-right: 10px;"></i>
                <span style="color: #856404;">{{ session('error') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label">Email</label>
                    <div class="input-wrapper">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" name="email" class="form-input" value="{{ old('email') }}" placeholder="you@example.com" required autofocus>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <div class="input-wrapper">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" name="password" class="form-input" placeholder="Enter password" required>
                    </div>
                </div>

                <div class="form-options">
                    <label class="remember-check">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn-login">Sign In</button>
            </form>

            <div class="login-footer">
                <a href="/" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Back to website
                </a>
            </div>
        </div>

        <p class="copyright">&copy; {{ date('Y') }} All rights reserved.</p>
    </div>

    <script>
        // Enhanced CSRF token management
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const csrfInput = document.querySelector('input[name="_token"]');
            let tokenRefreshInterval;
            let countdownInterval;
            let timeLeft = 600; // 10 minutes in seconds
            
            // Create countdown display (hidden by default)
            const countdownDiv = document.createElement('div');
            countdownDiv.style.cssText = 'position: fixed; bottom: 20px; right: 20px; background: rgba(26,36,106,0.9); color: white; padding: 12px 20px; border-radius: 8px; font-size: 13px; display: none; box-shadow: 0 4px 12px rgba(0,0,0,0.2);';
            countdownDiv.innerHTML = '<i class="fas fa-clock me-2"></i><span id="countdown">10:00</span>';
            document.body.appendChild(countdownDiv);
            
            // Function to refresh CSRF token
            function refreshCSRFToken() {
                fetch('{{ route("login") }}', {
                    method: 'GET',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newToken = doc.querySelector('input[name="_token"]');
                    
                    if (newToken && csrfInput) {
                        csrfInput.value = newToken.value;
                        console.log('CSRF token refreshed successfully');
                        timeLeft = 600; // Reset countdown
                    }
                })
                .catch(error => {
                    console.error('Failed to refresh CSRF token:', error);
                });
            }
            
            // Auto-refresh token every 10 minutes
            function startTokenRefresh() {
                // Refresh immediately after 9 minutes (1 minute before expiry)
                tokenRefreshInterval = setInterval(refreshCSRFToken, 9 * 60 * 1000);
            }
            
            // Countdown timer
            function startCountdown() {
                countdownInterval = setInterval(function() {
                    timeLeft--;
                    
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    const display = `${minutes}:${seconds.toString().padStart(2, '0')}`;
                    
                    const countdownSpan = document.getElementById('countdown');
                    if (countdownSpan) {
                        countdownSpan.textContent = display;
                    }
                    
                    // Show warning when 2 minutes left
                    if (timeLeft === 120) {
                        countdownDiv.style.display = 'block';
                        countdownDiv.style.background = 'rgba(237, 137, 54, 0.9)'; // Orange warning
                    }
                    
                    // Auto-refresh at 30 seconds
                    if (timeLeft === 30) {
                        refreshCSRFToken();
                        countdownDiv.innerHTML = '<i class="fas fa-sync-alt fa-spin me-2"></i>Refreshing...';
                        setTimeout(() => {
                            countdownDiv.style.display = 'none';
                        }, 2000);
                    }
                    
                    if (timeLeft <= 0) {
                        clearInterval(countdownInterval);
                        refreshCSRFToken();
                        timeLeft = 600;
                        startCountdown();
                    }
                }, 1000);
            }
            
            // Handle form submission with CSRF check
            if (form) {
                form.addEventListener('submit', function(e) {
                    // Check if token looks old/expired (basic check)
                    const submitTime = Date.now();
                    const formLoadTime = window.performance.timing.domContentLoadedEventEnd;
                    const timeSinceLoad = (submitTime - formLoadTime) / 1000 / 60; // in minutes
                    
                    // If form loaded more than 10 minutes ago, refresh token before submit
                    if (timeSinceLoad > 10) {
                        e.preventDefault();
                        
                        // Show refreshing message
                        const submitBtn = form.querySelector('button[type="submit"]');
                        const originalText = submitBtn.innerHTML;
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = '<i class="fas fa-sync-alt fa-spin me-2"></i>Refreshing security token...';
                        
                        refreshCSRFToken();
                        
                        // Submit after token refresh
                        setTimeout(() => {
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = originalText;
                            form.submit();
                        }, 1000);
                    }
                });
            }
            
            // Start auto-refresh and countdown
            startTokenRefresh();
            startCountdown();
            
            // Check if there are validation errors (CSRF expired scenario)
            @if($errors->any())
                @if($errors->has('token') || session('message') === 'CSRF token mismatch.')
                    // CSRF error - refresh page with clean URL
                    if (window.location.search || window.location.hash) {
                        window.history.replaceState({}, document.title, '{{ route("login") }}');
                    }
                    
                    // Show friendly error message
                    const errorDiv = document.createElement('div');
                    errorDiv.style.cssText = 'position: fixed; top: 20px; left: 50%; transform: translateX(-50%); background: #ef4444; color: white; padding: 15px 25px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.2); z-index: 1000;';
                    errorDiv.innerHTML = '<i class="fas fa-exclamation-triangle me-2"></i>Session expired. Page refreshed with new security token.';
                    document.body.appendChild(errorDiv);
                    
                    setTimeout(() => {
                        errorDiv.style.opacity = '0';
                        errorDiv.style.transition = 'opacity 0.3s';
                        setTimeout(() => errorDiv.remove(), 300);
                    }, 4000);
                    
                    // Auto-refresh the page to get new token
                    setTimeout(() => {
                        window.location.href = '{{ route("login") }}';
                    }, 1500);
                @endif
            @endif

            // Clean URL on page load
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('session_expired') || urlParams.has('_token')) {
                window.history.replaceState({}, document.title, '{{ route("login") }}');
            }
        });
    </script>

</body>
</html>
