@extends('assetsmanagement::layouts.app')

@section('content')

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

   @if (session()->has('errors'))
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
    <div class=" max-w-[1200px] mx-auto ml-68 px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <div class="flex justify-between gap-36">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Asset Details</h1>
                </div>
                    <div class="flex gap-5">
                        <a href="{{ route('asset-management.assets.index') }}" 
                       class="inline-flex items-center justify-center px-5 py-3 border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 font-medium rounded-lg shadow-sm hover:shadow transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        Back to Assets
                    </a>
                    <a href="{{ route('asset-management.assets.edit', $assets->id) }}" 
                       class="inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium rounded-lg shadow-sm hover:shadow transition-all duration-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Edit Asset
                    </a>
                    <a href="{{ route('asset-management.assets.log', $assets->id) }}" 
                       class="inline-flex items-center justify-center px-5 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium rounded-lg shadow-sm hover:shadow transition-all duration-200">
                        {{-- <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg> --}}
                        Logs
                    </a>
                    </div>
            </div>
        </div>
        <div class=" gap-8">
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10 flex items-center justify-center rounded-lg bg-blue-50 border border-blue-100 mr-4">
                                    <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/>
                                    </svg>
                                </div>
                                <div>
                                    <h2 class="text-lg uppercase font-semibold text-gray-800">Asset Information</h2>
                                </div>
                            </div>
                            <div>
                                @php
                                    $statusConfig = [
                                        'active' => ['bg' => 'bg-emerald-50', 'text' => 'text-emerald-700', 'border' => 'border border-emerald-100', 'dot' => 'bg-emerald-400'],
                                        'repair' => ['bg' => 'bg-amber-50', 'text' => 'text-amber-700', 'border' => 'border border-amber-100', 'dot' => 'bg-amber-400'],
                                        'assigned' => ['bg' => 'bg-blue-50', 'text' => 'text-blue-700', 'border' => 'border border-blue-100', 'dot' => 'bg-blue-400'],
                                        'default' => ['bg' => 'bg-gray-50', 'text' => 'text-gray-700', 'border' => 'border border-gray-100', 'dot' => 'bg-gray-400']
                                    ];
                                    $config = $statusConfig[$assets->status] ?? $statusConfig['default'];
                                @endphp
                                <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium {{ $config['bg'] }} {{ $config['text'] }} {{ $config['border'] }}">
                                    <span class="w-2 h-2 rounded-full mr-2 {{ $config['dot'] }}"></span>
                                    {{ ucfirst($assets->status ?? 'N/A') }}
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <div class="flex items-center text-sm font-medium text-gray-500">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                    </svg>
                                    Asset Name
                                </div>
                                <div class="text-lg font-semibold text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    {{ $assets->invoiceItem->product_name ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center text-sm font-medium text-gray-500">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                    </svg>
                                    Asset Code
                                </div>
                                <div class="text-lg font-semibold text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    {{ $assets->asset_code ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center text-sm font-medium text-gray-500">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                    </svg>
                                    Category
                                </div>
                                <div class="text-lg font-semibold text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    {{ $assets->invoiceItem->invoice->category ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center text-sm font-medium text-gray-500">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                    </svg>
                                    Vendor
                                </div>
                                <div class="text-lg font-semibold text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    {{ $assets->invoiceItem->invoice->vendor->company_name ?? 'N/A' }}
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center text-sm font-medium text-gray-500">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Purchase Date
                                </div>
                                <div class="text-lg font-semibold text-gray-900 bg-gray-50 p-3 rounded-lg border border-gray-100">
                                    {{ $assets->invoiceItem->invoice->invoice_date ? \Carbon\Carbon::parse($assets->invoiceItem->invoice->invoice_date)->format('M d, Y') : 'N/A' }}
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center text-sm font-medium text-gray-500">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Purchase Amount
                                </div>
                                <div class="bg-gradient-to-r from-green-50 to-emerald-50 p-4 rounded-lg border border-emerald-100">
                                    <div class="flex items-center justify-between">
                                        <span class="text-2xl font-bold text-gray-900">
                                            ₹ {{ number_format($assets->invoiceItem->price ?? 0, 2) }}
                                        </span>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-emerald-100 text-emerald-700 border border-emerald-200">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Paid
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <div class="flex items-center text-sm font-medium text-gray-500">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    Warranty End Date
                                </div>
                                <div class="bg-gray-50 p-4 rounded-lg border border-gray-100">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <span class="text-lg font-semibold text-gray-900 block">
                                                {{ $assets->warranty_end_date ? \Carbon\Carbon::parse($assets->warranty_end_date)->format('d M Y') : 'N/A' }}
                                            </span>
                                            @if($assets->warranty_end_date)
                                                @php
                                                    $daysLeft = \Carbon\Carbon::parse($assets->warranty_end_date)->diffInDays(\Carbon\Carbon::now(), false) * -1;
                                                @endphp
                                                <span class="text-sm text-gray-500 block mt-1">
                                                    @if($daysLeft > 0)
                                                        {{ $daysLeft }} days remaining
                                                    @else
                                                        {{ substr( abs($daysLeft),0,4) }} days expired
                                                    @endif
                                                </span>
                                            @endif
                                        </div>
                                        @if($assets->warranty_end_date && \Carbon\Carbon::today()->lte(\Carbon\Carbon::parse($assets->warranty_end_date)))
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-700 border border-green-200">
                                                <span class="w-2 h-2 rounded-full bg-green-400 mr-2"></span>
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-rose-100 text-rose-700 border border-rose-200">
                                                <span class="w-2 h-2 rounded-full bg-rose-400 mr-2"></span>
                                                Expired
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if($assets->assigned_to && $assets->user)
                            <div class="space-y-2">
                                <div class="flex items-center text-sm font-medium text-gray-500">
                                    <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    Assigned To
                                </div>
                                <div class="bg-blue-50 p-4 rounded-lg border border-blue-100">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <span class="text-lg font-semibold text-gray-900 block">{{ $assets->user->name }}</span>
                                            <span class="text-sm text-gray-500">{{ $assets->user->email }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection