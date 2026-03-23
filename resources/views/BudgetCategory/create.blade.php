@extends('layouts.dashboard')
@include('BudgetCategory._form')

@section('content')
<div class="p-6 bg-white shadow rounded">
    <h1 class="text-xl font-bold mb-4">{{ $page_title }}</h1>
    <form action="{{ route($resource . '.store') }}" method="POST">
        @include('BudgetCategory._form')
        <div class="mt-4">
            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Create</button>
        </div>
    </form>
</div>
@endsection
