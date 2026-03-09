<?php

namespace App\Services;

use App\Models\Report;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\App;

class ExportReportService
{
    public function makePdf(Report $report): PDF
    {
        /** @var PDF $pdf */
        $pdf = App::make('dompdf.wrapper');

        $pdf->loadView('admin.reports.pdf', [
            'report' => $report,
        ]);

        $pdf->setPaper('a4');

        return $pdf;
    }
}
