@extends('admin.layouts.app')

@section('title', $pagetitle ?? 'Edit Project')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Project</h1>
        <div>
            <a href="{{ route('admin.projects') }}" class="btn btn-sm btn-outline-secondary">Back to List</a>
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

@if ($errors->any())
    <div>
        @foreach ($errors->all() as $error)
          <div class="alert alert-danger">{{ $error }}</div>
        @endforeach
    </div>
@endif

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="mb-0">Project Details</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="title" class="form-label">Project Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $project->title) }}" required>
                        </div>
                    </div>
                 
                   
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Project Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $project->description) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="github_link" class="form-label">GitHub Link</label>
                            <input type="url" class="form-control" id="github_link" name="github_link" value="{{ old('github_link', $project->github_link) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="live_link" class="form-label">Live Project Link</label>
                            <input type="url" class="form-control" id="live_link" name="live_link" value="{{ old('live_link', $project->live_link) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image" class="form-label">Project Thumbnail</label>
                            <input type="file" class="form-control" id="image" name="image">
                        </div>

                        <div class="mb-3">
                                <label class="form-label d-block">Current Thumbnail</label>
                                 @if($project->image && file_exists(public_path('uploads/projects/'.$project->image)))
                                        <img src="{{ asset('public/uploads/projects/'.$project->image) }}" alt="Project Image" style="width: 120px; height: auto; border:1px solid #ddd; padding:4px;">
                                    @else
                                        <img src="{{ asset('public/images/nophoto.png') }}" alt="No Image" style="width: 120px; height: auto; border:1px solid #ddd; padding:4px;">
                                    @endif
                            </div>
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
@endsection
