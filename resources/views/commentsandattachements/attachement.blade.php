@php
    $type = get_class($model);
@endphp

<div class="mt-6 max-w-7xl mx-auto bg-white border border-gray-200 rounded-lg shadow-sm">
    <div class="px-6 py-4 border-b border-gray-200 bg-gray-50 rounded-t-lg">
        <h3 class="text-lg font-semibold text-gray-800 flex items-center">
            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13">
                </path>
            </svg>
            Attachments ({{ $model->attachments->count() }})
        </h3>
    </div>

    <div class="p-6 border-b border-gray-200">
        <form method="POST" action="{{ route('asset-management.attachments.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <input type="hidden" name="model_type" value="{{ $type }}">
            <input type="hidden" name="model_id" value="{{ $model->id }}">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Select File
                    </label>
                    <input type="file" name="file" required
                        class="block w-full text-sm text-gray-500
                   file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0
                   file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700
                   hover:file:bg-blue-100">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Document Type
                    </label>
                    <select name="file_type" required
                        class="mt-1 block w-full pl-3 pr-10 py-2 text-base border border-gray-300 
                   focus:outline-none focus:ring-blue-500 focus:border-blue-500 
                   sm:text-sm rounded-md">
                        <option value="">Select type</option>
                        <option value="invoice">Invoice</option>
                        <option value="products">Products</option>
                        <option value="other">Other Document</option>
                    </select>
                </div>

                <div class="flex items-end">
                    <button type="submit"
                        class="inline-flex ml-24 items-center px-4 py-2 border border-transparent rounded-md shadow-sm 
                   text-sm font-medium text-white bg-blue-600 hover:bg-blue-700
                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500
                   transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                        </svg>
                        Upload Document
                    </button>
                </div>
            </div>

        </form>
    </div>

    <div class="p-6">
        @if ($model->attachments->count() > 0)
            <h4 class="text-sm font-medium text-gray-700 mb-4">Uploaded Files</h4>
            <div class="space-y-3">

                <div class="overflow-x-auto mt-4">
                    <table class="min-w-full border border-gray-200 rounded-lg">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left  text-md font-semibold text-gray-700">Id</th>
                                <th class="px-4 py-2 text-left text-md font-semibold text-gray-700">File Name</th>
                                <th class="px-4 py-2 text-left text-md font-semibold text-gray-700">Type</th>
                                <th class="px-4 py-2 text-left text-md font-semibold text-gray-700">Uploaded On</th>
                                <th class="px-4 py-2 text-center text-md font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($model->attachments as $file)
                                {{-- @php
                dd($file)
                @endphp --}}
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2  text-gray-900">
                                        {{ $file->id }}
                                    </td>
                                    <td class="px-4 py-2  text-gray-900">
                                        {{ $file->original_filename }}
                                    </td>

                                    <td class="px-4 py-2  text-gray-700">
                                        {{ $file->file_type ?? '-' }}
                                    </td>

                                    <td class="px-4 py-2  text-gray-600">
                                        {{ $file->created_at->format('M d, Y') }}
                                    </td>

                                    <td class="px-4 flex justify-center py-2 text-center space-x-2">

                                        <div x-data="{ open: false, imgUrl: '' }">
                                            <a href="#"
                                                @click.prevent="open = true; imgUrl='{{ asset('storage/' . $file->file_path) }}'"
                                                class="inline-flex items-center px-2 py-1  rounded bg-blue-100 text-blue-700 hover:bg-blue-200">
                                                View
                                            </a>
                                            <div x-show="open" style="display: none;"
                                                class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
                                                <div
                                                    class="bg-white p-4 rounded shadow-lg max-w-xl max-h-[80vh] overflow-auto">
                                                    <button @click="open = false"
                                                        class="float-right text-gray-500 hover:text-gray-900">&times;</button>
                                                    <img :src="imgUrl"
                                                        class="max-w-full max-h-[70vh] mt-4 mx-auto rounded"
                                                        alt="Attachment">
                                                </div>
                                            </div>
                                        </div>


                                        <a href="{{ asset('storage/' . $file->file_path) }}" download
                                            class="inline-flex items-center px-2 py-1  rounded bg-gray-100 text-gray-700 hover:bg-gray-200">
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        @else
            <div class="text-center py-8">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No attachments</h3>
            </div>
        @endif
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
