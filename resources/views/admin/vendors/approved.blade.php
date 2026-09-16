@extends('layouts.admin')

@section('title', 'Approved Vendors - Admin')
@section('content')

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Approved Vendors</h1>
        <p class="text-gray-600">View and manage approved vendor partnerships</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <p class="text-gray-600 text-sm font-semibold">Total Approved Vendors</p>
            <p class="text-3xl font-bold text-gray-900">{{ $vendors->total() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <p class="text-gray-600 text-sm font-semibold">Pending Review</p>
            <p class="text-3xl font-bold text-gray-900">{{ $statusCounts['new'] + $statusCounts['contacted'] + $statusCounts['in_progress'] }}</p>
        </div>
    </div>

    <!-- Filters & Search -->
    <div class="bg-white rounded-lg shadow mb-8">
        <div class="p-6 border-b border-gray-200">
            <form method="GET" class="flex flex-col md:flex-row gap-4">
                <!-- Search -->
                <div class="flex-1">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Search by name, business, email, or phone..." 
                        value="{{ request('search') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                </div>

                <!-- Search Button -->
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors whitespace-nowrap">
                    <i class="fas fa-search mr-2"></i> Search
                </button>

                @if(request('search'))
                    <a href="{{ route('admin.vendors.approved') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors whitespace-nowrap">
                        <i class="fas fa-times mr-2"></i> Clear
                    </a>
                @endif
            </form>
        </div>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg flex items-start">
            <i class="fas fa-check-circle mr-3 mt-0.5 flex-shrink-0"></i>
            <div>
                <p class="font-semibold">Success!</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <!-- Vendors Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        @if($vendors->count())
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Contact Person</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Business</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Contact Info</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Partnership Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Approved Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($vendors as $vendor)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 text-sm font-medium text-gray-900">
                                    {{ $vendor->contact_person_name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $vendor->business_name }}
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <div class="text-xs">
                                        <i class="fas fa-envelope text-red-600 mr-1"></i>{{ $vendor->email }}<br>
                                        <i class="fas fa-phone text-red-600 mr-1"></i>{{ $vendor->phone }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">
                                        {{ $vendor->getPartnershipTypeLabel() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $vendor->updated_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4 text-sm whitespace-nowrap">
                                    <a href="{{ route('admin.vendors.show', $vendor) }}" class="text-red-600 hover:text-red-900 mr-4">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <form method="POST" action="{{ route('admin.vendors.destroy', $vendor) }}" class="inline" onsubmit="return confirm('Are you sure?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                {{ $vendors->links() }}
            </div>
        @else
            <div class="p-12 text-center">
                <i class="fas fa-check-circle text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-600 text-lg">No approved vendors yet</p>
                <p class="text-gray-500 text-sm mt-2">Vendors who have been approved will appear here.</p>
            </div>
        @endif
    </div>
</div>

@endsection
