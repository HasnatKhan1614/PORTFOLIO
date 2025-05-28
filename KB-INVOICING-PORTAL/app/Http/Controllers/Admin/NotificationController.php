<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Notification;


class NotificationController extends Controller
{
        public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->of(Notification::all())
                ->addColumn('user_name', function ($row) {
                    // Add user name column
                    return $row->user ? $row->user->name : 'N/A';
                })
                ->make(true);
        }

        return view('admin.notifications.index');
    }
}
