@extends('layouts.dashboard')
@include('BudgetCategory._form')


@section('content')
<div class="p-6 bg-white shadow rounded">
    <h1 class="text-xl font-bold mb-4">{{ $page_title }}</h1>
    <form action="{{ route($resource . '.update', $budgetCategory->id) }}" method="POST">
        @method('PUT')
        @include('budget_category._form')
        <div class="mt-4">
            <button type="submit" class="bg-pink-600 text-white px-4 py-2 rounded hover:bg-pink-700">Update</button>
        </div>
    </form>
</div>
@endsection
