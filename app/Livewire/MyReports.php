<?php

namespace App\Livewire;

use App\Models\Report;
use Livewire\Component;
use Livewire\WithPagination;

class MyReports extends Component
{
    use WithPagination;

    public function render()
    {
        $reports = Report::query()
            ->where('user_id', auth()->id())
            ->latest('waktu_pelaporan')
            ->paginate(10);

        return view('livewire.my-reports', [
            'reports' => $reports,
        ])->layout('components.layouts.public', [
            'title' => 'Laporan Saya',
        ]);
    }
}
