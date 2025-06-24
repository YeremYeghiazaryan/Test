@extends('layouts.layout_index')
@section('title','Dashboard')
@section('content')
    <h2 class="mb-4 text-center">My Website List</h2>
    <table class="table table-striped table-hover shadow-sm rounded align-middle text-center">
        <thead class="table-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Website Name</th>
            <th scope="col">Created At</th>
            <th scope="col"></th>
        </tr>
        </thead>

        <tbody id="websites">

        </tbody>
    </table>
@endsection
@section('script_index')
    <script src="{{ asset('js/logout/logout.js') }}"></script>
    <script src="{{ asset('js/dashboard/index.js') }}"></script>
@endsection

