@extends('assetsmanagement::layouts.app')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
    <header class="sticky top-0 z-10 bg-white/95 backdrop-blur supports-[backdrop-filter]:bg-white/60 shadow-lg">
        <div class="container mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-4">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        <h1 class="ml-2 text-2xl font-bold bg-gradient-to-r from-purple-600 to-blue-600 bg-clip-text text-transparent">
                            Assets Management
                        </h1>
                    </div>
                    <span class="hidden md:inline px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                        Dashboard
                    </span>
                </div>

                <div class="flex items-center space-x-6">
                    <div class="relative">
                        <button class="p-2 rounded-full hover:bg-gray-100 transition-colors">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11
                                    a6.002 6.002 0 00-4-5.659V4a2 2 0 10-4 0v1.341
                                    C7.67 6.165 6 8.388 6 11v3.159
                                    c0 .538-.214 1.055-.595 1.436L4 17h5
                                    m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            {{-- <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span> --}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Total Assets</p>
                        <p class="text-3xl font-bold text-gray-800">{{$assets->count()}}</p>
                    </div>
                    <div class="p-3 rounded-full bg-blue-50">
                        <svg class="w-8 h-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-8 border-green-500 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Active Vendors</p>
                        <p class="text-3xl font-bold text-gray-800">{{$vendor->count()}}</p>
                    </div>
                    <div class="p-3 rounded-full bg-green-50">
                        <svg class="w-8 h-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">Total Purchase</p>
                        <p class="text-3xl font-bold text-gray-800">{{number_format($totalAmount,2)}}</p>

                    </div>
                    <div class="p-3 rounded-full bg-purple-50">
                        <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6 border-l-8 border-orange-500 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-sm text-gray-500 font-medium mb-1">In Stocks</p>
                        <p class="text-3xl font-bold text-gray-800">{{$assets->where('status','active')->count()}}</p>
                       
                    </div>
                    <div class="p-3 rounded-full bg-orange-50">
                        <svg class="w-8 h-8 text-orange-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Purchasing Trends</h3>
                    </div>
                    <select class="px-4 py-2 rounded-lg border border-gray-300 bg-white focus:outline-none focus:ring-2 focus:ring-purple-500 text-sm">
                        <option>Last  months</option>
                        <option>Last year</option>
                    </select>
                </div>
                <div class="h-[400px]">
                    <canvas id="purchaseChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800">Top <span class="text-red-900">(5)</span> Vendors</h3>
                    </div>
                    <a href="{{route('asset-management.index')}}" class="px-4 py-2 bg-purple-50 text-purple-600 rounded-lg font-medium hover:bg-purple-100 transition-colors text-sm">
                        View All
                    </a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b">
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Vendor</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Contact</th>
                                <th class="text-left py-3 px-4 text-sm font-medium text-gray-500">Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vendor as $item)
                                <tr class="border-b hover:bg-gray-50 transition-colors">
                                    <td class="py-4 px-4">
                                        <div class="flex items-center">
                                            <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                                <span class="text-blue-600 font-semibold text-sm">{{ substr($item->company_name, 0, 2) }}</span>
                                            </div>
                                            <div>
                                                <p class="font-medium">{{ $item->company_name ?? '-' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4">
                                        <p class="font-medium">{{ $item->email ?? '-' }}</p>
                                        <p class="text-xs text-gray-500">{{ $item->mobile_nbr ?? '-' }}</p>
                                    </td>
                                    <td class="py-4 px-4">
                                        <p class="font-bold text-gray-800">₹{{ number_format($item->invoices->sum('total_amount'), 2) }}</p>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        {{-- <tbody>
                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                            <span class="text-blue-600 font-semibold text-sm">TS</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">Tech Solutions</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="font-medium">tech@gmail.com</p>
                                    <p class="text-xs text-gray-500">+91 9876543214</p>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="font-bold text-gray-800">₹2,500</p>
                                </td>
                            </tr>
                            
                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center mr-3">
                                            <span class="text-purple-600 font-semibold text-sm">TS</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">Tech Solutions</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="font-medium">tech@gmail.com</p>
                                    <p class="text-xs text-gray-500">+91 9876543214</p>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="font-bold text-gray-800">₹1,800</p>
                                </td>
                               
                            </tr>
                            
                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-orange-100 flex items-center justify-center mr-3">
                                            <span class="text-orange-600 font-semibold text-sm">TS</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">Tech Solutions</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="font-medium">tech@gmail.com</p>
                                    <p class="text-xs text-gray-500">+91 9876543214</p>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="font-bold text-gray-800">₹3,200</p>
                                </td>
                                
                            </tr>
                            
                            <tr class="border-b hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                            <span class="text-green-600 font-semibold text-sm">TS</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">Tech Solutions</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="font-medium">tech@gmail.com</p>
                                    <p class="text-xs text-gray-500">+91 9876543214</p>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="font-bold text-gray-800">₹2,100</p>
                                </td>
                               
                            </tr>
                            
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="py-4 px-4">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center mr-3">
                                            <span class="text-red-600 font-semibold text-sm">TS</span>
                                        </div>
                                        <div>
                                            <p class="font-medium">Tech Solutions</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="font-medium">tech@gmail.com</p>
                                    <p class="text-xs text-gray-500">+91 9876543214</p>
                                </td>
                                <td class="py-4 px-4">
                                    <p class="font-bold text-gray-800">₹4,500</p>
                                </td>
                                
                            </tr>
                        </tbody> --}}
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('purchaseChart');
    
    // Generate gradient
    const gradient = ctx.getContext('2d').createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(128, 90, 255, 0.3)');
    gradient.addColorStop(1, 'rgba(128, 90, 255, 0.05)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep'],
            datasets: [{
                data: [12000,19000,15000,25000,22000,30200,30000,30000,25000],
                borderColor: 'rgba(128, 90, 255, 1)',
                backgroundColor: gradient,
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: 'white',
                pointBorderColor: 'rgba(128, 90, 255, 1)',
                pointBorderWidth: 2,
                pointRadius: 6,
                pointHoverRadius: 8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'white',
                    titleColor: '#374151',
                    bodyColor: '#374151',
                    borderColor: '#E5E7EB',
                    borderWidth: 1,
                    padding: 12,
                    boxPadding: 6,
                    callbacks: {
                        label: function(context) {
                            return `₹${context.parsed.y.toLocaleString()}`;
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)'
                    },
                    ticks: {
                        callback: function(value) {
                            return '₹' + value.toLocaleString();
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    }
                }
            },
           
        }
    });
});
</script>
@endsection