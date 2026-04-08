<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        $year = now()->year;
        $monthCounts = Contact::selectRaw('MONTH(created_at) AS month, COUNT(*) AS total')
            ->whereYear('created_at', $year)
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')
            ->toArray();

        $contactsByMonth = [];
        for ($m = 1; $m <= 12; $m++) {
            $contactsByMonth[] = $monthCounts[$m] ?? 0;
        }

        $countContacts = Contact::where('is_read', false)->count();
        $contacts = Contact::where('is_read', false)->limit(8)->orderBy('created_at', 'desc')->get();

        return view('admin.dashboard', [
            'contactsByMonth' => $contactsByMonth,
            'countContacts' => $countContacts,
            'contacts' => $contacts,
        ]);
    }
}
