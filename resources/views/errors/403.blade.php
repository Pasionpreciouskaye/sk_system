@extends('layouts.dashboard')
@section('content')
<div class="flex flex-col items-center justify-center min-h-[60vh] text-center px-4">
    <div class="text-8xl font-bold mb-4" style="color:var(--color-accent)">403</div>
    <h1 class="text-2xl font-bold mb-2" style="color:var(--color-text-primary)">Access Restricted</h1>
    <p class="mb-6 max-w-md" style="color:var(--color-text-secondary)">
        Your role <strong>{{ str_replace('_', ' ', Auth::user()->role ?? '') }}</strong>
        does not have permission to access this page.
    </p>
    <a href="{{ route('dashboard') }}"
        class="px-5 py-2 rounded-lg text-white transition-all duration-200"
        style="background:var(--color-accent)">
        Back to Dashboard
    </a>
</div>
@endsection
