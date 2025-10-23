<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Loan;
use App\Models\Member;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'books' => Book::count(),
            'members' => Member::count(),
            'borrowed' => Loan::where('status', 'borrowed')->count(),
            'returned' => Loan::where('status', 'returned')->count(),
        ];

        $recentActivities = Loan::with('loanDetails.book', 'member')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentActivities'));
    }
}
