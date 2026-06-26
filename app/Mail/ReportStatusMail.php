<?php

namespace App\Mail;

use App\Models\Report;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReportStatusMail extends Mailable
{
    use Queueable, SerializesModels;

    public Report $report;
    public string $oldStatus;

    public function __construct(Report $report, string $oldStatus)
    {
        $this->report = $report;
        $this->oldStatus = $oldStatus;
    }

    public function build()
    {
        return $this
            ->subject('Perubahan Status Laporan #' . $this->report->id)
            ->view('emails.report-status');
    }
}
