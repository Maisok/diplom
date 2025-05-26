<?php

namespace App\Http\Controllers;

use App\Exports\BookingsExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class BookingExportController extends Controller
{
    public function export(Request $request)
    {
        $status = $request->query('status');

        $validStatuses = ['pending', 'confirmed', 'rejected', 'completed'];
        if ($status && !in_array($status, $validStatuses)) {
            abort(400, "Неверный статус");
        }

        $fileName = $status 
            ? "Бронирования_{$status}_" . now()->format('d.m.Y') . ".xlsx"
            : "Все_бронирования_" . now()->format('d.m.Y') . ".xlsx";

        return Excel::download(new BookingsExport($status), $fileName);
    }
}