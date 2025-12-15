@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-md-3">
        <div class="card stat-card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2">Total Posts</h6>
                        <h2 class="card-title mb-0">{{ $stats['total_posts'] }}</h2>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2">Published</h6>
                        <h2 class="card-title mb-0">{{ $stats['published_posts'] }}</h2>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2">Draft Posts</h6>
                        <h2 class="card-title mb-0">{{ $stats['draft_posts'] }}</h2>
                    </div>
                    <div class="icon">
                        <i class="fas fa-edit"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card stat-card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-subtitle mb-2">Total Pages</h6>
                        <h2 class="card-title mb-0">{{ $stats['total_pages'] }}</h2>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                <h5>Users</h5>
                <h3>{{ $stats['total_users'] }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-image fa-3x text-success mb-3"></i>
                <h5>Media Files</h5>
                <h3>{{ $stats['total_media'] }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-envelope fa-3x text-warning mb-3"></i>
                <h5>Pending Contacts</h5>
                <h3>{{ $stats['pending_contacts'] }}</h3>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-user-tie fa-3x text-info mb-3"></i>
                <h5>Job Applications</h5>
                <h3>{{ $stats['pending_applications'] }}</h3>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Recent Posts -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Recent Posts</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recent_posts as $post)
                            <tr>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->category->name ?? '-' }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>
                                    <span class="badge bg-{{ $post->status == 'published' ? 'success' : 'warning' }}">
                                        {{ ucfirst($post->status) }}
                                    </span>
                                </td>
                                <td>{{ $post->created_at->format('d M Y') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No posts found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Contacts -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-white">
                <h5 class="mb-0">Recent Contacts</h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    @forelse($recent_contacts as $contact)
                    <div class="list-group-item px-0">
                        <div class="d-flex justify-content-between">
                            <strong>{{ $contact->name }}</strong>
                            <small class="text-muted">{{ $contact->created_at->diffForHumans() }}</small>
                        </div>
                        <small class="text-muted">{{ $contact->subject }}</small>
                    </div>
                    @empty
                    <div class="text-center text-muted py-3">
                        No contacts yet
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

