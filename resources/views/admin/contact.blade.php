@extends('admin.layouts.app')

@section('title', $pagetitle ?? 'Edit Contact')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Contact</h1>
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

    <form action="{{ route('admin.contact.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="mb-0">Contact Details</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $contact->title) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="subtitle" class="form-label">Subtitle</label>
                            <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle', $contact->subtitle) }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $contact->description) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $contact->email) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $contact->phone_number) }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $contact->address) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="latitude" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="latitude" name="latitude" value="{{ old('latitude', $contact->latitude) }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="longitude" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="longitude" name="longitude" value="{{ old('longitude', $contact->longitude) }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="map_link" class="form-label">Map Link</label>
                            <input type="text" class="form-control" id="map_link" name="map_link" value="{{ old('map_link', $contact->map_link) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            
                            <label class="form-label mt-2">Current Image:</label><br>
                            @if($contact->image && file_exists(public_path('uploads/contact/'.$contact->image)))
                                <img src="{{ asset('public/uploads/contact/'.$contact->image) }}" alt="Contact Image" style="width: 100px; height: auto; border:1px solid #ddd; padding:4px;">
                            @else
                                <img src="{{ asset('public/images/nophoto.png') }}" alt="No Image" style="width: 100px; height: auto; border:1px solid #ddd; padding:4px;">
                            @endif
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Contact</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
@endsection
