<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\ReportAttachment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        if (! $request->user()) {
            return redirect()->route('login');
        }

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:150'],
            'category' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
            'location' => ['nullable', 'string', 'max:255'],
            'priority' => ['nullable', 'in:low,normal,high'],
            'attachment' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:5120'],
            'attachments' => ['nullable', 'array', 'max:5'],
            'attachments.*' => ['image', 'mimes:jpg,jpeg,png', 'max:5120'],
        ]);

        $paths = [];

        if ($request->hasFile('attachment')) {
            $paths[] = $request->file('attachment')->storePublicly('reports', 'public');
        }

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments', []) as $file) {
                $paths[] = $file->storePublicly('reports', 'public');
            }
        }

        $report = Report::create([
            'user_id' => $request->user()->id,
            'title' => $validated['title'],
            'category' => $validated['category'],
            'description' => $validated['description'],
            'location' => $validated['location'] ?? null,
            'priority' => $validated['priority'] ?? null,
            'attachment' => $paths[0] ?? null,
            'status' => 'pending',
            'waktu_pelaporan' => now(),
        ]);

        foreach ($paths as $path) {
            ReportAttachment::create([
                'report_id' => $report->id,
                'path' => $path,
            ]);
        }

        return redirect()
            ->route('home')
            ->with('status', 'Laporan berhasil dikirim.');
    }
}
