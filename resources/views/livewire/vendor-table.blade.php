
<div>
  <div class="max-w-[1500px] mx-auto mt-10">

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
    <div class="mb-4 p-4 rounded-lg bg-red-100 border border-red-300">
        <ul class="list-disc list-inside text-red-700">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


        <div class="bg-white rounded-2xl bg-gradient-to-r from-blue-500 to-indigo-500 shadow-xl border border-gray-100 overflow-hidden">

            <div class="px-8 py-6 border-b border-gray-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <h2 class="text-2xl uppercase font-extrabold  text-white">
                    Vendor Management
                </h2>

                <div class="flex flex-wrap gap-3 items-center">
                    <input id="searchInput" type="text"   wire:model.live="search" placeholder="Search vendors..."
                        class="pl-10 pr-4 py-2.5 w-full sm:w-64 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all">

                    <a href="{{ route('asset-management.vendor.create') }}"
                        class="px-4 py-2  text-white rounded-lg font-semibold uppercase  hover:shadow-lg hover:scale-105 transition">
                        + Add Vendor
                    </a>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[1000px] divide-y divide-gray-100" id="vendorTable">
                    <thead class="bg-gradient-to-r from-gray-50 to-gray-100">
                        <tr>
                            <th class="py-4 px-6 text-sm font-bold text-indigo-700 uppercase text-center">S No</th>
                            <th class="py-4 px-6 text-sm font-bold text-indigo-700 uppercase text-left">Vendor Name</th>
                            <th class="py-4 px-6 text-sm font-bold text-purple-700 uppercase text-left">Contact Person</th>
                            <th class="py-4 px-6 text-sm font-bold text-blue-700 uppercase text-left">Email</th>
                            <th class="py-4 px-6 text-sm font-bold text-gray-700 uppercase text-left">Mobile</th>
                            <th class="py-4 px-6 text-sm font-bold text-green-700 uppercase text-left">GST No</th>
                            <th class="py-4 px-6 text-sm font-bold text-orange-700 uppercase text-left">Aaadhar No</th>
                            <th class="py-4 px-6 text-sm font-bold text-slate-700 uppercase text-left">PAN No</th>
                            <th class="py-4 px-6 text-sm font-bold text-red-700 uppercase text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse($vendors as $index => $vendor)
                            <tr class="hover:bg-gray-50 transition-colors duration-150">
                                <td class="py-5 px-6 text-center font-medium text-gray-900">{{ $index + 1 }}</td>
                                <td class="py-5 px-6 font-semibold text-gray-900">{{ $vendor->company_name }}</td>
                                <td class="py-5 px-6 text-gray-700">{{ $vendor->contact_person_name ?? '-' }}</td>
                                <td class="py-5 px-6 text-gray-700">{{ $vendor->email }}</td>
                                <td class="py-5 px-6 text-gray-700">{{ $vendor->mobile_nbr }}</td>
                                <td class="py-5 px-6 text-gray-700">{{ $vendor->gst_no ?? '-' }}</td>
                                <td class="py-5 px-6 text-gray-700">{{ $vendor->adhar_no ?? '-' }}</td>
                                <td class="py-5 px-6 text-gray-700">{{ $vendor->pan_no ?? '-' }}</td>
                                <td class="py-5 px-6 text-center">
                                    <div class="flex justify-center space-x-3">
                                        <a href="{{ route('asset-management.vendor.edit', $vendor->id) }}" class="text-gray-500 hover:text-blue-600" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('asset-management.vendor.details', $vendor->id) }}" class="text-gray-500 hover:text-green-600" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('asset-management.vendor.destroy', $vendor->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-gray-500 hover:text-red-600" title="Delete" onclick="return confirm('Are you sure you want to delete this vendor?')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-6 text-gray-500 font-medium">No vendors found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
 <div class="mt-4">
        {{ $vendors->links() }} 
    </div>
    <script>
        const success = document.getElementById('success-msg');
        const error = document.getElementById('error-msg');
        setTimeout(() => {
            if (success) {
                success.style.display = 'none';
            }

            if (error) {
                error.style.display = 'none';
            }
        }, 3000); 
    </script>
</div>
