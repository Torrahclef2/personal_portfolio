@extends('admin.layouts.app')

@section('title', $pagetitle ?? 'Edit Blog Post')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Blog Post</h1>
        <div>
            <a href="{{ route('admin.blog') }}" class="btn btn-sm btn-outline-secondary">Back to List</a>
        </div>
    </div>

    <div class="succsess-message">
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

<form action="{{ route('admin.blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card shadow-sm">
        <div class="card-header">
            <h6 class="mb-0">Blog Post Details</h6>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $blog->title) }}" required oninput="updateSlug()">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ old('slug', $blog->slug) }}" required>
                    </div>
                </div>
               
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="content" class="form-label">Description</label>
                        <textarea class="form-control" id="content" name="content" rows="5">{{ old('content', $blog->content) }}</textarea>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="image" class="form-label">Thumbnail</label>
                        <input type="file" class="form-control" id="image" name="image" >
                        @if (!empty($blog->image))
                            <div class="mt-2">
                                <p class="mb-1 small text-muted">Current thumbnail:</p>
                                @if (file_exists(public_path('uploads/blogs/'.$blog->image)))
                                    <img src="{{ asset('public/uploads/blogs/'.$blog->image) }}" alt="Thumbnail" style="max-width:200px; height:auto; border:1px solid #ddd; padding:4px;">
                                @else
                                    <img src="{{ asset('public/images/nophoto.png') }}" alt="Default Thumbnail" style="max-width:200px; height:auto; border:1px solid #ddd; padding:4px;">
                                @endif
                                <input type="hidden" name="existing_image" value="{{ $blog->image }}">
                            </div>
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
<script>
function updateSlug() {
    const title = document.getElementById('title').value;
    let slug = title.toLowerCase()
        .trim()
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-');
    document.getElementById('slug').value = slug;
}
</script>
@endsection
