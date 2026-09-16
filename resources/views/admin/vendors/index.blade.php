@extends('layouts.admin')

@section('title', 'Vendor Inquiries - Admin')
@section('content')

<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Vendor Inquiries</h1>
        <p class="text-gray-600">Manage and track partnership inquiries from potential vendors</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-8">
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-blue-500">
            <p class="text-gray-600 text-sm font-semibold">Total Inquiries</p>
            <p class="text-3xl font-bold text-gray-900">{{ $vendors->total() }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-yellow-500">
            <p class="text-gray-600 text-sm font-semibold">New</p>
            <p class="text-3xl font-bold text-gray-900">{{ $statusCounts['new'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
            <p class="text-gray-600 text-sm font-semibold">Contacted</p>
            <p class="text-3xl font-bold text-gray-900">{{ $statusCounts['contacted'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-orange-500">
            <p class="text-gray-600 text-sm font-semibold">In Progress</p>
            <p class="text-3xl font-bold text-gray-900">{{ $statusCounts['in_progress'] }}</p>
        </div>
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-green-500">
            <p class="text-gray-600 text-sm font-semibold">Approved</p>
            <p class="text-3xl font-bold text-gray-900">{{ $statusCounts['approved'] }}</p>
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

                <!-- Status Filter -->
                <div class="w-full md:w-48">
                    <select name="status" onchange="this.form.submit()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                        <option value="">All Statuses</option>
                        <option value="new" {{ request('status') === 'new' ? 'selected' : '' }}>New</option>
                        <option value="contacted" {{ request('status') === 'contacted' ? 'selected' : '' }}>Contacted</option>
                        <option value="in_progress" {{ request('status') === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Approved</option>
                        <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Rejected</option>
                    </select>
                </div>

                <!-- Search Button -->
                <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors whitespace-nowrap">
                    <i class="fas fa-search mr-2"></i> Search
                </button>

                @if(request('search') || request('status'))
                    <a href="{{ route('admin.vendors.index') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-400 transition-colors whitespace-nowrap">
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Date</th>
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
                                <td class="px-6 py-4 text-sm">
                                    @if($vendor->status === 'new')
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                            {{ $vendor->getStatusLabel() }}
                                        </span>
                                    @elseif($vendor->status === 'contacted')
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-800">
                                            {{ $vendor->getStatusLabel() }}
                                        </span>
                                    @elseif($vendor->status === 'in_progress')
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-orange-100 text-orange-800">
                                            {{ $vendor->getStatusLabel() }}
                                        </span>
                                    @elseif($vendor->status === 'approved')
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                            {{ $vendor->getStatusLabel() }}
                                        </span>
                                    @else
                                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                            {{ $vendor->getStatusLabel() }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-600">
                                    {{ $vendor->created_at->format('M d, Y') }}
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
                <i class="fas fa-inbox text-gray-400 text-4xl mb-4"></i>
                <p class="text-gray-600 text-lg">No vendor inquiries found</p>
                <p class="text-gray-500 text-sm mt-2">Vendor inquiries will appear here when they submit the partnership form.</p>
            </div>
        @endif
    </div>
</div>

@endsection
