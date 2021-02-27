<?php

namespace App\Http\Controllers\admin\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\studentExport;
use App\Models\students;

class ReportController extends Controller
{
    public function index()
    {
        $orders = new students();

        // filter by date
        $date_from = request('date_from');
        $date_to = request('date_to');
        if ($date_from) {
            $orders = $orders->where('created_at', '>=', date($date_from));
        } else if ($date_to) {
            $orders = $orders->where('created_at', '<', date($date_to));
        }

        $orders = $orders->paginate(20);
        return view('admin.reports', [
            'orders' => $orders
        ]);
    }

    public function orderReports()
    {
        $type = request('type');
        // dd(request()->all());
        return Excel::download(new studentExport, 'order.' . $type);
    }
}
