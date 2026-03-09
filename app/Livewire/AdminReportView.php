<?php

namespace App\Livewire;

use App\Models\Report;
use Illuminate\Validation\Rule;
use Livewire\Component;

class AdminReportView extends Component
{
    public Report $report;

    public string $status = 'pending';

    public function mount(Report $report): void
    {
        $this->report = $report->load(['user', 'attachments']);
        $this->status = (string) $this->report->status;
    }

    public function updateStatus(): void
    {
        $validated = $this->validate([
            'status' => ['required', Rule::in(['pending', 'in_progress', 'resolved', 'rejected'])],
        ]);

        $resolvedAt = $this->report->resolved_at;

        if ($validated['status'] === 'resolved' && ! $resolvedAt) {
            $resolvedAt = now();
        }

        if ($validated['status'] !== 'resolved') {
            $resolvedAt = null;
        }

        $this->report->update([
            'status' => $validated['status'],
            'resolved_at' => $resolvedAt,
        ]);

        $this->dispatch('status-updated');
    }

    public function render()
    {
        return view('livewire.admin-report-view')
            ->layout('components.layouts.app', [
                'title' => 'Detail Laporan',
            ]);
    }
}
