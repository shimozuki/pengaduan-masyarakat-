<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use App\Services\ExportReportService;
use Symfony\Component\HttpFoundation\Response;

class ReportExportController extends Controller
{
    public function __invoke(Report $report, ExportReportService $exporter): Response
    {
        $report->load(['user', 'attachments']);

        $pdf = $exporter->makePdf($report);

        return $pdf->download('laporan_'.$report->id.'.pdf');
    }
}
