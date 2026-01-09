<div class="bg-white flex min-h-screen">
    <aside class="w-72 min-h-screen bg-cyan-800   shadow-xl border-r border-gray-100">
        <div class="h-20 flex items-center px-6 border-b border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-xl flex items-center justify-center shadow-lg">
                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <div>
                    <h1 class="text-xl font-bold text-white tracking-tight">AssetFlow</h1>
                    <p class="text-xs text-white font-medium">Management System</p>
                </div>
            </div>
        </div>

        <nav class="mt-8 px-4 space-y-1">
            <a href="{{ route('asset-management.home') }}"
                class="flex items-center px-4 py-3.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out
                    {{ request()->routeIs('home') 
                        ? 'bg-blue-50 text-blue-700 border-l-4 border-blue-600 shadow-sm' 
                        : 'text-white hover:bg-gray-50 hover:text-gray-900 hover:shadow-sm' }}">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex  items-center justify-center rounded-lg {{ request()->routeIs('home') ? 'bg-blue-100' : 'bg-gray-100' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('home') ? 'text-blue-600' : 'text-gray-500' }}" 
                            fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" 
                                d="M10.707 1.707a1 1 0 00-1.414 0L1 10h3v8a1 1 0 001 1h4v-6h2v6h4a1 1 0 001-1v-8h3L10.707 1.707z" 
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <span class="font-bold ">Dashboard</span>
                </div>
                @if(request()->routeIs('home'))
                <div class="ml-auto w-2 h-2 bg-blue-600 rounded-full"></div>
                @endif
            </a>

            <a href="{{ route('asset-management.index') }}"
                class="flex items-center px-4 py-3.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out
                      {{ request()->routeIs('vendor.index', 'vendor.vendor.create', 'vendor.vendor.edit','vendor.vendor.details') 
                        ? 'bg-blue-50 text-blue-700 border-l-4 border-cyan-600 shadow-sm' 
                        : 'text-white hover:bg-gray-50 hover:text-gray-900 hover:shadow-sm' }}">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('vendor.*') ? 'bg-cyan-100' : 'bg-gray-100' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('vendor.index', 'vendor.vendor.create', 'vendor.vendor.edit','vendor.vendor.details')  ? 'text-cyan-600' : 'text-gray-500' }}" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857M12 12a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                    </div>
                    <span class="font-bold">Vendors</span>
                </div>
                @if(request()->routeIs('vendor.*'))
                <div class="ml-auto w-2 h-2 bg-cyan-600 rounded-full"></div>
                @endif
            </a>

            <a href="{{ route('asset-management.invoice.index') }}"
                class="flex items-center px-4 py-3.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out
                    {{ request()->routeIs('invoice.*') || request()->routeIs('invoiceitems')
                        ? 'bg-blue-50 text-blue-700 border-l-4 border-red-600 shadow-sm' 
                        : 'text-white hover:bg-gray-50 hover:text-gray-900 hover:shadow-sm' }}">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('invoice.*') ? 'bg-red-100' : 'bg-gray-100' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('invoice.*') ? 'text-red-600' : 'text-gray-500' }}" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V4a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <span class="font-bold">Invoices</span>
                </div>
                @if(request()->routeIs('invoice.*') || request()->routeIs('invoiceitems'))
                <div class="ml-auto w-2 h-2 bg-red-600 rounded-full"></div>
                @endif
            </a>
            <a href="{{ route('asset-management.assets.index') }}"
                class="flex items-center px-4 py-3.5 text-sm font-medium rounded-lg transition-all duration-200 ease-in-out
                    {{ request()->routeIs('assets.*') 
                        ? 'bg-blue-50 text-blue-700 border-l-4 border-green-600 shadow-sm' 
                        : 'text-white hover:bg-gray-50 hover:text-gray-900 hover:shadow-sm' }}">
                <div class="flex items-center space-x-3">
                    <div class="w-8 h-8 flex items-center justify-center rounded-lg {{ request()->routeIs('assets.*') ? 'bg-green-100' : 'bg-gray-100' }}">
                        <svg class="w-4 h-4 {{ request()->routeIs('assets.*') ? 'text-green-600' : 'text-gray-500' }}" 
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M20 13V7a2 2 0 00-2-2H6a2 2 0 00-2 2v6m16 0l-8 5-8-5m16 0v6a2 2 0 01-2 2H6a2 2 0 01-2-2v-6" />
                        </svg>
                    </div>
                    <span class="font-bold">Assets</span>
                </div>
                @if(request()->routeIs('assets.*'))
                <div class="ml-auto w-2 h-2 bg-green-600 rounded-full"></div>
                @endif
            </a>
        </nav>

    </aside>


</div>