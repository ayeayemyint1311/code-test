<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function export()
    {
        return Excel::download(new ProductsExport, 'products.xlsx');
    }

    public function exportCsv()
    {
        return Excel::download(new ProductsExport, 'products.csv', \Maatwebsite\Excel\Excel::CSV);
    }
}
