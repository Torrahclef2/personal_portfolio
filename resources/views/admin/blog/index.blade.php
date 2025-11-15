@extends('admin.layouts.app')

@section('title', $pagetitle ?? 'Blog Posts')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Blog Posts</h1>
        <div>
            <a href="{{ route('admin.blog.create') }}" class="btn btn-sm btn-outline-secondary">Add New Blog</a>
        </div>
    </div>

    <!-- Recent posts table -->
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6 class="mb-0">Recent Posts</h6>
        
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Title</th>
                            <th>Published On</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogs as $blog)
                            <tr>
                                <td>{{ $blog->title }}</td>
                                <td>{{ $blog->created_at->format('M d, Y') }}</td>
                                <td class="text-end">
                                    <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                                    <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No blog posts found.</td>
                            </tr>
                            
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if(isset($blogs) && method_exists($blogs, 'links'))
            <div class="card-footer">
                <div class="d-flex justify-content-end">
                    {{ $blogs->links() }}
                </div>
            </div>
        @endif
    </div>
</div>
@endsection

@section('scripts')
@endsection
