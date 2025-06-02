@extends('layouts.dashboard')

@section('content')
<div class="grid gap-6 lg:grid-cols-2">
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-semibold mb-4">Projects vs Events</h3>
        <div class="h-80">
            {!! $projectsEventsChart->container() !!}
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
        <h3 class="font-semibold mb-4">Total Spent per Month</h3>
        <div class="h-80">
            {!! $spentChart->container() !!}
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
{!! $projectsEventsChart->script() !!}
{!! $spentChart->script() !!}
@endpush