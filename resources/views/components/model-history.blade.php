<x-filament::section>
    <x-slot name="heading">Change History</x-slot>

    <div class="space-y-4">
        <div>Create Time : {{ $record->created_at->diffForHumans() }}</div>
        @foreach ($record->histories as $history)
            @php
                $beforeChanges = collect(\Illuminate\Support\Arr::except($history->before_changes ?? [], ['updated_at']))
                    ->toArray();

                $changes = collect(\Illuminate\Support\Arr::except($history->changes ?? [], ['updated_at']))
                    ->toArray();
            @endphp

            <div class="p-4 rounded-lg border">
                <div><strong>User:</strong> {{ $history->user?->name ?? 'System' }}</div>
                <div><strong>Time:</strong> 
                    <em class="text-xs text-gray-500 block">{{ $history->created_at->diffForHumans() }}</em>
                </div>

                <div><strong>Before:</strong> 
                    <pre class="text-sm">
{{ json_encode($beforeChanges, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                    </pre>
                </div>

                <div><strong>Changes:</strong> 
                    <pre class="text-sm">
{{ json_encode($changes, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}
                    </pre>
                </div>
            </div>
        @endforeach
    </div>
</x-filament::section>
