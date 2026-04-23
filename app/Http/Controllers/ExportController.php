<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function csv()
    {
        $guests = auth()->user()->guests()->with('gifts')->get();
        
        $filename = "guests_export_" . date('Y-m-d') . ".csv";
        
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['Name', 'Phone', 'Relation', 'Gift Type', 'Amount', 'Gift Item', 'Note'];

        $callback = function() use($guests, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($guests as $guest) {
                foreach ($guest->gifts as $gift) {
                    fputcsv($file, [
                        $guest->name,
                        $guest->phone,
                        $guest->relation,
                        $gift->type ?? 'N/A',
                        $gift->amount ?? '0',
                        $gift->item_name ?? '',
                        $gift->note ?? ''
                    ]);
                }
                
                if ($guest->gifts->isEmpty()) {
                    fputcsv($file, [
                        $guest->name,
                        $guest->phone,
                        $guest->relation,
                        'N/A',
                        '0',
                        '',
                        ''
                    ]);
                }
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
