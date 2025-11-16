
@extends('admin.layouts.app')

@section('title', $pagetitle ?? 'Socials')

@section('content')

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Socials</h1>
        <div>
            <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#addSocialModal">Add New Social</button>

            <!-- Add Social Modal -->
            <div class="modal fade" id="addSocialModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Social</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form action="{{ route('admin.socials.store') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="platform" class="form-label">Platform</label>
                                    <input type="text" class="form-control" id="platform" name="platform" required >
                                    <span class="form-text">E.g., Facebook, Twitter, LinkedIn</span>
                                </div>
                                <div class="mb-3">
                                    <label for="url" class="form-label">Link</label>
                                    <input type="url" class="form-control" id="url" name="url" required>
                                    <span class="form-text">E.g., https://www.facebook.com/yourpage</span>
                                </div>
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon</label>
                                    <input type="text" class="form-control" id="icon" name="icon" required>
                                    <span class="form-text">Font Awesome icon class (without "fa-"). E.g., "facebook", "twitter"</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save Social</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <div class="success-message">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <!-- Recent projects table -->
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Recent Socials</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Platform</th>
                            <th>Link</th>
                            <th>Icon</th>
                            <th>Created On</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($socials as $social)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $social->platform }}</td>
                                <td><a href="{{ $social->url }}" target="_blank">{{ $social->url }}</a></td>
                                <td><i class="fab fa-{{ $social->icon }}"></i></td>
                                <td>{{ $social->created_at->format('M d, Y') }}</td>
                                <td class="text-end">
                                 <form action="{{ route('admin.socials.destroy', $social->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No socials found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(isset($socials) && method_exists($socials, 'links'))
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    {{ $socials->links() }}
                </div>
            </div>
        @endif
    </div>
</div>

@endsection

