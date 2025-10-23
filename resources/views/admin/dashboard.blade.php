@extends('layouts.app')
<title>Dashboard</title>

@section('content')
<div class="p-4 sm:p-6 bg-gray-50 min-h-screen space-y-6">
    
    <div>
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">
            Welcome back, {{ Auth::user()->name }}
        </h1>
        <p class="text-gray-600 mt-1 sm:mt-2 text-sm sm:text-base">
            Here's an overview of the library's current status.
        </p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 sm:gap-6">
        <div class="bg-white p-4 sm:p-6 rounded-2xl shadow hover:shadow-lg transition">
            <h2 class="text-gray-500 text-xs sm:text-sm">Total Books</h2>
            <p class="text-2xl sm:text-3xl font-bold text-indigo-600 mt-1 sm:mt-2">
                {{ $stats['books'] }}
            </p>
        </div>
        <div class="bg-white p-4 sm:p-6 rounded-2xl shadow hover:shadow-lg transition">
            <h2 class="text-gray-500 text-xs sm:text-sm">Total Members</h2>
            <p class="text-2xl sm:text-3xl font-bold text-green-600 mt-1 sm:mt-2">
                {{ $stats['members'] }}
            </p>
        </div>
        <div class="bg-white p-4 sm:p-6 rounded-2xl shadow hover:shadow-lg transition">
            <h2 class="text-gray-500 text-xs sm:text-sm">Books Borrowed</h2>
            <p class="text-2xl sm:text-3xl font-bold text-yellow-600 mt-1 sm:mt-2">
                {{ $stats['borrowed'] }}
            </p>
        </div>
        <div class="bg-white p-4 sm:p-6 rounded-2xl shadow hover:shadow-lg transition">
            <h2 class="text-gray-500 text-xs sm:text-sm">Books Returned</h2>
            <p class="text-2xl sm:text-3xl font-bold text-blue-600 mt-1 sm:mt-2">
                {{ $stats['returned'] }}
            </p>
        </div>
    </div>

    @php
        $cards = [
            [
                'title' => 'Categories',
                'bg' => 'bg-white p-4 sm:p-6 rounded-2xl shadow hover:shadow-lg transition',
                'text' => 'text-emerald-700',
                'icon' => '📂',
                'desc' => 'Manage all book categories in the library.',
                'route' => route('admin.categories.index')
            ],
            [
                'title' => 'Books',
                'bg' => 'bg-white p-4 sm:p-6 rounded-2xl shadow hover:shadow-lg transition',
                'text' => 'text-emerald-700',
                'icon' => '📚',
                'desc' => 'View and manage all books in the library.',
                'route' => route('admin.books')
            ],
            [
                'title' => 'Members',
                'bg' => 'bg-white p-4 sm:p-6 rounded-2xl shadow hover:shadow-lg transition',
                'text' => 'text-emerald-700',
                'icon' => '👥',
                'desc' => 'Manage library members and their information.',
                'route' => route('admin.members.index')
            ],
            [
                'title' => 'Borrow Records',
                'bg' => 'bg-white p-4 sm:p-6 rounded-2xl shadow hover:shadow-lg transition',
                'text' => 'text-emerald-700',
                'icon' => '📝',
                'desc' => 'View all borrow and return activities.',
                'route' => route('admin.loans.index')
            ],
            [
                'title' => 'Requested Books',
                'bg' => 'bg-white p-4 sm:p-6 rounded-2xl shadow hover:shadow-lg transition',
                'text' => 'text-emerald-700',
                'icon' => '📩',
                'desc' => 'View and manage all requested books.',
                'route' => route('admin.request-book.index')
            ],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-4 sm:gap-6">
        @foreach ($cards as $card)
            <div class="{{ $card['bg'] }} text-white p-4 sm:p-6 rounded-2xl shadow hover:shadow-xl transition flex flex-col justify-between">
                <div class="flex flex-wrap items-center mb-2 sm:mb-4">
                    <div class="text-3xl sm:text-4xl mr-2">{{ $card['icon'] }}</div>
                    <h3 class="text-sm sm:text-lg font-bold text-black/85">{{ $card['title'] }}</h3>
                </div>
                <p class="text-xs sm:text-sm text-black/50 mb-2 sm:mb-4">{{ $card['desc'] }}</p>
                <a href="{{ $card['route'] }}" 
                   class="block sm:inline-block w-full sm:w-auto text-center bg-black/5 {{ $card['text'] }} px-3 py-2 rounded-lg font-semibold text-xs sm:text-sm hover:bg-emerald-100 transition">
                   Manage
                </a>
            </div>
        @endforeach
    </div>

    <div class="bg-white p-4 sm:p-6 rounded-2xl shadow overflow-x-auto">
        <h2 class="text-lg sm:text-xl font-bold text-gray-800 mb-2 sm:mb-4">
            Recent Loan Activities
        </h2>
        <table class="w-full table-auto text-left border-collapse text-xs sm:text-sm">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th class="p-2 sm:p-3">Member</th>
                    <th class="p-2 sm:p-3">Books</th>
                    <th class="p-2 sm:p-3">Loan Date</th>
                    <th class="p-2 sm:p-3">Return Date</th>
                    <th class="p-2 sm:p-3">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recentActivities as $activity)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="p-2 sm:p-3 font-medium">
                            {{ $activity->member->login->name ?? '-' }}
                        </td>
                        <td class="p-2 sm:p-3">
                            <div class="text-gray-700 text-xs sm:text-sm">
                                {{ $activity->loanDetails->book->title ?? '-' }}
                            </div>
                        </td>
                        <td class="p-2 sm:p-3 text-gray-700">
                            {{ $activity->loan_date->format('d M Y') }}
                        </td>
                        <td class="p-2 sm:p-3 text-gray-700">
                            {{ $activity->return_date ? $activity->return_date->format('d M Y') : '-' }}
                        </td>
                        <td class="p-2 sm:p-3">
                            @php $status = $activity->status ?? 'unknown'; @endphp
                            <span class="px-2 py-1 text-xs sm:text-sm rounded-xl 
                                @switch($status)
                                    @case('borrowed') bg-yellow-100 text-yellow-700 @break
                                    @case('returned') bg-green-100 text-green-700 @break
                                    @default bg-red-100 text-red-700
                                @endswitch">
                                {{ ucfirst($activity->status) }}
                            </span>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-3 sm:p-4 text-center text-gray-500">
                            No recent activities found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    

</div>
@endsection
