@extends('assetsmanagement::layouts.app')

@section('content')
    @if (session('success'))
        <div id="success-alert"
            class="mt-10 flex items-center justify-between rounded-lg bg-green-100 border border-green-300 text-green-800 px-6 py-4 shadow-sm"
            role="alert">
            <span class="font-semibold">
                {{ session('success') }}
            </span>
            <span class="close-btn cursor-pointer ml-4 text-lg font-bold">&times;</span>
        </div>
    @endif

    @if (session('error'))
        <div id="error-alert"
            class="mt-10 flex items-center justify-between rounded-lg bg-red-100 border border-red-300 text-red-800 px-6 py-4 shadow-sm"
            role="alert">
            <span class="font-semibold">
                {{ session('error') }}
            </span>
            <span class="close-btn cursor-pointer ml-4 text-lg font-bold">&times;</span>
        </div>
    @endif
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Invoice Details</h1>
                </div>
                <div class="mt-4 sm:mt-0">
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('asset-management.invoice.index') }}"
                            class="inline-flex items-center px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-medium rounded-lg transition duration-200 border border-gray-300">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Back to Invoices
                        </a>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-gray-200 mb-8">
                <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-8 py-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between">
                        <div class="flex items-center w-full">

                            <div class="bg-white/20 p-3 rounded-lg mr-4">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>

                            <div>
                                <h2 class="text-2xl font-bold text-white">
                                    Invoice #{{ $invoice->invoice_number }}
                                </h2>
                                <p class="text-white mt-1">
                                    {{ $invoice->vendor->company_name }}
                                </p>
                            </div>

                            <div class="ml-auto">
                                <a href="{{ route('asset-management.invoice.log', $invoice->id) }}"
                                    class=" border px-2 py-2 uppercase rounded-md bg-white font-semibold">Logs</a>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6 mb-10">
                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-100">
                            <p class="text-sm font-medium text-gray-500 mb-2">Vendor</p>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $invoice->vendor->company_name ?? 'Not specified' }}</p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-100">
                            <p class="text-sm font-medium text-gray-500 mb-2">Category</p>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ ucfirst($invoice->category) ?? 'Not specified' }}</p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-100">
                            <p class="text-sm font-medium text-gray-500 mb-2">Due Date</p>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $invoice->due_date?->format('d-M-Y') ?? 'No Due Date' }}

                                </p>

                            </div>
                        </div>

                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-100">
                            <p class="text-sm font-medium text-gray-500 mb-2">Invoice Date</p>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $invoice->invoice_date->format('d-M-Y') ?? 'No Invoice Date' }}</p>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-5 rounded-lg border border-gray-100">
                            <p class="text-sm font-medium text-gray-500 mb-2">Quantity</p>
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-14L4 7m8 4v10m0-10l-8-4" />
                                </svg>
                                {{-- @foreach ($invoice->items as $item) --}}
                            
                                   <a href="{{ route('asset-management.assets.productshow', [
    'item' => $invoice->id,
    'category' => $invoice->category,
]) }}"
class="text-lg font-semibold underline text-gray-900">
    {{ $invoice->items->sum('quantity') }}
</a>

                                    {{-- @endforeach --}}
                            </div>
                        </div>
                    </div>
                    @php
                        $total = $invoice->total_amount;
                        $partial = $invoice->partial_amount;
                        $balance = $total - $partial;
                    @endphp

                    {{-- Financial Summary --}}
                    <div class="mb-10">
                        <h3 class="text-lg font-semibold text-gray-800 mb-6 pb-2 border-b border-gray-200">Financial
                            Details
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                            <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                                <p class="text-sm font-medium text-blue-600 mb-2">Sub Total</p>
                                <p class="text-2xl font-bold text-blue-900">₹{{ number_format($invoice->sub_total, 2) }}
                                </p>
                            </div>

                            @if ($invoice->discount_amount > 0)
                                <div class="bg-purple-50 p-6 rounded-lg border border-purple-100">
                                    <p class="text-sm font-medium text-purple-600 mb-2">
                                        @if ($invoice->discount_type == 'percentage')
                                            Discount ({{ $invoice->discount_percentage }}%)
                                        @else
                                            Discount
                                        @endif
                                    </p>
                                    <p class="text-2xl font-bold text-purple-900">
                                        -₹{{ number_format($invoice->discount_amount, 2) }}</p>
                                </div>
                            @endif

                            <div class="bg-green-50 p-6 rounded-lg border border-green-100">
                                <p class="text-sm font-medium text-green-600 mb-2">Tax Amount</p>
                                <p class="text-2xl font-bold text-green-900">₹{{ number_format($invoice->tax_amount, 2) }}
                                </p>
                            </div>
                            <div class="bg-yellow-50 p-6 rounded-lg border border-yellow-100">
                                <p class="text-sm font-medium text-yellow-600 mb-2">Partial Paid</p>
                                <p class="text-2xl font-bold text-yellow-900">
                                    ₹{{ number_format($invoice->partial_amount, 2) }}</p>
                            </div>
                            <div id="balance" class="bg-yellow-50 hidden  p-6 rounded-lg border border-yellow-100">
                                <p class="text-sm font-medium text-yellow-600 mb-2">
                                    <span class="text-red-500">Pending Amount</span>
                                </p>
                                <p class="text-2xl font-bold text-yellow-900"> ₹ {{ number_format($balance, 2) ?? '-' }}
                                </p>

                            </div>

                            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 p-6 rounded-lg">
                                <p class="text-sm font-medium text-indigo-100 mb-2">Grand Total</p>
                                <p class="text-3xl font-bold text-white">₹{{ number_format($invoice->total_amount, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                    {{-- Attachments --}}
                    @if ($invoice->invoice_file_path)
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4 pb-2 border-b border-gray-200">Attachments
                            </h3>
                            <div
                                class="flex items-center justify-between bg-gray-50 p-4 rounded-lg border border-gray-200">
                                <div class="flex items-center">
                                    <div class="bg-blue-100 p-3 rounded-lg mr-4">
                                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">
                                            {{ basename($invoice->invoice_file_path) }}</p>
                                        <p class="text-xs text-gray-500 mt-1">Invoice document</p>
                                    </div>
                                </div>
                                <a href="{{ asset('storage/' . $invoice->invoice_file_path) }}" target="_blank"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Download
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @include('assetsmanagement::commentsandattachements.comments', ['model' => $invoice])
        @include('assetsmanagement::commentsandattachements.attachement', ['model' => $invoice])
    </div>
    <script>
        const invoiceStatus = "{{ $invoice->status }}";
        const balance = document.getElementById('balance');

        if (invoiceStatus === 'partial_paid') {
            balance.classList.remove('hidden');
        } else {
            balance.classList.add('hidden');
        }
    </script>
    <script>
        document.querySelectorAll('.close-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const alert = btn.parentElement;
                alert.style.display = 'none';
            });
        });
        document.querySelectorAll('.alert').forEach(alert => {
            setTimeout(() => {
                alert.style.display = 'none';
            }, 3000);
        });
    </script>


@endsection
