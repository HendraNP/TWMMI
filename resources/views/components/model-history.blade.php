<x-filament::section>
    <x-slot name="heading">Change History</x-slot>

    <div class="space-y-4">
        @foreach ($record->histories as $history)
            <div class="p-4 rounded-lg border">
                <div><strong>Event:</strong> {{ ucfirst($history->event) }}</div>
                <div><strong>User:</strong> {{ $history->user?->name ?? 'System' }}</div>
                <div><strong>Time:</strong> <em class="text-xs text-gray-500 block">{{ $history->created_at->diffForHumans() }}</em>
</div>
                <div><strong>Before:</strong> <pre class="text-sm">{{ json_encode($history->before_changes, JSON_PRETTY_PRINT) }}</pre></div>
                <div><strong>Changes:</strong> <pre class="text-sm">{{ json_encode($history->changes, JSON_PRETTY_PRINT) }}</pre></div>
            </div>
        @endforeach
    </div>
</x-filament::section>
