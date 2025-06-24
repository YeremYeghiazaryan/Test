@extends('layouts.layout_index')
@section('title','Show Website')
@section('script_chekAuth')
    <script src="{{ asset('js/CheckAuth/checkAuth.js') }}"></script>
@endsection

@section('content')
    <div id="container" class="d-none">
        <h2 class="mb-4 text-center">Posts </h2>
        <div id="website-data" data-website-id="{{ $id }}">
            <table class="table table-striped table-hover shadow-sm rounded align-middle text-center">
                <thead class="table-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Post Name</th>
                    <th scope="col">Post Title</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Verification</th>
                    <th scope="col">Actions</th>
                </tr>
                </thead>
                <tbody id="posts">
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('script_index')
    <script src="{{ asset('js/logout/logout.js') }}"></script>
    <script src="{{ asset('js/dashboard/show.js') }}"></script>
@endsection

