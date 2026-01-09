<div class="mx-auto px-4 py-8 sm:px-6 lg:px-8">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div class="flex items-center gap-3">
            <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </svg>
            <h2 class="text-2xl font-bold text-gray-900">Audit Logs</h2>
            <span class="px-3 py-1 text-sm font-medium bg-gray-100 text-gray-600 rounded-full">
                {{ $auditlogs->count() }} entries
            </span>
        </div>
        
        @if ($context === 'invoice')
            <div class="flex items-center gap-3">
                <span class="text-sm font-medium text-gray-600">Filter by type:</span>
                <select wire:model.live="type" 
                        class="border border-gray-300 rounded-lg shadow-sm px-4 py-2.5 text-gray-700 bg-white focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200">
                    <option value="all">All Types</option>
                    <option value="Invoice">Invoice</option>
                    <option value="Asset">Asset</option>
                    <option value="InvoiceItem">Invoice Item</option>
                </select>
            </div>
        @endif
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-100">
                <thead class="bg-gray-50/80 backdrop-blur-sm">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Event</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Old Values</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">New Values</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Comments</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date & Time</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse ($auditlogs as $log)
                        <tr class="hover:bg-gray-50/50 transition-all duration-200 group">
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $typeColors = [
                                        'Invoice' => 'bg-purple-50 text-purple-700 border-purple-200',
                                        'Asset' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                        'InvoiceItem' => 'bg-amber-50 text-amber-700 border-amber-200',
                                    ];
                                    $typeClass = $typeColors[class_basename($log->auditlogable_type)] ?? 'bg-gray-50 text-gray-700 border-gray-200';
                                @endphp
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium border {{ $typeClass }}">
                                    <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ class_basename($log->auditlogable_type) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $eventColors = [
                                        'created' => 'bg-green-100 text-green-800',
                                        'updated' => 'bg-blue-100 text-blue-800',
                                        'deleted' => 'bg-red-100 text-red-800',
                                    ];
                                    $eventClass = $eventColors[$log->event] ?? 'bg-gray-100 text-gray-800';
                                @endphp
                                <span class="px-3 py-1.5 rounded-md text-sm font-medium {{ $eventClass }}">
                                    {{ ucfirst($log->event) }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                @if (!empty($log->old_values))
                                    @php
                                        $oldValues = collect($log->old_values)->except(['updated_at'])->all();
                                    @endphp
                                    <div class="space-y-2 max-w-xs">
                                        @foreach ($oldValues as $key => $value)
                                            <div class="flex items-center gap-2 group/item">
                                                <span class="text-xs font-medium text-gray-500 min-w-[80px]">{{ $key }}:</span>
                                                <span class="px-2 py-1 bg-gray-50 text-gray-700 rounded text-sm font-mono truncate group-hover/item:bg-gray-100 transition-colors">
                                                    {{ $value }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400 italic text-sm">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                @if (!empty($log->new_values))
                                    @php
                                        $newValues = collect($log->new_values)->except(['updated_at'])->all();
                                    @endphp
                                    <div class="space-y-2 max-w-xs">
                                        @foreach ($newValues as $key => $value)
                                            <div class="flex items-center gap-2 group/item">
                                                <span class="text-xs font-medium text-gray-500 min-w-[80px]">{{ $key }}:</span>
                                                <span class="px-2 py-1 bg-blue-50 text-blue-700 rounded text-sm font-mono truncate group-hover/item:bg-blue-100 transition-colors">
                                                    {{ $value }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400 italic text-sm">-</span>
                                @endif
                            </td>

                            <td class="px-6 py-4">
                                @if ($log->comments)
                                    <div class="relative group/comment">
                                        <div class="rounded-lg p-3 bg-blue-50 border border-blue-100 hover:bg-blue-100/50 transition-colors duration-200">
                                            <div class="flex items-start">
                                                <svg class="w-4 h-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                                                </svg>
                                                <p class="text-sm text-blue-800 line-clamp-2">{{ $log->comments }}</p>
                                            </div>
                                        </div>
                                        <div class="absolute z-10 hidden group-hover/comment:block bg-gray-900 text-white text-xs rounded py-1 px-2 -top-8 left-1/2 transform -translate-x-1/2 whitespace-nowrap">
                                            View full comment
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center text-gray-400">
                                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z" />
                                        </svg>
                                        <span class="text-sm italic">No comments</span>
                                    </div>
                                @endif
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ $log->created_at->format('M d, Y') }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $log->created_at->format('h:i A') }}
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center text-gray-400">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-medium text-gray-500 mb-1">No audit logs found</h3>
                                    <p class="text-sm text-gray-400">Audit logs will appear here once created</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>