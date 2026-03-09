<?php

namespace App\Livewire;

use App\Models\Report;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $total = Report::query()->count();
        $pending = Report::query()->where('status', 'pending')->count();
        $inProgress = Report::query()->where('status', 'in_progress')->count();
        $resolved = Report::query()->where('status', 'resolved')->count();

        $recentReports = Report::query()
            ->with('user')
            ->latest('waktu_pelaporan')
            ->limit(10)
            ->get();

        return view('livewire.admin-dashboard', [
            'total' => $total,
            'pending' => $pending,
            'inProgress' => $inProgress,
            'resolved' => $resolved,
            'recentReports' => $recentReports,
        ])->layout('components.layouts.app', [
            'title' => 'Admin Dashboard',
        ]);
    }
}
