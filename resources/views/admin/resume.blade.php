@extends('admin.layouts.app')

@section('title', $pagetitle ?? 'Edit Resume')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Edit Resume</h1>
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

    <form action="{{ route('admin.resumes.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card shadow-sm">
            <div class="card-header">
                <h6 class="mb-0">Resume Details</h6>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name', $resume->full_name) }}" required>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="job_title" class="form-label">Job Title</label>
                            <input type="text" class="form-control" id="job_title" name="job_title" value="{{ old('job_title', $resume->job_title) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $resume->email) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $resume->phone_number) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $resume->address) }}">
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3">
                            <label for="summary" class="form-label">Professional Summary</label>
                            <textarea class="form-control" id="summary" name="summary" rows="4">{{ old('summary', $resume->summary) }}</textarea>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="cv_link" class="form-label">Link to CV</label>
                            <input type="text" class="form-control" id="cv_link" name="cv_link" value="{{ old('cv_link', $resume->cv_link) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="linkedin_link" class="form-label">Link to LinkedIn</label>
                            <input type="text" class="form-control" id="linkedin_link" name="linkedin_link" value="{{ old('linkedin_link', $resume->linkedin_link) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="github_link" class="form-label">Link to GitHub</label>
                            <input type="text" class="form-control" id="github_link" name="github_link" value="{{ old('github_link', $resume->github_link) }}">
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="total_experience" class="form-label">Total Years of Experience</label>
                            <input type="number" class="form-control" id="total_experience" name="total_experience" value="{{ old('total_experience', $resume->total_experience) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="total_project" class="form-label">Total Projects</label>
                            <input type="number" class="form-control" id="total_project" name="total_project" value="{{ old('total_project', $resume->total_project) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="total_clients" class="form-label">Total Clients</label>
                            <input type="number" class="form-control" id="total_clients" name="total_clients" value="{{ old('total_clients', $resume->total_clients) }}">
                        </div>
                    </div>

                   <div class="col-md-4">
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="{{ old('age', $resume->age) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="education" class="form-label">Education</label>
                            <input type="text" class="form-control" id="education" name="education" value="{{ old('education', $resume->education) }}">
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="mb-3">
                            <label for="image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="image" name="image">
                            
                            <label class="form-label mt-2">Current Image:</label><br>
                            @if($resume->image && file_exists(public_path('uploads/resume/'.$resume->image)))
                                <img src="{{ asset('public/uploads/resume/'.$resume->image) }}" alt="Profile Image" style="width: 100px; height: auto; border:1px solid #ddd; padding:4px;">
                            @else
                                <img src="{{ asset('public/images/nophoto.png') }}" alt="No Image" style="width: 100px; height: auto; border:1px solid #ddd; padding:4px;">
                            @endif
                        </div>
                    </div>

                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Update Resume</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
@endsection
