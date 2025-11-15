@extends('admin.layouts.app')

@section('title', $pagetitle ?? 'Services')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Services</h1>
        <div>
            <a href="{{ route('admin.services.create') }}" class="btn btn-sm btn-outline-secondary">Add New Service</a>
        </div>
    </div>

    <!-- Recent services table -->
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Recent Services</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Created On</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($services as $service)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($service->image && file_exists(public_path('uploads/services/'.$service->image)))
                                        <img src="{{ asset('public/uploads/services/'.$service->image) }}" alt="Service Image" style="width: 60px; height: auto; border:1px solid #ddd; padding:4px;">
                                    @else
                                        <img src="{{ asset('public/images/nophoto.png') }}" alt="No Image" style="width: 60px; height: auto; border:1px solid #ddd; padding:4px;">
                                    @endif
                                </td>
                                <td>{{ $service->title }}</td>
                                <td>{{ $service->created_at->format('M d, Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.services.edit', $service->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="{{ route('admin.services.destroy', $service->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">No services found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(isset($services) && method_exists($services, 'links'))
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    {{ $services->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
@endsection
