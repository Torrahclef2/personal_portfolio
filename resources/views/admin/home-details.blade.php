@extends('admin.layouts.app')

@section('title', $pagetitle ?? 'Edit Home Details')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Home Details</h1>
        <div>
            <a href="javascript:history.back()" class="btn btn-sm btn-outline-secondary">Back</a>
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

    <form method="POST" action="{{ route('admin.home-details.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="mb-0">Home Details</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $homeDetail->name) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $homeDetail->title) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtitle</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle', $homeDetail->subtitle) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            
                            <label class="form-label mt-2">Current Image:</label><br>
                            @if($homeDetail->image && file_exists(public_path('uploads/home/'.$homeDetail->image)))
                                <img src="{{ asset('public/uploads/home/'.$homeDetail->image) }}" alt="Home Image" style="width: 100px; height: auto; border:1px solid #ddd; padding:4px;">
                            @else
                                <img src="{{ asset('public/images/nophoto.png') }}" alt="No Image" style="width: 100px; height: auto; border:1px solid #ddd; padding:4px;">
                            @endif
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="5">{{ old('description', $homeDetail->description) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="button_text" class="form-label">Button Text</label>
                            <input type="text" class="form-control" id="button_text" name="button_text" value="{{ old('button_text', $homeDetail->button_text) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="button_link" class="form-label">Button Link</label>
                            <input type="text" class="form-control" id="button_link" name="button_link" value="{{ old('button_link', $homeDetail->button_link) }}" required>
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Home Details</button>
                </div>
            </div>
        </div>
    </form>

</div>
@endsection

