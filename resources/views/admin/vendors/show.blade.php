@extends('layouts.admin')

@section('title', 'Vendor Inquiry Details - Admin')
@section('content')

<div class="container mx-auto px-4 py-8">
    <!-- Header with Back Button -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <a href="{{ route('admin.vendors.index') }}" class="text-red-600 hover:text-red-900 mb-4 inline-block">
                <i class="fas fa-arrow-left mr-2"></i> Back to Inquiries
            </a>
            <h1 class="text-3xl font-bold text-gray-900">Vendor Inquiry Details</h1>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Inquiry Information -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Inquiry Information</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Contact Person Name -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-user text-red-600 mr-2"></i> Contact Person Name
                            </label>
                            <p class="text-gray-900 font-medium">{{ $vendor->contact_person_name }}</p>
                        </div>

                        <!-- Business Name -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-building text-red-600 mr-2"></i> Business Name
                            </label>
                            <p class="text-gray-900 font-medium">{{ $vendor->business_name }}</p>
                        </div>

                        <!-- Email -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-envelope text-red-600 mr-2"></i> Email
                            </label>
                            <a href="mailto:{{ $vendor->email }}" class="text-red-600 hover:text-red-900">
                                {{ $vendor->email }}
                            </a>
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-phone text-red-600 mr-2"></i> Phone
                            </label>
                            <a href="tel:{{ $vendor->phone }}" class="text-red-600 hover:text-red-900">
                                {{ $vendor->phone }}
                            </a>
                        </div>

                        <!-- Location -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt text-red-600 mr-2"></i> Location
                            </label>
                            <p class="text-gray-900">{{ $vendor->location }}</p>
                        </div>

                        <!-- Partnership Type -->
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-handshake text-red-600 mr-2"></i> Partnership Type
                            </label>
                            <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-800">
                                {{ $vendor->getPartnershipTypeLabel() }}
                            </span>
                        </div>
                    </div>

                    <!-- Other Details (if provided) -->
                    @if($vendor->other_details)
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-note text-red-600 mr-2"></i> Additional Details
                            </label>
                            <p class="text-gray-900 bg-gray-50 p-4 rounded-lg">{{ $vendor->other_details }}</p>
                        </div>
                    @endif

                    <!-- Submitted Date -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-calendar text-red-600 mr-2"></i> Submitted On
                        </label>
                        <p class="text-gray-900">{{ $vendor->created_at->format('M d, Y \a\t h:i A') }}</p>
                    </div>
                </div>
            </div>

            <!-- Status Update Form -->
            <div class="bg-white rounded-lg shadow">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-900">Update Status & Notes</h2>
                </div>
                <div class="p-6">
                    <form method="POST" action="{{ route('admin.vendors.update-status', $vendor) }}" class="space-y-5">
                        @csrf
                        @method('PATCH')

                        <!-- Status Select -->
                        <div>
                            <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                                Status
                            </label>
                            <select 
                                name="status" 
                                id="status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500"
                                required>
                                <option value="new" {{ $vendor->status === 'new' ? 'selected' : '' }}>New</option>
                                <option value="contacted" {{ $vendor->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                <option value="in_progress" {{ $vendor->status === 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="approved" {{ $vendor->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $vendor->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>

                        <!-- Admin Notes -->
                        <div>
                            <label for="admin_notes" class="block text-sm font-semibold text-gray-700 mb-2">
                                Admin Notes
                            </label>
                            <textarea 
                                name="admin_notes" 
                                id="admin_notes"
                                rows="4"
                                placeholder="Add internal notes about this vendor inquiry..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">{{ $vendor->admin_notes }}</textarea>
                            <p class="text-xs text-gray-600 mt-2">These notes are internal and not visible to the vendor.</p>
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit" 
                            class="w-full bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition-colors font-semibold">
                            <i class="fas fa-save mr-2"></i> Save Changes
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Status Badge -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4">Current Status</h3>
                <div class="flex items-center space-x-3">
                    @if($vendor->status === 'new')
                        <div class="w-4 h-4 rounded-full bg-yellow-500"></div>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-800">
                            {{ $vendor->getStatusLabel() }}
                        </span>
                    @elseif($vendor->status === 'contacted')
                        <div class="w-4 h-4 rounded-full bg-purple-500"></div>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-purple-100 text-purple-800">
                            {{ $vendor->getStatusLabel() }}
                        </span>
                    @elseif($vendor->status === 'in_progress')
                        <div class="w-4 h-4 rounded-full bg-orange-500"></div>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-orange-100 text-orange-800">
                            {{ $vendor->getStatusLabel() }}
                        </span>
                    @elseif($vendor->status === 'approved')
                        <div class="w-4 h-4 rounded-full bg-green-500"></div>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-800">
                            {{ $vendor->getStatusLabel() }}
                        </span>
                    @else
                        <div class="w-4 h-4 rounded-full bg-red-500"></div>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-800">
                            {{ $vendor->getStatusLabel() }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Timeline -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4">Timeline</h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 rounded-full bg-red-600 mt-2 flex-shrink-0"></div>
                        <div>
                            <p class="text-sm font-semibold text-gray-900">Inquiry Submitted</p>
                            <p class="text-xs text-gray-600">{{ $vendor->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                    @if($vendor->updated_at && $vendor->updated_at->ne($vendor->created_at))
                        <div class="flex items-start space-x-3">
                            <div class="w-2 h-2 rounded-full bg-gray-400 mt-2 flex-shrink-0"></div>
                            <div>
                                <p class="text-sm font-semibold text-gray-900">Last Updated</p>
                                <p class="text-xs text-gray-600">{{ $vendor->updated_at->format('M d, Y') }}</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-sm font-semibold text-gray-700 uppercase tracking-wider mb-4">Actions</h3>
                <div class="space-y-2">
                    <a href="mailto:{{ $vendor->email }}" class="w-full block text-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm font-semibold">
                        <i class="fas fa-envelope mr-2"></i> Send Email
                    </a>
                    <a href="tel:{{ $vendor->phone }}" class="w-full block text-center bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors text-sm font-semibold">
                        <i class="fas fa-phone mr-2"></i> Call
                    </a>
                    <form method="POST" action="{{ route('admin.vendors.destroy', $vendor) }}" onsubmit="return confirm('Are you sure you want to delete this inquiry?');" class="w-full">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full block bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors text-sm font-semibold">
                            <i class="fas fa-trash mr-2"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
