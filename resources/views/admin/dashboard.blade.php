@extends('layouts.dashboard.dashboard')

@section('title', 'Dashboard')
@section('menu', 'Dashboard')

@section('link')
    <li class="breadcrumb-item">
        <span class="bullet bg-gray-500 w-5px h-2px"></span>
    </li>
    <li class="breadcrumb-item text-gray-700">Dashboard</li>
@endsection

@section('content')
<div id="kt_app_content" class="app-content flex-column-fluid">
    <div id="kt_app_content_container" class="app-container container-xxl">
        
        <!-- Welcome Banner with Gradient -->
        <div class="card mb-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
            <div class="card-body p-9">
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1">
                        <h1 class="text-white fw-bolder mb-2">Welcome back, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-white opacity-75 mb-0 fs-5">
                            <i class="fas fa-user-shield me-2"></i>{{ Auth::user()->role->name ?? 'User' }}
                            <span class="mx-3">•</span>
                            <i class="fas fa-calendar me-2"></i>{{ date('l, d F Y') }}
                        </p>
                    </div>
                    <div class="text-end">
                        <div class="text-white opacity-75 fs-7 mb-1">Last Login</div>
                        <div class="text-white fw-bold fs-5">{{ Auth::user()->updated_at->diffForHumans() }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gradient Stats Cards -->
        <div class="row g-5 g-xl-8 mb-5 mb-xl-8">
            <!-- Total Posts -->
            <div class="col-xl-3">
                <div class="card card-flush h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                    <div class="card-body d-flex flex-column p-7">
                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-50px me-4">
                                <span class="symbol-label bg-white bg-opacity-20">
                                    <i class="fas fa-newspaper fs-2x text-white"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-white opacity-75 fw-semibold d-block fs-7">Total Posts</span>
                                <span class="text-white fw-bolder fs-2x">{{ $stats['total_posts'] }}</span>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between text-white opacity-75 fs-7">
                            <span><i class="fas fa-check-circle me-1"></i>Published: {{ $stats['published_posts'] }}</span>
                            <span><i class="fas fa-edit me-1"></i>Draft: {{ $stats['draft_posts'] }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pages -->
            <div class="col-xl-3">
                <div class="card card-flush h-100" style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border: none;">
                    <div class="card-body d-flex flex-column p-7">
                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-50px me-4">
                                <span class="symbol-label bg-white bg-opacity-20">
                                    <i class="fas fa-file-alt fs-2x text-white"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-white opacity-75 fw-semibold d-block fs-7">Total Pages</span>
                                <span class="text-white fw-bolder fs-2x">{{ $stats['total_pages'] }}</span>
                            </div>
                        </div>
                        <div class="text-white opacity-75 fs-7">
                            <i class="fas fa-layer-group me-1"></i>Static pages
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="col-xl-3">
                <div class="card card-flush h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); border: none;">
                    <div class="card-body d-flex flex-column p-7">
                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-50px me-4">
                                <span class="symbol-label bg-white bg-opacity-20">
                                    <i class="fas fa-users fs-2x text-white"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-white opacity-75 fw-semibold d-block fs-7">Total Users</span>
                                <span class="text-white fw-bolder fs-2x">{{ $stats['total_users'] }}</span>
                            </div>
                        </div>
                        <div class="text-white opacity-75 fs-7">
                            <i class="fas fa-user-shield me-1"></i>Admins & editors
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Files -->
            <div class="col-xl-3">
                <div class="card card-flush h-100" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%); border: none;">
                    <div class="card-body d-flex flex-column p-7">
                        <div class="d-flex align-items-center mb-5">
                            <div class="symbol symbol-50px me-4">
                                <span class="symbol-label bg-white bg-opacity-20">
                                    <i class="fas fa-images fs-2x text-white"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-white opacity-75 fw-semibold d-block fs-7">Media Files</span>
                                <span class="text-white fw-bolder fs-2x">{{ $stats['total_media'] }}</span>
                            </div>
                        </div>
                        <div class="text-white opacity-75 fs-7">
                            <i class="fas fa-photo-video me-1"></i>Images & videos
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row -->
        <div class="row g-5 g-xl-8 mb-5 mb-xl-8">
            <!-- Posts Chart -->
            <div class="col-xl-8">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Content Overview</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">Posts status distribution</span>
                        </h3>
                    </div>
                    <div class="card-body pt-6">
                        <canvas id="postsChart" height="80"></canvas>
                    </div>
                </div>
            </div>

            <!-- Posts Status Pie -->
            <div class="col-xl-4">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Posts Status</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">Published vs Draft</span>
                        </h3>
                    </div>
                    <div class="card-body pt-6 d-flex align-items-center justify-content-center">
                        <canvas id="statusChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Posts & Activity -->
        <div class="row g-5 g-xl-8">
            <!-- Recent Posts -->
            <div class="col-xl-8">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Recent Posts</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">Latest content updates</span>
                        </h3>
                        <div class="card-toolbar">
                            <a href="{{ route('posts.index') }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-plus"></i> New Post
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        @forelse($recent_posts as $post)
                        <div class="d-flex align-items-center mb-7">
                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label" style="background: linear-gradient(135deg, {{ ['#667eea', '#f093fb', '#4facfe', '#fa709a'][($loop->index % 4)] }} 0%, {{ ['#764ba2', '#f5576c', '#00f2fe', '#fee140'][($loop->index % 4)] }} 100%);">
                                    <i class="fas fa-newspaper fs-2x text-white"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <a href="#" class="text-gray-800 text-hover-primary fw-bold fs-6">{{ Str::limit($post->title, 60) }}</a>
                                <div class="text-gray-500 fw-semibold fs-7 mt-1">
                                    <span class="badge badge-light-{{ $post->status == 'published' ? 'success' : 'warning' }} me-2">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                    <i class="fas fa-folder me-1"></i>{{ $post->category->name ?? 'Uncategorized' }}
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-clock me-1"></i>{{ $post->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-10">
                            <i class="fas fa-file-alt fs-3x text-gray-400 mb-4"></i>
                            <p class="text-gray-500">No posts yet. Create your first post!</p>
                            <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus"></i> Create Post
                            </a>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="col-xl-4">
                <div class="card card-flush h-xl-100">
                    <div class="card-header pt-7">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold text-gray-800">Recent Contacts</span>
                            <span class="text-gray-500 mt-1 fw-semibold fs-6">Latest messages</span>
                        </h3>
                        <div class="card-toolbar">
                            <a href="{{ route('contacts.index') }}" class="btn btn-sm btn-light">View All</a>
                        </div>
                    </div>
                    <div class="card-body pt-5">
                        @forelse($recent_contacts as $contact)
                        <div class="d-flex align-items-sm-center mb-7">
                            <div class="symbol symbol-45px me-4">
                                <span class="symbol-label bg-light-primary text-primary fw-bold fs-5">
                                    {{ strtoupper(substr($contact->name, 0, 1)) }}
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <span class="text-gray-800 fw-bold d-block fs-6">{{ Str::limit($contact->name, 20) }}</span>
                                <span class="text-gray-500 fw-semibold d-block fs-7">{{ Str::limit($contact->subject, 30) }}</span>
                            </div>
                            <span class="badge badge-light-info fs-8">{{ $contact->created_at->diffForHumans() }}</span>
                        </div>
                        @empty
                        <div class="text-center py-10">
                            <i class="fas fa-envelope fs-3x text-gray-400 mb-4"></i>
                            <p class="text-gray-500">No contacts yet</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Posts Bar Chart
    const postsCtx = document.getElementById('postsChart');
    if (postsCtx) {
        new Chart(postsCtx, {
            type: 'bar',
            data: {
                labels: ['Total Posts', 'Published', 'Draft', 'Pages', 'Media'],
                datasets: [{
                    label: 'Content Statistics',
                    data: [
                        {{ $stats['total_posts'] }},
                        {{ $stats['published_posts'] }},
                        {{ $stats['draft_posts'] }},
                        {{ $stats['total_pages'] }},
                        {{ $stats['total_media'] }}
                    ],
                    backgroundColor: [
                        'rgba(102, 126, 234, 0.8)',
                        'rgba(72, 187, 120, 0.8)',
                        'rgba(237, 137, 54, 0.8)',
                        'rgba(240, 147, 251, 0.8)',
                        'rgba(250, 112, 154, 0.8)'
                    ],
                    borderColor: [
                        'rgba(102, 126, 234, 1)',
                        'rgba(72, 187, 120, 1)',
                        'rgba(237, 137, 54, 1)',
                        'rgba(240, 147, 251, 1)',
                        'rgba(250, 112, 154, 1)'
                    ],
                    borderWidth: 2,
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    }

    // Status Pie Chart
    const statusCtx = document.getElementById('statusChart');
    if (statusCtx) {
        new Chart(statusCtx, {
            type: 'doughnut',
            data: {
                labels: ['Published', 'Draft'],
                datasets: [{
                    data: [{{ $stats['published_posts'] }}, {{ $stats['draft_posts'] }}],
                    backgroundColor: [
                        'rgba(72, 187, 120, 0.8)',
                        'rgba(237, 137, 54, 0.8)'
                    ],
                    borderColor: [
                        'rgba(72, 187, 120, 1)',
                        'rgba(237, 137, 54, 1)'
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 14
                            }
                        }
                    }
                }
            }
        });
    }
});
</script>
@endpush
