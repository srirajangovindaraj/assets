@extends('assetsmanagement::layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-gray-50 to-gray-100 py-8 px-4 sm:px-6 lg:px-8">
        <div class="max-w-[800px] mx-auto">
            @if (session('success'))
                <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4" role="alert">
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

            @if (session()->has('errors'))
                <div class="mb-6 bg-amber-50 border border-amber-200 text-amber-700 rounded-xl p-4" role="alert">
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
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border  border-gray-200">
                <div class="px-8 py-6 border-b bg-gradient-to-r from-indigo-600 to-indigo-700 border-gray-300">
                    <div class="flex items-center  justify-between">
                        <h1 class="text-3xl text-white font-bold">{{ $asset->invoiceItem->product_name }}</h1>
                        <p class="text-white mt-1">ID: {{ $asset->asset_code }}</p>
                    </div>
                </div>

                <hr class="border-gray-200">

                <form action="{{ route('asset-management.assets.update', $asset->id) }}" method="POST" class="px-8 py-8">
                    @csrf
                    @method('PUT')

                    <div class="mb-10">
                        <h2 class="text-lg text-green-500 font-semibold  mb-4">Asset Status</h2>

                        <div class="space-y-4">
                            <div class="relative">
                                <select name="status" id="status"
                                    class="w-full pl-12 pr-10 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-base font-medium appearance-none bg-white hover:border-gray-400 cursor-pointer transition duration-200">
                                    <option value="active" {{ old('status', $asset->status) == 'active' ? 'selected' : '' }}
                                        class="py-2 text-emerald-600 font-medium">Active</option>
                                    <option value="repair" {{ old('status', $asset->status) == 'repair' ? 'selected' : '' }}
                                        class="py-2 text-amber-600 font-medium">Repair</option>
                                    <option value="assigned"
                                        {{ old('status', $asset->status) == 'assigned' ? 'selected' : '' }}
                                        class="py-2 text-blue-600 font-medium">Assigned</option>
                                </select>
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                            </div>
                            @if (session('errors') && session('errors')->has('status'))
                                <p class="text-sm text-red-600 mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ session('errors')->first('status') }}
                                </p>
                            @endif

                        </div>
                    </div>
                    <div class="mb-10">
                        <h2 class="text-lg text-violet-600 font-semibold mb-4">Assign To User</h2>

                        <div class="space-y-4">
                            <div class="relative">
                                <select name="assigned_to" id="assigned_to"
                                    class="w-full pl-12 pr-10 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 text-base font-medium appearance-none bg-white hover:border-gray-400 cursor-pointer transition duration-200">
                                    <option value=""> user </option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ old('assigned_to', $asset->assigned_to) == $user->id ? 'selected' : '' }}
                                            class="py-2">
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute left-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
                                    </svg>
                                </div>
                            </div>
                            @if (session('errors') && session('errors')->has('assigned_to'))
                                <p class="text-sm text-red-600 mt-2 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    {{ session('errors')->first('assigned_to') }}
                                </p>
                            @endif

                        </div>
                    </div>
                    <div class="border-t border-gray-200 pt-8 mb-8">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="text-left py-3 text-sm font-medium text-red-600 uppercase  tracking-wider">
                                        LAST UPDATED</th>
                                    <th class="text-left py-3 text-sm font-medium text-cyan-600 uppercase tracking-wider">
                                        ASSET VALUE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="py-4">
                                        <span class="text-lg font-semibold text-gray-900">
                                            {{ $asset->updated_at->format('d-M-Y') }}

                                        </span>
                                    </td>
                                    <td class="py-4">
                                        <span class="text-2xl font-bold text-gray-900">
                                            ₹ {{ number_format($asset->invoiceItem->price ?? 0, 2) }}
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="flex space-x-4 pt-6 border-t border-gray-200">
                        <a href="{{ route('asset-management.assets.index') }}"
                            class="flex-1 inline-flex justify-center items-center px-6 py-4 border border-gray-300 rounded-xl text-gray-700 font-medium hover:bg-gray-50 transition duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Cancel
                        </a>
                        <button type="submit"
                            class="flex-1 inline-flex justify-center items-center px-6 py-4 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-medium rounded-xl hover:from-indigo-700 hover:to-purple-700 transition duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                            Update Asset
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
