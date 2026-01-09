@extends('assetsmanagement::layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-8">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">
                            Invoice Item Details
                        </h1>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-xl rounded-2xl overflow-hidden mb-8">
                <div class="px-6 py-5 bg-gradient-to-r from-gray-50 to-gray-100 border-b">
                    <h2 class="text-lg font-semibold text-gray-800">Assets List</h2>
                </div>

                <div class="divide-y divide-gray-200">
                    @forelse ($assets as $item)
                        <div class="p-6 hover:bg-gray-50 transition-colors duration-200">
                            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 text-center">

                                <div class="flex flex-col items-center space-y-2">
                                    <div class="flex items-center space-x-2">
                                        <div class="p-2 bg-gray-100 rounded-lg">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-medium text-gray-500">Asset Code</p>
                                    </div>

                                    <a href="{{ route('asset-management.assets.show', $item->id) }}"
                                        class="text-lg font-semibold text-blue-600 hover:text-blue-800">
                                        {{ $item->asset_code }}
                                    </a>
                                </div>

                                <div class="flex flex-col items-center space-y-2">
                                    <p class="text-sm font-medium text-gray-500">Product</p>
                                    <p class="text-lg font-medium text-gray-900">
                                        {{ $item->product_name }}
                                    </p>
                                </div>

                                <div class="flex flex-col items-center space-y-2">
                                    <p class="text-sm font-medium text-gray-500">Unit Price</p>
                                    <span class="text-2xl font-bold text-gray-900">
                                        {{ number_format($item->price, 2) }}
                                    </span>
                                </div>

                                <div class="flex flex-col items-center space-y-2">
                                    <p class="text-sm font-medium text-gray-500">Status</p>

                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
            @if ($item->status === 'repair') bg-red-100 text-red-800
            @elseif($item->status === 'active') bg-green-100 text-green-800
            @else bg-gray-100 text-gray-800 @endif
        ">
                                        <svg class="mr-1.5 h-2 w-2
                @if ($item->status === 'repair') text-red-400
                @elseif($item->status === 'active') text-green-400
                @else text-gray-400 @endif
            "
                                            fill="currentColor" viewBox="0 0 8 8">
                                            <circle cx="4" cy="4" r="3" />
                                        </svg>

                                        {{ ucfirst($item->status) }}
                                    </span>
                                </div>

                            </div>


                        </div>
                    @empty
                        <div class="p-12 text-center">
                            <div class="mx-auto h-12 w-12 text-gray-400">
                                <svg class="w-full h-full" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                </svg>
                            </div>
                            <h3 class="mt-4 text-lg font-medium text-gray-900">No assets found</h3>
                            <p class="mt-1 text-gray-500">This invoice doesn't have any associated assets.</p>
                        </div>
                    @endforelse
                </div>
            </div>



        </div>
    </div>
@endsection
