@extends('layouts.layout_index')
@section('title','Create Website')
@section('content')
    <h3 class="mb-4 text-center">Create Website</h3>
    <div class="mb-3">
        <label for="name" class="form-label">Website Name</label>
        <input type="text" class="form-control" id="name" name="name" placeholder="Enter website name" required>
    </div>
    <button id="btnCreateWebsite" type="submit" class="btn btn-success w-100">Create Website</button>
@endsection
@section('script_index')
    <script src="{{ asset('js/logout/logout.js') }}"></script>
    <script src="{{ asset('js/dashboard/createWebsite.js') }}"></script>
@endsection



