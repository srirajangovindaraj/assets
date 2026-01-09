@extends('assetsmanagement::layouts.app')

@section('content')
@if(session('success'))
    <div id="success-msg" class="mb-4 p-4 rounded-lg bg-green-100 text-green-800">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div id="error-msg" class="mb-4 p-4 rounded-lg bg-red-100 text-red-800">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div id="validation-msg" class="mb-4 p-4 rounded-lg bg-red-100 border border-red-300">
        <ul class="list-disc list-inside text-red-700">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- @php
    $error = session()->get('error') ?? new \Illuminate\Support\ViewErrorBag;
@endphp --}}

<div class="max-w-[1500px] mx-auto mt-12">
    <div class="bg-white rounded-2xl shadow-xl border border-gray-100">
        <div class="px-8 py-6 border-b bg-gradient-to-r from-blue-500 to-indigo-500 rounded-t-2xl">
            <h2 class="text-3xl font-bold text-white text-center">
                Add New Vendor
            </h2>
        </div>

        <form method="POST" action="{{ route('asset-management.vendor.store') }}" class="p-8 space-y-6">
            @csrf

            <div>
                <label class="block font-medium text-gray-700 mb-2">
                    Vendor Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="company_name" value="{{ old('company_name') }}" required
                       class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                       placeholder="Enter vendor name">
                @error('company_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-2">Customer Name</label>
                <input type="text" name="contact_person_name" value="{{ old('contact_person_name') }}"
                       class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                       placeholder="Enter customer name">
                @error('contact_person_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                           placeholder="vendor@email.com" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-2">Mobile Number</label>
                    <input type="text" name="mobile_nbr" maxlength="10" value="{{ old('mobile_nbr') }}"
                           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                           placeholder="10-digit mobile number" required>
                    @error('mobile_nbr')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label class="block font-medium text-gray-700 mb-2">Website</label>
                <input type="url" name="website" value="{{ old('website') }}"
                       class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                       placeholder="https://example.com">
            </div>

            <!-- Address Fields -->
            <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 space-y-4">
                <h3 class="text-xl font-semibold text-gray-700">Address Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <input type="text" name="flat_no" placeholder="Flat / Door No" value="{{ old('flat_no') }}"
                           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none">
                    <input type="text" name="street" placeholder="Street" value="{{ old('street') }}"
                           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none">
                    <input type="text" name="area" placeholder="Area" value="{{ old('area') }}"
                           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none">
                    <input type="text" name="city" placeholder="City" value="{{ old('city') }}"
                           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none">
                    <input type="text" name="district" placeholder="District" value="{{ old('district') }}"
                           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none">
                    <input type="text" name="state" placeholder="State" value="{{ old('state') }}"
                           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none">
                    <input type="text" name="pin" placeholder="PIN Code" value="{{ old('pin') }}"
                           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none">
                    <input type="text" name="landmark" placeholder="Landmark" value="{{ old('landmark') }}"
                           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none">
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block font-medium text-gray-700 mb-2">GST Number</label>
                    <input type="text" name="gst_no" value="{{ old('gst_no') }}"
                           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                           placeholder="22ABCDE1234F1Z5">
                </div>

                <div>
                    <label class="block font-medium text-gray-700 mb-2">Landline Number</label>
                    <input type="text" name="landline_nbr" value="{{ old('landline_nbr') }}"
                           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                           placeholder="Landline number">
                </div>
            </div>

            <div class="bg-indigo-50 border border-indigo-200 rounded-xl p-6 space-y-4">
                <div class="flex items-center gap-2 text-indigo-700 font-semibold">
                    <span>PAN or Aadhaar (Any one is mandatory)</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block font-medium text-gray-700 mb-2">PAN Number</label>
                        <input type="text" name="pan_no" value="{{ old('pan_no') }}"
                               class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none uppercase"
                               placeholder="ABCDE1234F">
                    </div>

                    <div>
                        <label class="block font-medium text-gray-700 mb-2">Aadhaar Number</label>
                        <input type="text" name="adhar_no" value="{{ old('adhar_no') }}"
                               class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-indigo-400 outline-none"
                               placeholder="123456789012">
                    </div>
                </div>
            </div>

            <div class="flex justify-end gap-4 pt-6 border-t">
                <a href="{{ route('asset-management.index') }}"
                   class="px-6 py-3 border rounded-lg bg-gray-100 hover:bg-gray-200 transition">
                    Cancel
                </a>
                <button type="submit"
                        class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-lg hover:bg-indigo-700 transition shadow">
                    Save Vendor
                </button>
            </div>

        </form>
    </div>
</div>

 <script>
        const success = document.getElementById('success-msg');
        const error = document.getElementById('error-msg');
        const validation = document.getElementById('validation-msg');
        setTimeout(() => {
            if (success) {
                success.style.display = 'none';
            }

            if (error) {
                error.style.display = 'none';
            }
            if(validation)
            {
                validation.style.display = 'none';
            }
        }, 3000); 
    </script>
@endsection
