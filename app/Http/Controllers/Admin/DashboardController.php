<?php

namespace App\Http\Controllers\Admin;

use App\Models\Portfolio;
use App\Models\Blog;
use App\Models\Message;
use App\Models\VisitorAnalytic;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalPortfolios = Portfolio::count();
        $totalBlogs = Blog::count();
        $totalMessages = Message::count();
        $unreadMessages = Message::unread()->count();
        $totalVisitors = VisitorAnalytic::sum('visitor_count') ?? 0;

        $visitorData = VisitorAnalytic::orderBy('visit_date', 'desc')
            ->limit(30)
            ->get()
            ->reverse();

        return view('admin.dashboard', compact(
            'totalPortfolios',
            'totalBlogs',
            'totalMessages',
            'unreadMessages',
            'totalVisitors',
            'visitorData'
        ));
    }
}
