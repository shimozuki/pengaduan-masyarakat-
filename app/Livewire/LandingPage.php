<?php

namespace App\Livewire;

use App\Models\Report;
use Livewire\Component;

class LandingPage extends Component
{
    public function render()
    {
        $recentReports = Report::query()
            ->latest('waktu_pelaporan')
            ->take(3)
            ->get();

        return view('livewire.landing-page', [
            'recentReports' => $recentReports,
        ])
            ->layout('components.layouts.public', [
                'title' => 'Laporin',
            ]);
    }
}
