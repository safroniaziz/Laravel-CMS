<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Login</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

        <!-- Particles.js -->
        <script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            body {
                font-family: 'Inter', sans-serif;
            }

            /* Glass morphism effect */
            .glass-effect {
                background: rgba(255, 255, 255, 0.95);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            /* Modern form inputs */
            .form-input-modern {
                background: rgba(255, 255, 255, 0.9);
                backdrop-filter: blur(10px);
                border: 2px solid rgba(34, 197, 94, 0.1);
                transition: all 0.3s ease;
            }

            .form-input-modern:focus {
                background: rgba(255, 255, 255, 0.95);
                border-color: rgba(34, 197, 94, 0.5);
                box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.1);
                transform: translateY(-1px);
            }

            /* Village green gradient button */
            .btn-gradient {
                background: linear-gradient(135deg, #22c55e 0%, #16a34a 50%, #15803d 100%);
                box-shadow: 0 8px 20px rgba(34, 197, 94, 0.3);
                transition: all 0.3s ease;
            }

            .btn-gradient:hover {
                background: linear-gradient(135deg, #16a34a 0%, #15803d 50%, #166534 100%);
                box-shadow: 0 12px 30px rgba(34, 197, 94, 0.4);
                transform: translateY(-2px);
            }

            /* Village nature gradient */
            .auth-container {
                background: linear-gradient(135deg, #22c55e 0%, #16a34a 25%, #15803d 50%, #166534 75%, #14532d 100%);
                position: relative;
                overflow: hidden;
            }

            /* Floating animation */
            @keyframes float {
                0%, 100% { transform: translateY(0px) rotate(0deg); }
                33% { transform: translateY(-8px) rotate(1deg); }
                66% { transform: translateY(4px) rotate(-1deg); }
            }

        /* Floating Orbs - Smaller and more compact */
        .floating-orb {
            position: absolute;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.1);
            animation: float 6s ease-in-out infinite;
        }

        .orb-1 {
            width: 100px;
            height: 100px;
            top: 15%;
            left: 8%;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 60px;
            height: 60px;
            top: 55%;
            right: 12%;
            animation-delay: 2s;
        }

        .orb-3 {
            width: 120px;
            height: 120px;
            bottom: 8%;
            left: 15%;
            animation-delay: 4s;
        }            /* Text shadow */
            .text-shadow {
                text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            }

            /* Feature cards */
            .feature-card {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                transition: all 0.3s ease;
            }

            .feature-card:hover {
                background: rgba(255, 255, 255, 0.15);
                transform: translateY(-2px);
            }

            /* Slide in animation */
            @keyframes slideIn {
                from {
                    opacity: 0;
                    transform: translateX(-30px);
                }
                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .slide-in {
                animation: slideIn 0.6s ease-out;
            }

            /* Logo animation */
            @keyframes logoFloat {
                0%, 100% { transform: translateY(0px); }
                50% { transform: translateY(-5px); }
            }

            .logo-animation {
                animation: logoFloat 3s ease-in-out infinite;
            }

            /* Particles container */
            #particles-js {
                position: absolute;
                width: 100%;
                height: 100%;
                top: 0;
                left: 0;
            }

            /* Village theme colors */
            .text-village-primary { color: #22c55e; }
            .text-village-secondary { color: #16a34a; }
            .bg-village-light { background-color: rgba(34, 197, 94, 0.1); }
            .border-village { border-color: rgba(34, 197, 94, 0.2); }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex">
            {{ $slot }}
        </div>
    </body>
</html>
