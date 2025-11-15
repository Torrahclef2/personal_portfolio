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
                    <small class="text-muted">Users</small>
                    <div class="d-flex align-items-center">
                        <h3 class="mb-0 me-3">43</h3>
                        <div class="text-success small">+12%</div>
                    </div>
                    <div class="text-muted small">Total registered users</div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Posts</small>
                    <div class="d-flex align-items-center">
                        <h3 class="mb-0 me-3">43</h3>
                        <div class="text-success small">+23%</div>
                    </div>
                    <div class="text-muted small">Published posts</div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Comments</small>
                    <div class="d-flex align-items-center">
                        <h3 class="mb-0 me-3">21</h3>
                        <div class="text-danger small">-50%</div>
                    </div>
                    <div class="text-muted small">New comments</div>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <small class="text-muted">Revenue</small>
                    <div class="d-flex align-items-center">
                        <h3 class="mb-0 me-3">$3,000</h3>
                        <div class="text-success small">+50%</div>
                    </div>
                    <div class="text-muted small">This month</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main row -->
    <div class="row">
        <!-- Left: charts / activity -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">Traffic</h5>
                        <small class="text-muted">Last 30 days</small>
                    </div>
                    <canvas id="trafficChart" height="120"></canvas>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">Recent Activity</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                         <li class="list-group-item">
                                <div class="small text-muted">2022-01-01</div>
                                <div>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</div>
                            </li>
                    
                      
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right: quick lists -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h6 class="mb-0">Quick Actions</h6>
                    <a href="#" class="btn btn-sm btn-primary">New</a>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="#" class="btn btn-outline-secondary">Manage Users</a>
                        <a href="#" class="btn btn-outline-secondary">Manage Posts</a>
                        <a href="#" class="btn btn-outline-secondary">Manage Comments</a>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-header">
                    <h6 class="mb-0">Recent Users</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th class="text-end">Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent posts table -->
    <div class="card shadow-sm">
        <div class="card-header">
            <h6 class="mb-0">Recent Posts</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Comments</th>
                            <th>Status</th>
                            <th class="text-end">Published</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@endsection