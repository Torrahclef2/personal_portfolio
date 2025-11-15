@extends('admin.layouts.app')

@section('title', $pagetitle ?? 'Dashboard')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Dashboard</h1>
        <div>
            <a href="#" class="btn btn-sm btn-outline-secondary">Profile</a>
            <a href="#" class="btn btn-sm btn-outline-secondary">Settings</a>
        </div>
    </div>

    <!-- Stats -->
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Blogs</small>
                    <div class="d-flex align-items-center">
                        <h3 class="mb-0 me-3">{{ $totalBlogs }}</h3>
                    </div>
                    <div class="text-muted small">Total Blogs</div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Services</small>
                    <div class="d-flex align-items-center">
                        <h3 class="mb-0 me-3">{{ $totalServices }}</h3>
                    </div>
                    <div class="text-muted small">Total Services</div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Projects</small>
                    <div class="d-flex align-items-center">
                        <h3 class="mb-0 me-3">{{ $totalProjects }}</h3>
                    </div>
                    <div class="text-muted small">Total Projects</div>
                </div>
            </div>
        </div>

         <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Contacts</small>
                    <div class="d-flex align-items-center">
                        <h3 class="mb-0 me-3">32</h3>
                    </div>
                    <div class="text-muted small">Total Contact Messages</div>
                </div>
            </div>
        </div>

        
    </div>

    <!-- Main row -->
    <div class="row">
        <!-- Left: charts / activity -->
        <div class="col-lg-8 mb-4">
            

            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">Recent Activity</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">

                        @forelse($blogs as $blog)
                        <li class="list-group-item">
                            <div class="small text-muted">{{ $blog->created_at->format('Y-m-d') }}</div>
                            <div>{{ Str::limit($blog->content, 100) }}</div>
                        </li>
                            
                        @empty
                        <li class="list-group-item">
                            <div class="text-center text-muted">No recent blog found.</div>
                        </li>
                            
                        @endforelse
                    </ul>
                </div>
                <div class="card-footer text-end">
                    <a href="{{ route('admin.blog') }}" class="btn btn-sm btn-outline-secondary">View All Blogs</a>
                </div>
            </div>
        </div>

        <!-- Right: quick lists -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Quick Actions</h6>
                    
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.projects') }}" class="btn btn-outline-secondary">Manage Projects</a>
                        <a href="{{ route('admin.services') }}" class="btn btn-outline-secondary">Manage Services</a>
                        <a href="{{ route('admin.blog') }}" class="btn btn-outline-secondary">Manage Blogs</a>
                    </div>
                </div>
            </div>

            
        </div>
    </div>

    <!-- Recent posts table -->
    
</div>
@endsection

@section('scripts')
@endsection