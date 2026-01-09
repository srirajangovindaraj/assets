@php
    $type = get_class($model);
@endphp

<div class="mt-8 max-w-7xl mx-auto">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-8 gap-4">
        <div class="flex items-center gap-3">
            <div class="p-3 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-xl shadow-sm">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Comments Management</h2>
            </div>
        </div>

    </div>

    <div class="mb-8 bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Add New Comment</h3>
        <form method="POST" action="{{ route('asset-management.comments.store') }}" class="space-y-6">
            @csrf
            <input type="hidden" name="model_type" value="{{ $type }}">
            <input type="hidden" name="model_id" value="{{ $model->id }}">

            <div>
                <textarea id="comment" name="comment" required rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 resize-none bg-gray-50 hover:bg-white"
                    placeholder="Enter your comment here..."></textarea>
            </div>

            <div class="flex items-center justify-end pt-4 border-t border-gray-100">
                <button type="submit"
                    class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 focus:ring-4 focus:ring-blue-100 transition-all duration-200 flex items-center gap-2">
                    Submit Comment
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Comments List</h3>
                <div class="flex items-center gap-3 mt-2 sm:mt-0">
                    <span class="text-sm text-gray-600">Showing {{ $model->comments->count() }} comments</span>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 text-center text-md font-semibold text-gray-700 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-md font-semibold text-gray-700 uppercase tracking-wider">
                            Comment
                        </th>
                        <th scope="col"
                            class="px-6 py-3 text-center text-md font-semibold text-gray-700 uppercase tracking-wider">
                            Comment By
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($model->comments as $comment)
                        <tr class="hover:bg-gray-50 text-center transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $comment->created_at->format('M d, Y') }}</div>
                                {{-- <div class="text-xs text-gray-500">{{ $comment->created_at->format('h:i A') }}</div> --}}
                            </td>

                            <td class="px-6 py-4">
                                <div class="max-w-2xl">
                                    <p class="text-sm text-center text-gray-900 truncate">
                                        {{ $comment->comment }}
                                    </p>
                                </div>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                {{ $comment->user->name ?? 'N/A' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div
                                        class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                        </svg>
                                    </div>
                                    <h4 class="text-lg font-medium text-gray-900 mb-2">No comments yet</h4>
                                    <p class="text-gray-500 max-w-md mb-4">Be the first to share your thoughts!</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
