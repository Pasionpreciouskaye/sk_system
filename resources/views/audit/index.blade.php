@extends('layouts.dashboard')

@section('content')
<div x-data="{ showModal: false, detail: null }">

    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold" style="color:var(--color-text-primary);">Audit Trail</h1>
    </div>

    {{-- Filters --}}
    <form method="GET" class="flex flex-wrap gap-3 mb-6 items-end">
        <div>
            <label class="block text-xs mb-1" style="color:var(--color-text-secondary);">From</label>
            <input type="date" name="from" value="{{ request('from') }}"
                class="px-3 py-2 rounded-lg text-sm border" style="background:var(--color-card);color:var(--color-text-primary);border-color:var(--color-border);">
        </div>
        <div>
            <label class="block text-xs mb-1" style="color:var(--color-text-secondary);">To</label>
            <input type="date" name="to" value="{{ request('to') }}"
                class="px-3 py-2 rounded-lg text-sm border" style="background:var(--color-card);color:var(--color-text-primary);border-color:var(--color-border);">
        </div>
        <div>
            <label class="block text-xs mb-1" style="color:var(--color-text-secondary);">Module</label>
            <select name="module" class="px-3 py-2 rounded-lg text-sm border" style="background:var(--color-card);color:var(--color-text-primary);border-color:var(--color-border);">
                <option value="all">All Modules</option>
                @foreach(['Auth','Project','Budget','Inventory','User','Feedback'] as $m)
                    <option value="{{ $m }}" {{ request('module') === $m ? 'selected' : '' }}>{{ $m }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs mb-1" style="color:var(--color-text-secondary);">Action</label>
            <select name="action" class="px-3 py-2 rounded-lg text-sm border" style="background:var(--color-card);color:var(--color-text-primary);border-color:var(--color-border);">
                <option value="all">All Actions</option>
                @foreach(['login','logout','create','update','delete'] as $a)
                    <option value="{{ $a }}" {{ request('action') === $a ? 'selected' : '' }}>{{ ucfirst($a) }}</option>
                @endforeach
            </select>
        </div>
        <div class="flex-1 min-w-[180px]">
            <label class="block text-xs mb-1" style="color:var(--color-text-secondary);">Search</label>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search..."
                class="w-full px-3 py-2 rounded-lg text-sm border" style="background:var(--color-card);color:var(--color-text-primary);border-color:var(--color-border);">
        </div>
        <button type="submit" class="px-4 py-2 rounded-lg text-sm text-white font-medium" style="background:#E11D48;">Filter</button>
        <a href="{{ route('audit.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium" style="background:var(--color-hover);color:var(--color-text-secondary);">Reset</a>
    </form>

    {{-- Stat Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="p-5 rounded-xl flex items-center gap-4" style="background:var(--color-card);border:1px solid var(--color-border);">
            <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background:rgba(34,197,94,0.15);">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="#22C55E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            </div>
            <div>
                <p class="text-xs" style="color:var(--color-text-secondary);">Total Events</p>
                <p class="text-2xl font-bold" style="color:var(--color-text-primary);">{{ number_format($total) }}</p>
                <p class="text-xs" style="color:var(--color-text-muted);">This month</p>
            </div>
        </div>
        <div class="p-5 rounded-xl flex items-center gap-4" style="background:var(--color-card);border:1px solid var(--color-border);">
            <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background:rgba(239,68,68,0.15);">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="#EF4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/><path d="M10 11v6"/><path d="M14 11v6"/></svg>
            </div>
            <div>
                <p class="text-xs" style="color:var(--color-text-secondary);">Deletions</p>
                <p class="text-2xl font-bold" style="color:var(--color-text-primary);">{{ $deletions }}</p>
                <p class="text-xs" style="color:var(--color-text-muted);">Needs Review</p>
            </div>
        </div>
        <div class="p-5 rounded-xl flex items-center gap-4" style="background:var(--color-card);border:1px solid var(--color-border);">
            <div class="w-12 h-12 rounded-full flex items-center justify-center" style="background:rgba(34,197,94,0.15);">
                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="#22C55E" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div>
                <p class="text-xs" style="color:var(--color-text-secondary);">Last Activity</p>
                @if($last)
                    <p class="text-xl font-bold" style="color:var(--color-text-primary);">{{ $last->created_at->diffForHumans() }}</p>
                    <p class="text-xs" style="color:var(--color-text-muted);">{{ $last->user?->first_name }} {{ $last->action }}</p>
                @else
                    <p class="text-xl font-bold" style="color:var(--color-text-primary);">—</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Table --}}
    <div class="rounded-xl overflow-hidden" style="background:var(--color-card);border:1px solid var(--color-border);">
        <div class="px-6 py-4" style="border-bottom:1px solid var(--color-border);">
            <h2 class="font-semibold" style="color:var(--color-text-primary);">All modules</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr style="border-bottom:1px solid var(--color-border);">
                        <th class="px-4 py-3 text-left font-medium" style="color:var(--color-text-secondary);">Timestamp</th>
                        <th class="px-4 py-3 text-left font-medium" style="color:var(--color-text-secondary);">User</th>
                        <th class="px-4 py-3 text-left font-medium" style="color:var(--color-text-secondary);">Action</th>
                        <th class="px-4 py-3 text-left font-medium" style="color:var(--color-text-secondary);">Description</th>
                        <th class="px-4 py-3 text-left font-medium" style="color:var(--color-text-secondary);">Module</th>
                        <th class="px-4 py-3 text-center font-medium" style="color:var(--color-text-secondary);"></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                    @php
                        $colors = ['login'=>'#F59E0B','logout'=>'#6B7280','create'=>'#22C55E','update'=>'#3B82F6','delete'=>'#EF4444'];
                        $color = $colors[strtolower($log->action)] ?? '#9CA3AF';
                        $bg = $colors[strtolower($log->action)] . '22';
                    @endphp
                    <tr style="border-bottom:1px solid var(--color-border);" class="hover:opacity-80 transition">
                        <td class="px-4 py-3" style="color:var(--color-text-secondary);">{{ $log->created_at->format('M d, Y h:i A') }}</td>
                        <td class="px-4 py-3 font-medium" style="color:var(--color-text-primary);">{{ $log->user?->first_name ?? 'System' }} {{ $log->user?->last_name }}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 rounded text-xs font-bold" style="background:{{ $bg }};color:{{ $color }};">
                                {{ ucfirst($log->action) }}
                            </span>
                        </td>
                        <td class="px-4 py-3" style="color:var(--color-text-secondary);">{{ \Illuminate\Support\Str::limit($log->description, 60) }}</td>
                        <td class="px-4 py-3" style="color:var(--color-text-secondary);">{{ $log->module }}</td>
                        <td class="px-4 py-3 text-center">
                            <button @click="detail = {{ json_encode([
                                'id'          => $log->id,
                                'action'      => $log->action,
                                'module'      => $log->module,
                                'description' => $log->description,
                                'ip_address'  => $log->ip_address,
                                'created_at'  => $log->created_at,
                                'changes'     => $log->changes,
                                'user_name'   => $log->user ? $log->user->first_name . ' ' . $log->user->last_name : null,
                                'user_role'   => $log->user?->role,
                            ]) }}; showModal = true"
                                class="hover:opacity-70 transition" style="color:var(--color-text-muted);">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="px-4 py-8 text-center" style="color:var(--color-text-muted);">No audit records found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
        <div class="px-6 py-4 flex justify-between items-center text-sm" style="border-top:1px solid var(--color-border);color:var(--color-text-secondary);">
            <span>Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }}</span>
            <div>{{ $logs->links('vendor.pagination.custom-tailwind') }}</div>
        </div>
        @endif
    </div>

    {{-- Detail Modal --}}
    <div x-show="showModal" x-cloak class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center p-4">
        <div @click.away="showModal = false" x-transition
            class="rounded-2xl shadow-2xl w-full max-w-lg"
            style="background:var(--color-modal-bg);color:var(--color-text-primary);border:1px solid var(--color-border);max-height:90vh;overflow-y:auto;">

            <template x-if="detail">
                <div class="p-6">
                    {{-- Header --}}
                    <div class="flex justify-between items-center mb-4 pb-4 modal-border border-b">
                        <div class="flex items-center gap-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                            <h2 class="text-lg font-bold">Activity Detail</h2>
                        </div>
                        <button @click="showModal = false"
                            class="w-8 h-8 flex items-center justify-center rounded border font-bold text-sm transition hover:opacity-70"
                            style="border-color:var(--color-border);">&#x2715;</button>
                    </div>

                    {{-- Action badge + ID --}}
                    <div class="flex items-center gap-3 mb-6">
                        @php
                        $badgeColors = [
                            'login'  => ['bg'=>'#F59E0B','text'=>'#FFFFFF'],
                            'logout' => ['bg'=>'#6B7280','text'=>'#FFFFFF'],
                            'create' => ['bg'=>'#22C55E','text'=>'#FFFFFF'],
                            'update' => ['bg'=>'#3B82F6','text'=>'#FFFFFF'],
                            'delete' => ['bg'=>'#EF4444','text'=>'#FFFFFF'],
                        ];
                        @endphp
                        <span class="px-3 py-1 rounded text-sm font-bold"
                            :style="`background:${{'login':'#F59E0B','logout':'#6B7280','create':'#22C55E','update':'#3B82F6','delete':'#EF4444'}[detail.action?.toLowerCase()] ?? '#6B7280'};color:#FFFFFF;`"
                            x-text="detail.action ? detail.action.charAt(0).toUpperCase() + detail.action.slice(1) : ''">
                        </span>
                        <span class="text-sm" style="color:var(--color-text-muted);" x-text="`#AT-${String(detail.id).padStart(5,'0')}`"></span>
                    </div>

                    {{-- Fields --}}
                    <div class="space-y-4 text-sm mb-6">
                        <div class="flex gap-4">
                            <span class="w-32 text-xs font-semibold tracking-widest flex-shrink-0" style="color:var(--color-text-muted);">TIMESTAMP:</span>
                            <span style="color:var(--color-text-primary);" x-text="detail.created_at ? new Date(detail.created_at).toLocaleString('en-US',{month:'long',day:'numeric',year:'numeric',hour:'2-digit',minute:'2-digit'}) : '—'"></span>
                        </div>
                        <div class="flex gap-4">
                            <span class="w-32 text-xs font-semibold tracking-widest flex-shrink-0" style="color:var(--color-text-muted);">USER:</span>
                            <span style="color:var(--color-text-primary);" x-text="detail.user_name || 'System'"></span>
                        </div>
                        <div class="flex gap-4">
                            <span class="w-32 text-xs font-semibold tracking-widest flex-shrink-0" style="color:var(--color-text-muted);">ROLE:</span>
                            <span style="color:var(--color-text-primary);" x-text="detail.user_role ? detail.user_role.replace(/_/g,' ') : '—'"></span>
                        </div>
                        <div class="flex gap-4">
                            <span class="w-32 text-xs font-semibold tracking-widest flex-shrink-0" style="color:var(--color-text-muted);">IP ADDRESS:</span>
                            <span style="color:var(--color-text-primary);" x-text="detail.ip_address || '—'"></span>
                        </div>
                        <div class="flex gap-4">
                            <span class="w-32 text-xs font-semibold tracking-widest flex-shrink-0" style="color:var(--color-text-muted);">MODULE:</span>
                            <span style="color:var(--color-text-primary);" x-text="detail.module"></span>
                        </div>
                        <div class="flex gap-4">
                            <span class="w-32 text-xs font-semibold tracking-widest flex-shrink-0" style="color:var(--color-text-muted);">DESCRIPTION</span>
                            <span style="color:var(--color-text-primary);" x-text="detail.description"></span>
                        </div>
                    </div>

                    {{-- Changes --}}
                    <template x-if="detail.changes && detail.changes.length">
                        <div>
                            <div class="pt-4 mb-3 modal-border border-t">
                                <p class="text-xs font-bold tracking-widest" style="color:var(--color-text-secondary);">CHANGES MADE</p>
                            </div>
                            <div class="rounded-xl overflow-hidden" style="background:var(--color-section);border:1px solid var(--color-border);">
                                <div class="grid grid-cols-3 px-4 py-2 text-xs font-semibold" style="color:var(--color-text-muted);">
                                    <span>FIELD</span><span>BEFORE</span><span>AFTER</span>
                                </div>
                                <template x-for="(change, i) in detail.changes" :key="i">
                                    <div class="grid grid-cols-3 px-4 py-3 text-sm font-medium" style="border-top:1px solid var(--color-border);">
                                        <span style="color:var(--color-text-primary);" x-text="change.field"></span>
                                        <span style="color:#EF4444;" x-text="change.before"></span>
                                        <span style="color:#22C55E;" x-text="change.after"></span>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </template>

                    <div class="mt-6 pt-4 modal-border border-t"></div>
                </div>
            </template>
        </div>
    </div>
</div>
@endsection
