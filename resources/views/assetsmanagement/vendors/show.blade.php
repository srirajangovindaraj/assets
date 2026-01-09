@extends('assetsmanagement::layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-indigo-50 py-10">
    <div class="max-w-[1500px] mx-auto">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden mb-8 border border-gray-100">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-500 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl uppercase font-bold text-white">Vendor Details</h1>
                    </div>
                    <div class="bg-white/20 p-3 rounded-xl">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-10">
                    <div class="bg-indigo-50 p-4 rounded-xl border border-indigo-100">
                        <div class="flex items-center">
                            <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Vendor ID</p>
                                <p class="text-lg font-bold text-gray-800">{{ $vendor->id }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-blue-50 p-4 rounded-xl border border-blue-100">
                        <div class="flex items-center">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Created</p>
                                <p class="text-lg font-bold text-gray-800">{{ $vendor->created_at->format('d M, Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-green-50 p-4 rounded-xl border border-green-100">
                        <div class="flex items-center">
                            <div class="bg-green-100 p-2 rounded-lg mr-3">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Last Updated</p>
                                <p class="text-lg font-bold text-gray-800">{{ $vendor->updated_at->format('d M, Y') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-8">
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="h-10 w-1 bg-indigo-600 rounded-full"></div>
                            <h3 class="text-xl font-bold text-gray-800">Basic Information</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-6">
                                <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                                    <div class="flex items-center mb-4">
                                        <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500">Company Name</h4>
                                            <p class="text-lg font-semibold text-gray-800 mt-1">{{ $vendor->company_name }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                                    <div class="flex items-center mb-4">
                                        <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500">Contact Person</h4>
                                            <p class="text-lg font-semibold text-gray-800 mt-1">
                                                {{ $vendor->contact_person_name ?? 'Not Specified' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                                    <div class="flex items-start mb-4">
                                        <div class="bg-green-100 p-2 rounded-lg mr-3 mt-1">
                                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            </svg>
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-medium text-gray-500">Address</h4>
                                            <p class="text-lg font-semibold text-gray-800 mt-1">
                                                {{ $vendor->address ?? 'Address not provided' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                                    <div class="flex items-center mb-4">
                                        <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium text-gray-500">Email Address</h4>
                                            <p class="text-lg font-semibold text-gray-800 mt-1">{{ $vendor->email }}</p>
                                        </div>
                                        <a href="mailto:{{ $vendor->email }}" 
                                           class="ml-4 p-2 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                                            <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>

                                <div class="bg-gray-50 p-5 rounded-xl border border-gray-200">
                                    <div class="flex items-center mb-4">
                                        <div class="bg-orange-100 p-2 rounded-lg mr-3">
                                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                                            </svg>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="text-sm font-medium text-gray-500">Mobile Number</h4>
                                            <p class="text-lg font-semibold text-gray-800 mt-1">{{ $vendor->mobile_nbr }}</p>
                                        </div>
                                        <a href="tel:{{ $vendor->mobile_nbr }}" 
                                           class="ml-4 p-2 bg-orange-50 rounded-lg hover:bg-orange-100 transition">
                                            <svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6 pt-8 border-t border-gray-200">
                        <div class="flex items-center space-x-3 mb-6">
                            <div class="h-10 w-1 bg-purple-600 rounded-full"></div>
                            <h3 class="text-xl font-bold text-gray-800">Tax & Identification</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="bg-gray-50 p-5 rounded-xl border border-gray-200 hover:shadow-md transition duration-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-indigo-100 p-2 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">GST Number</h4>
                                        <p class="text-lg font-semibold text-gray-800 mt-1">
                                            {{ $vendor->gst_no ?? 'Not Provided' }}
                                        </p>
                                    </div>
                                </div>
                               
                            </div>

                            <div class="bg-gray-50 p-5 rounded-xl border border-gray-200 hover:shadow-md transition duration-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">PAN Number</h4>
                                        <p class="text-lg font-semibold text-gray-800 mt-1">
                                            {{ $vendor->pan_no ?? 'Not Provided' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="bg-gray-50 p-5 rounded-xl border border-gray-200 hover:shadow-md transition duration-200">
                                <div class="flex items-center mb-4">
                                    <div class="bg-green-100 p-2 rounded-lg mr-3">
                                        <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-medium text-gray-500">Aadhaar Number</h4>
                                        <p class="text-lg font-semibold text-gray-800 mt-1">
                                            {{ $vendor->adhar_no ?? 'Not Provided' }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row justify-end items-center pt-10 mt-8 border-t border-gray-200 space-y-4 sm:space-y-0">
                    <div class="flex space-x-4">
                        <a href="{{ route('asset-management.index') }}" 
                           class="px-8 py-3 border-2 border-gray-300 text-gray-700 font-medium rounded-xl hover:bg-gray-50 hover:border-gray-400 transition duration-200 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Back to List
                        </a>
                        <a href="{{ route('asset-management.vendor.edit', $vendor->id) }}" 
                           class="px-8 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 text-white font-medium rounded-xl hover:from-indigo-700 hover:to-purple-700 transition duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                            </svg>
                            Edit Vendor
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection