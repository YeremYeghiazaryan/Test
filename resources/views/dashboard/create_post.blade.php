@extends('layouts.layout_index')
@section('title','Create Post')
@section('script_chekAuth')
    <script src="{{ asset('js/CheckAuth/checkAuth.js') }}"></script>
@endsection
@section('content')
    <div id="container" class="d-none">
        <h3 class="mb-4 text-center">Create Post</h3>
        <div class="mb-3">
            <div id="create-post" data-get-website-data-url="{{route('create-post', ['id' => $id])}}">
                <label for="name" class="form-label" id="website_id">Post Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Post Name" required>
                <label for="title" class="form-label">Post Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Enter Post Title" required>
            </div>
        </div>
        <button type="submit" id="createPost" class="btn btn-success w-100">Create Post</button>
    </div>
@endsection
@section('script_index')

    <script src="{{ asset('js/logout/logout.js') }}"></script>
    <script src="{{ asset('js/dashboard/createPost.js') }}"></script>
@endsection












