@extends('layouts.app')
<title>Book Details</title>

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-3">
        <h1 class="text-xl sm:text-2xl font-bold text-emerald-700">Book Details</h1>
        <a href="{{ route('admin.books') }}" 
           class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg font-semibold shadow text-sm sm:text-base">
            Back to List
        </a>
    </div>

    <div class="bg-emerald-50 shadow-lg rounded-xl p-4 sm:p-6 border border-emerald-200">
        <div class="flex flex-col md:flex-row md:gap-6">
            @if($book->image)
                <div class="flex justify-center items-center mb-4 md:mb-0">
                    <img src="{{ asset('storage/books/' . $book->image) }}" 
                         alt="{{ $book->title }}" 
                         class="rounded-lg object-cover max-h-50 md:max-h-64 w-full border border-emerald-200">
                </div>
            @endif

            <div class="flex-1 space-y-3 sm:space-y-4 text-sm sm:text-base">
                <div class="flex flex-wrap">
                    <span class="font-semibold text-emerald-700 w-32">Title:</span>
                    <span class="text-gray-900">{{ $book->title }}</span>
                </div>
                <div class="flex flex-wrap">
                    <span class="font-semibold text-emerald-700 w-32">Author:</span>
                    <span class="text-gray-900">{{ $book->author }}</span>
                </div>
                <div class="flex flex-wrap">
                    <span class="font-semibold text-emerald-700 w-32">Publisher:</span>
                    <span class="text-gray-900">{{ $book->publisher ?? '-' }}</span>
                </div>
                <div class="flex flex-wrap">
                    <span class="font-semibold text-emerald-700 w-32">Year:</span>
                    <span class="text-gray-900">{{ $book->year ?? '-' }}</span>
                </div>
                <div class="flex flex-wrap">
                    <span class="font-semibold text-emerald-700 w-32">Stock:</span>
                    <span class="text-gray-900">{{ $book->stock ?? '-' }}</span>
                </div>
                <div class="flex flex-wrap">
                    <span class="font-semibold text-emerald-700 w-32">Category:</span>
                    <span class="text-gray-900">{{ $book->category->name ?? '-' }}</span>
                </div>
                <div class="flex flex-col sm:flex-row sm:gap-2">
                    <span class="font-semibold text-emerald-700 w-32 flex-shrink-0">Description:</span>
                    <p class="text-gray-900">{{ $book->description ?? '-' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection