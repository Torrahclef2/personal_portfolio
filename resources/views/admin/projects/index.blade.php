@extends('admin.layouts.app')

@section('title', $pagetitle ?? 'Projects')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Projects</h1>
        <div>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-sm btn-outline-secondary">Add New Project</a>
        </div>
    </div>

    <!-- Recent projects table -->
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Recent Projects</h6>
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
                        @forelse ($projects as $project)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    @if($project->image && file_exists(public_path('uploads/projects/'.$project->image)))
                                        <img src="{{ asset('public/uploads/projects/'.$project->image) }}" alt="Project Image" style="width: 60px; height: auto; border:1px solid #ddd; padding:4px;">
                                    @else
                                        <img src="{{ asset('public/images/nophoto.png') }}" alt="No Image" style="width: 60px; height: auto; border:1px solid #ddd; padding:4px;">
                                    @endif
                                </td>
                                <td>{{ $project->title }}</td>
                                <td>{{ $project->created_at->format('M d, Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No projects found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(isset($projects) && method_exists($projects, 'links'))
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    {{ $projects->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
@endsection
