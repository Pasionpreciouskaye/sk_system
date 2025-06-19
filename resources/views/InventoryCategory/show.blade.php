@extends('layouts.dashboard')
@section('content')
<div class="p-6 bg-white shadow rounded">
    <h1 class="text-xl font-bold mb-4">{{ $page_title }}</h1>
    <div class="space-y-2">
        <div><strong>Name:</strong> {{ $inventoryCategory->name }}</div>
        <div><strong>Remarks:</strong> {{ $inventoryCategory->remarks }}</div>
    </div>
</div>
@endsection
