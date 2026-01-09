@extends('layouts.app')

@section('content')
<div class="max-w-[600px] mt-12 mx-auto">
    <div class="bg-white rounded-xl shadow-xl w-full p-6">

        <h2 class="text-2xl font-bold text-indigo-700 mb-6">Add Asset</h2>

        <form action="{{ route('assets.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="font-medium text-violet-800">Invoice ID</label>
                <input type="number" name="invoice_id" class="w-full border rounded-lg p-3" placeholder="Invoice ID" required>
            </div>

            <div>
                <label class="font-medium text-violet-800">Product Name</label>
                <input type="text" name="product_name" class="w-full border rounded-lg p-3" placeholder="Product Name" required>
            </div>

            <div>
                <label class="font-medium text-violet-800">Category</label>
                <input type="text" name="category" class="w-full border rounded-lg p-3" placeholder="Category">
            </div>

            <div>
                <label class="font-medium text-violet-800">Cost</label>
                <input type="text" name="cost" class="w-full border rounded-lg p-3" placeholder="Cost" required>
            </div>

            <div>
                <label class="font-medium text-violet-800">Purchase Date</label>
                <input type="date" name="purchase_date" class="w-full border rounded-lg p-3" required>
            </div>

            <div>
                <label class="font-medium text-violet-800">Warranty Expiry</label>
                <input type="date" name="warranty_expiry" class="w-full border rounded-lg p-3">
            </div>

            <div>
                <label class="font-medium text-violet-800">Status</label>
                <select name="status" class="w-full border rounded-lg p-3">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <a href="{{ route('assets.index') }}" class="px-4 py-2 border rounded-lg">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
