@extends('layouts.admin')

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Showrooms</h1>
        <a href="{{ route('admin.showrooms.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
            <i class="fas fa-plus mr-2"></i>Add New Showroom
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Manage Showrooms</h2>
            <p class="text-sm text-gray-600">List of all showrooms.</p>
        </div>

        <div>
            @forelse($showrooms as $showroom)
                <div class="p-6 hover:bg-gray-50 transition-colors">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <!-- Showroom Image -->
                            <div class="w-20 h-16 bg-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                @if($showroom->image)
                                    <img src="{{url('/')}}/{{ Storage::url($showroom->image) }}" alt="{{ $showroom->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Showroom Info -->
                            <div class="flex-1">
                                <div class="flex items-center space-x-3 mb-2">
                                    <h3 class="text-lg font-semibold text-gray-900">{{ $showroom->title }}</h3>
                                    <span class="px-2 py-1 text-xs rounded-full {{ $showroom->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $showroom->is_active ? 'Active' : 'Inactive' }}
                                    </span>
                                    <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                        Order: {{ $showroom->order }}
                                    </span>
                                </div>
                                <p class="text-gray-600 text-sm mb-2">{{ Str::limit($showroom->description, 100) }}</p>
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <span>Color: <span class="font-medium">{{ ucfirst($showroom->background_color) }}</span></span>
                                    @if($showroom->button_text)
                                        <span>Button: <span class="font-medium">{{ $showroom->button_text }}</span></span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('admin.showrooms.edit', $showroom) }}" class="text-blue-600 hover:text-blue-800 p-2">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('admin.showrooms.show', $showroom) }}" class="text-green-600 hover:text-green-800 p-2">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.showrooms.toggle-status', $showroom) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="text-yellow-600 hover:text-yellow-800 p-2">
                                    <i class="fas fa-{{ $showroom->is_active ? 'eye-slash' : 'eye' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.showrooms.destroy', $showroom) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this showroom?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 p-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-gray-500">
                    <i class="fas fa-store text-4xl mb-4"></i>
                    <h3 class="text-lg font-semibold mb-2">No Showrooms Found</h3>
                    <p class="text-sm">Create your first showroom to get started.</p>
                    <a href="{{ route('admin.showrooms.create') }}" class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Create First Showroom
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection