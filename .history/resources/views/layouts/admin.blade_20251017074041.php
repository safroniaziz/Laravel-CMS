<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') - {{ $siteSettings['name'] ?? 'CMS' }} Admin</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Custom Admin CSS -->
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        .sidebar { min-height: 100vh; background: #2c3e50; color: white; }
        .sidebar .nav-link { color: #ecf0f1; padding: 12px 20px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #34495e; color: white; }
        .main-content { background: #ecf0f1; min-height: 100vh; }
        .card { border: none; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .stat-card { padding: 20px; border-radius: 8px; }
        .stat-card .icon { font-size: 2.5rem; opacity: 0.7; }
        .navbar-brand { font-weight: bold; }
        .btn-sm { padding: 5px 10px; font-size: 0.875rem; }
    </style>
    @stack('styles')
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav class="col-md-2 d-md-block sidebar">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4>{{ $siteSettings['name'] ?? 'CMS' }}</h4>
                        <small>Admin Panel</small>
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ active_route('admin.dashboard') }}" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_route('admin.posts.*') }}" href="{{ route('admin.posts.index') }}">
                                <i class="fas fa-file-alt"></i> Posts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_route('admin.pages.*') }}" href="{{ route('admin.pages.index') }}">
                                <i class="fas fa-file"></i> Pages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_route('admin.media.*') }}" href="{{ route('admin.media.index') }}">
                                <i class="fas fa-image"></i> Media
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_route('admin.categories.*') }}" href="{{ route('admin.categories.index') }}">
                                <i class="fas fa-folder"></i> Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_route('admin.services.*') }}" href="{{ route('admin.services.index') }}">
                                <i class="fas fa-concierge-bell"></i> Services
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_route('admin.portfolios.*') }}" href="{{ route('admin.portfolios.index') }}">
                                <i class="fas fa-briefcase"></i> Portfolio
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_route('admin.careers.*') }}" href="{{ route('admin.careers.index') }}">
                                <i class="fas fa-user-tie"></i> Careers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_route('admin.contacts.*') }}" href="{{ route('admin.contacts.index') }}">
                                <i class="fas fa-envelope"></i> Contacts
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_route('admin.menus.*') }}" href="{{ route('admin.menus.index') }}">
                                <i class="fas fa-bars"></i> Menus
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_route('admin.users.*') }}" href="{{ route('admin.users.index') }}">
                                <i class="fas fa-users"></i> Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_route('admin.settings.*') }}" href="{{ route('admin.settings.index') }}">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ active_route('admin.backup.*') }}" href="{{ route('admin.backup.index') }}">
                                <i class="fas fa-database"></i> Backup
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main class="col-md-10 ms-sm-auto main-content">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom bg-white px-3">
                    <h1 class="h2">@yield('page-title', 'Dashboard')</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary" target="_blank">
                            <i class="fas fa-eye"></i> View Site
                        </a>
                        <form action="{{ route('logout') }}" method="POST" class="d-inline ms-2">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>

                <div class="container-fluid px-3">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Common AJAX Setup -->
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Common delete function
        function deleteItem(url, message = 'Are you sure you want to delete this item?') {
            if (confirm(message)) {
                $.ajax({
                    url: url,
                    method: 'DELETE',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload();
                        }
                    },
                    error: function(xhr) {
                        alert('Error: ' + (xhr.responseJSON?.message || 'Something went wrong'));
                    }
                });
            }
        }

        // Common form submit
        function submitForm(formId, url, method = 'POST') {
            const formData = $(formId).serialize();

            $.ajax({
                url: url,
                method: method,
                data: formData,
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        } else {
                            location.reload();
                        }
                    }
                },
                error: function(xhr) {
                    if (xhr.responseJSON?.errors) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = '';
                        for (let key in errors) {
                            errorMsg += errors[key].join('\\n') + '\\n';
                        }
                        alert('Validation errors:\\n' + errorMsg);
                    } else {
                        alert('Error: ' + (xhr.responseJSON?.message || 'Something went wrong'));
                    }
                }
            });
        }
    </script>

    @stack('scripts')
</body>
</html>

