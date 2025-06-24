@extends('layouts.layout_index')
@section('title','Update Website')
@section('content')
    <div id="container" class="d-none">
        <h3 class="mb-4 text-center">Update Website</h3>
        <div class="mb-3 " id="website-edit-form" data-get-website-data-url="{{route('edit-website', ['id' => $id]) }}">
            <label for="name" class="form-label"> Website Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <button type="submit" id="btnUpdateWebsite" class="btn btn-success w-100">Update Website</button>
    </div>
@endsection
@section('script_index')

    <script src="{{ asset('js/logout/logout.js') }}"></script>
    <script src="{{ asset('js/dashboard/edit.js') }}"></script>
@endsection
