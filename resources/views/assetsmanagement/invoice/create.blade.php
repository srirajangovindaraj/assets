@extends('assetsmanagement::layouts.app')

@section('content')
    @if (session('success'))
        <div id="success-alert"
            class="mt-10 flex items-center justify-between rounded-lg bg-green-100 border border-green-300 text-green-800 px-6 py-4 shadow-sm"
            role="alert">
            <span class="font-semibold">
                {{ session('success') }}
            </span>
        </div>
    @endif
    @if (session('error'))
        <div id="error-alert"
            class="mt-10 flex items-center justify-between rounded-lg bg-red-100 border border-red-300 text-red-800 px-6 py-4 shadow-sm"
            role="alert">
            <span class="font-semibold">
                {{ session('error') }}
            </span>
        </div>
    @endif
    @if ($errors->any())
        <div id="validation-alert" class="mt-10 rounded-lg bg-red-50 border border-red-300 px-6 py-4 shadow-sm">
            <ul class="list-disc list-inside text-red-800 font-medium space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="max-w-[1500px] mx-auto py-8 px-4">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 px-8 py-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="h-8 w-8 text-white mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <h2 class="text-2xl font-bold text-white">Create Invoice</h2>
                    </div>
                    <div class="bg-indigo-500/20 px-4 py-2 rounded-lg">
                        <span class="text-sm font-medium text-indigo-100">New Invoice</span>
                    </div>
                </div>
            </div>

            <form method="POST" action="{{ route('asset-management.invoice.store') }}" enctype="multipart/form-data" class="p-8">
                @csrf

                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="h-10 w-1 bg-indigo-600 rounded mr-3"></div>
                        <h3 class="text-lg font-semibold text-gray-800">Basic Information1</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 text-gray-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                        </path>
                                    </svg>
                                    Vendor *
                                </span>
                            </label>

                            {{-- <div class="relative">
                                <select name="vendor_id" required
                                    class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 appearance-none bg-white">
                                    <option value="">Select Vendor</option>
                                    @foreach ($vendors as $vendor)
                                        <option value="{{ $vendor->id }}"
                                            {{ old('vendor_id') == $vendor->id ? 'selected' : '' }}>
                                            {{ $vendor->company_name }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 9l4-4 4 4m0 6l-4 4-4-4"></path>
                                    </svg>
                                </div>
                            </div> --}}

                            <div class="relative ">
                                    <select id="vendorSearch" name="vendor_id"
                                    class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 bg-white">
                                </select>

                            </div>


                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 text-gray-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                        </path>
                                    </svg>
                                    Invoice Number *
                                </span>
                            </label>
                            <input type="text" name="invoice_number" value="{{ old('invoice_number') }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                placeholder="INV-001">
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 text-gray-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    Invoice Date *
                                </span>
                            </label>
                            <div class="relative">
                                <input type="date" id="invoiceDate" value="{{ old('invoice_date') }}" name="invoice_date"
                                    required
                                    class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 text-gray-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Status
                                </span>
                            </label>
                            <select name="status" id="statusSelect"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">

                                <option value="" disabled {{ old('status') ? '' : 'selected' }}>
                                    Select Status
                                </option>

                                <option value="unpaid" class="text-orange-600"
                                    {{ old('status') == 'unpaid' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="paid" class="text-green-600"
                                    {{ old('status') == 'paid' ? 'selected' : '' }}>
                                    Paid
                                </option>

                                <option value="partial_paid" class="text-blue-600"
                                    {{ old('status') == 'partial_paid' ? 'selected' : '' }}>
                                    Partial Paid
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 text-gray-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z">
                                        </path>
                                    </svg>
                                    Category
                                </span>
                            </label>
                            <select name="category" id="categorySelect"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">

                                <option value="" disabled {{ old('category') ? '' : 'selected' }}>
                                    Select Category
                                </option>

                                <option value="electronics" {{ old('category') == 'electronics' ? 'selected' : '' }}>
                                    Electronics
                                </option>

                                <option value="books" {{ old('category') == 'books' ? 'selected' : '' }}>
                                    Books
                                </option>

                                <option value="furniture" {{ old('category') == 'furniture' ? 'selected' : '' }}>
                                    Furniture
                                </option>
                            </select>
                        </div>
                        <div id="partialAmountDiv"
                            class="hidden space-y-2 {{ old('status') == 'partial_paid' ? '' : 'hidden' }}">
                            <label class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 text-gray-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    Partial Paid Amount
                                </span>
                            </label>
                            <input type="number" name="partial_amount" value="{{ old('partial_amount') }}"
                                id="partialAmount"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                placeholder="0.00" step="0.01">
                        </div>

                        <div id="duedateDiv" class="hidden space-y-2">
                            <label class="block text-sm font-medium text-gray-700">
                                <span class="flex items-center">
                                    <svg class="h-4 w-4 text-gray-500 mr-1" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                        </path>
                                    </svg>
                                    Due Date <span class="text-red-400">(Due Date is Greater than Invoice Date)</span>
                                </span>
                            </label>
                            <input type="date" name="due_date" value="{{ old('due_date') }}" id="duedate"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                placeholder="0.00" step="0.01">
                        </div>

                    </div>
                </div>

                <div class="mb-10">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="h-10 w-1 bg-indigo-600 rounded mr-3"></div>
                            <h3 class="text-lg font-semibold text-gray-800">Invoice Items</h3>
                        </div>
                        <button type="button" id="addRow"
                            class="flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition duration-200">
                            <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Add Item
                        </button>
                    </div>

                    <div class="overflow-x-auto rounded-lg border border-gray-200">
                        <table class="w-full" id="itemsTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Product</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Quantity</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Price</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Amount</th>
                                    <th
                                        class="px-6 py-4 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200"></tbody>
                        </table>
                    </div>
                </div>

                <div class="mb-10">
                    <div class="flex items-center mb-6">
                        <div class="h-10 w-1 bg-indigo-600 rounded mr-3"></div>
                        <h3 class="text-lg font-semibold text-gray-800">Invoice Totals</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
                        <div class="bg-gray-50 p-6 rounded-lg border border-gray-200">
                            <label class="block text-sm font-medium text-gray-600 mb-2">Sub Total</label>
                            <div class="text-2xl font-bold text-gray-900" id="subTotalDisplay">0.00</div>
                            <input type="hidden" id="subTotal" name="sub_total" value="{{ old('sub_total') }}"
                                readonly>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Discount Type</label>
                            <select id="discountType" name="discount_type"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200">
                                <option value="">No Discount</option>
                                <option value="percentage">Percentage %</option>
                                <option value="amount">Amount</option>
                            </select>
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700">Discount Value</label>
                            <input id="discountValue"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200"
                                placeholder="0.00">
                        </div>

                        <div class="bg-blue-50 p-6 rounded-lg border border-blue-200">
                            <label class="block text-sm font-medium text-blue-600 mb-2">Tax Amount</label>
                            <div class="text-2xl font-bold text-blue-900" id="taxAmountDisplay">0.00</div>
                            <input type="hidden" id="taxAmount" name="tax_amount" value="{{ old('tax_amount') }}"
                                readonly>
                        </div>

                        <div class="bg-indigo-50 p-6 rounded-lg border border-indigo-200">
                            <label class="block text-sm font-medium text-indigo-600 mb-2">Grand Total</label>
                            <div class="text-2xl font-bold text-indigo-900" id="grandTotalDisplay">0.00</div>
                            <input type="hidden" id="grandTotal" name="total_amount" value="{{ old('total_amount') }}"
                                readonly>
                        </div>
                    </div>

                    <input type="hidden" name="discount_percentage" id="discountPercentage">
                    <input type="hidden" name="discount_amount" id="discountAmount">
                </div>

                <div class="flex items-center justify-end pt-8 border-t border-gray-200">
                    {{-- <div class="mb-10">
                        <div class="flex items-center mb-6">
                            <h3 class="text-lg font-semibold text-gray-800">Attachments</h3>
                        </div>
                        <div>
                            <input name="invoice_file_path" type="file">
                        </div>
                    </div> --}}


                    <button type="submit"
                        class="flex  items-center px-8 py-3 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white rounded-lg shadow-md hover:shadow-lg transition duration-200">
                        <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4">
                            </path>
                        </svg>
                        Save Invoice
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
    window.TAX_RATES = @json(config('assetmanagement.taxrates'));
    console.log(window.TAX_RATES);
</script>

<style>

.select2-container--default .select2-selection--single {
    height: 3rem;   
    padding: 0 1rem 0 2.5rem; /* top/bottom 0, left 2.5rem, right 1rem */
    border-radius: 0.5rem; 
    border: 1px solid #d1d5db;
    display: flex;
    align-items: center; /* vertically center content */
}



/* Adjust the arrow to center vertically */
.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 100%;
    /* top: 0; */
    /* display: flex; */
    /* align-items: center; */
}

</style>
    <script>
        $(document).ready(function() {
            $('#vendorSearch').select2({
                placeholder: "Search Vendor",
                allowClear: true,
                minimumInputLength: 3,
                ajax: {
                    url: '{{ route("asset-management.invoice.search") }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term,
                        };
                    },
                    processResults: function(data) {
                        console.log("AJAX data received:", data);
                        return {
                            results: $.map(data, function(item) {
                                return {
                                    id: item.id,
                                    text: item.company_name
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        });
    </script>

@endsection
