<div>
    @if (session('success'))
        <div class="alert mt-6 bg-emerald-100 border border-emerald-200 text-emerald-700 rounded-lg p-4" role="alert">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
                {{ session('success') }}
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="alert mt-6 bg-rose-100 border border-rose-200 text-rose-700 rounded-lg p-4" role="alert">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clip-rule="evenodd" />
                </svg>
                {{ session('error') }}
            </div>
        </div>
    @endif

    @if ($errors->any())
        <div class="alert mt-6 bg-amber-100 border border-amber-200 text-amber-700 rounded-lg p-4" role="alert">
            <ul class="space-y-1">
                @foreach ($errors->all() as $error)
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                clip-rule="evenodd" />
                        </svg>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-[1500px] mx-auto px-4 sm:px-6 lg:px-8">

            <div class="mb-8">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">Invoice Management</h1>
                    </div>
                    <div>
                        <a href="{{ route('asset-management.invoice.create') }}"
                            class="inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium rounded-lg shadow-sm hover:shadow transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                            </svg>
                            Create Invoice
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Total Invoices</p>
                            <p class="text-2xl font-bold text-gray-900 mt-2">{{ $invoices->count() }}</p>
                        </div>
                        <div class="p-3 bg-blue-50 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Paid</p>
                            <p class="text-2xl font-bold text-gray-900 mt-2">
                                {{ $invoices->where('status', 'paid')->count() }}</p>
                        </div>
                        <div class="p-3 bg-emerald-50 rounded-lg">
                            <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Pending</p>
                            <p class="text-2xl font-bold text-gray-900 mt-2">
                                {{ $invoices->where('status', 'unpaid')->count() }}</p>
                        </div>
                        <div class="p-3 bg-amber-50 rounded-lg">
                            <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600">Partial Paid</p>
                            <p class="text-2xl font-bold text-gray-900 mt-2">
                                {{ $invoices->where('status', 'partial_paid')->count() }}</p>
                        </div>
                        <div class="p-3 bg-rose-50 rounded-lg">
                            <svg class="w-6 h-6 text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <h2 class="text-lg uppercase font-semibold text-gray-800">Invoice List</h2>
                        </div>

                        <div class="flex flex-col sm:flex-row gap-4 w-full sm:w-auto">

                            <div class="relative w-full sm:max-w-md">
                                <input type="text" wire:model.live="search" placeholder="Search invoices..."
                                    class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg
                          focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm">
                                <svg class="absolute left-3 top-3 w-4 h-4 text-gray-400" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <select
                                class="w-full sm:w-48 border border-gray-300 rounded-lg
                   focus:ring-2 focus:ring-blue-500 focus:border-blue-500 px-4 py-2.5 text-sm">
                                <option>All Status</option>
                                <option>Paid</option>
                                <option>Pending</option>
                                <option>Overdue</option>
                            </select>

                        </div>
                    </div>

                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th
                                    class="px-6 py-5 border border-slate-300 text-center text-md font-medium text-violet-900 uppercase tracking-wider">
                                    S No</th>
                                <th
                                    class="px-6 py-5 border border-slate-300 text-center text-md font-medium text-violet-900 uppercase tracking-wider">
                                    Invoice No</th>
                                <th
                                    class="px-6 py-5 border border-slate-300 text-center text-md font-medium text-violet-900 uppercase tracking-wider">
                                    Vendor</th>
                                <th
                                    class="px-6 py-5 border border-slate-300 text-center text-md font-medium text-violet-900 uppercase tracking-wider">
                                    Amount</th>
                                <th
                                    class="px-6 py-5 border border-slate-300 text-center text-md font-medium text-violet-900 uppercase tracking-wider">
                                    Partial Paid</th>
                                <th
                                    class="px-6 py-5 border border-slate-300 text-center text-md font-medium text-violet-900 uppercase tracking-wider">
                                    Status</th>
                                <th
                                    class="px-6 py-5 border border-slate-300 text-center text-md font-medium text-violet-900 uppercase tracking-wider">
                                    Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-100">
                            @forelse ($invoices as $invoice)
                                <tr class="hover:bg-gray-50 transition-colors duration-150">
                                    <td class="px-6 py-4 border border-slate-300">

                                        <div class="ml-4 ">
                                            <div class="text-sm text-center font-semibold text-gray-900 ">
                                                {{ $invoice->id }}</div>
                                        </div>

                                    </td>
                                    <td class="px-6 py-4 border border-slate-300">

                                        <div class="ml-4">
                                            <div class="text-sm text-center font-semibold text-gray-900 ">
                                                {{ $invoice->invoice_number }}</div>
                                        </div>

                                    </td>
                                    <td class="px-6 py-4 border border-slate-300">
                                        <div class="text-sm text-center font-medium text-gray-900 ">
                                            {{ $invoice->vendor->company_name ?? '-' }}</div>
                                    </td>
                                    {{-- <td class="px-6 py-4">
                                <div class="text-sm text-gray-900 font-medium">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M, Y') }}</div>
                                <div class="text-xs text-gray-500">Due: {{ \Carbon\Carbon::parse($invoice->due_date)->format('d M, Y') }}</div>
                            </td> --}}

                                    <td class="px-6 py-4 border border-slate-300">
                                        <div class="text-lg text-center font-bold text-gray-900">
                                            {{ number_format($invoice->total_amount, 2) }}</div>
                                    </td>
                                    <td class="px-6 py-4 border border-slate-300">
                                        <div class="text-lg text-center  text-gray-900">
                                            {{ $invoice->partial_amount ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-center border border-slate-300">
                                        @php
                                            $statusConfig = [
                                                'paid' => [
                                                    'bg' => 'bg-emerald-50',
                                                    'text' => 'text-emerald-700',
                                                    'border' => 'border border-emerald-100',
                                                ],
                                                'unpaid' => [
                                                    'bg' => 'bg-amber-50',
                                                    'text' => 'text-amber-700',
                                                    'border' => 'border border-amber-100',
                                                ],
                                                'partial_paid' => [
                                                    'bg' => 'bg-rose-50',
                                                    'text' => 'text-rose-700',
                                                    'border' => 'border border-rose-100',
                                                ],
                                                'default' => [
                                                    'bg' => 'bg-gray-50',
                                                    'text' => 'text-gray-700',
                                                    'border' => 'border border-gray-100',
                                                ],
                                            ];
                                            $config = $statusConfig[$invoice->status] ?? $statusConfig['default'];
                                        @endphp
                                        <span
                                            class="inline-flex   items-center px-3 py-1.5 rounded-full text-sm font-medium {{ $config['bg'] }} {{ $config['text'] }} {{ $config['border'] }}">
                                            <span
                                                class="w-2 h-2   rounded-full mr-2 {{ str_replace('bg-', 'bg-', str_replace('50', '400', $config['bg'])) }}"></span>
                                            {{ ucfirst($invoice->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 border border-slate-300">
                                        <div class="flex justify-center items-center space-x-2">
                                            <a href="{{route('asset-management.invoice.show',$invoice->id)}}"
                                                class="p-1 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg ">
                                                <svg class="w-5 h-8" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <span>|</span>
                                            <a href="{{ route('asset-management.invoice.edit', $invoice->id) }}"
                                                class="p-1 text-gray-600 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg">
                                                <svg class="w-5 h-8" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <span>|</span>
                                            <form action="{{ route('asset-management.invoice.destroy', $invoice->id) }}" method="POST"
                                                class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    onclick="return confirm('Are you sure you want to delete this invoice?')"
                                                    class="p-1 text-gray-600 hover:text-rose-600 hover:bg-rose-50 rounded-lg">
                                                    <svg class="w-5 h-8" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center py-6 text-gray-500 font-medium">No invoice found.</td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
 <div class="mt-4">
        {{ $invoices->links() }} 
    </div>
        </div>
    </div>
</div>
