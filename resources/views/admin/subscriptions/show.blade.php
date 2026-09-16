@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="mb-6">
        <a href="{{ route('admin.subscriptions.index') }}" class="text-red-600 hover:text-red-800 mb-4 inline-flex items-center">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to Subscriptions
        </a>
    </div>

    <div class="bg-white border border-gray-200 rounded-lg overflow-hidden">
        <!-- Subscription Header -->
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-start">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">{{ $subscription->email }}</h1>
                    <p class="text-gray-600 mt-1">Phone: {{ $subscription->phone }}</p>
                </div>
                <div class="flex space-x-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $subscription->status_badge_class }}">
                        {{ ucfirst($subscription->status) }}
                    </span>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 p-6">
            <!-- Subscription Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Information -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Subscription Details</h3>
                    <div class="space-y-3">
                        <div>
                            <label class="text-sm font-medium text-gray-600">Email</label>
                            <p class="text-gray-900">{{ $subscription->email }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Phone</label>
                            <p class="text-gray-900">{{ $subscription->phone }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Status</label>
                            <p class="text-gray-900">{{ ucfirst($subscription->status) }}</p>
                        </div>
                        <div>
                            <label class="text-sm font-medium text-gray-600">Date Subscribed</label>
                            <p class="text-gray-900">{{ $subscription->created_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Admin Notes -->
                <div class="mt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Admin Notes</h3>
                    <form action="{{ route('admin.subscriptions.update-notes', $subscription) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <textarea name="admin_notes" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500" placeholder="Add notes about this subscription...">{{ $subscription->admin_notes }}</textarea>
                        <button type="submit" class="mt-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                            Save Notes
                        </button>
                    </form>
                </div>
            </div>

            <!-- Sidebar Actions -->
            <div class="space-y-6">
                <!-- Status Update -->
                <div class="bg-gray-50 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Actions</h3>
                    <div class="space-y-3">
                        <!-- Status Update -->
                        <form action="{{ route('admin.subscriptions.update-status', $subscription) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500">
                                    <option value="unread" {{ $subscription->status === 'unread' ? 'selected' : '' }}>Unread</option>
                                    <option value="read" {{ $subscription->status === 'read' ? 'selected' : '' }}>Read</option>
                                    <option value="contacted" {{ $subscription->status === 'contacted' ? 'selected' : '' }}>Contacted</option>
                                </select>
                                <button type="submit" class="mt-2 w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors">
                                    Update Status
                                </button>
                            </div>
                        </form>

                        <!-- Delete Subscription -->
                        <form action="{{ route('admin.subscriptions.destroy', $subscription) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition-colors" onclick="return confirm('Are you sure you want to delete this subscription?')">
                                Delete Subscription
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
