<?php

use App\Models\Report;
use App\Models\User;

test('non-admin cannot access admin routes', function () {
    $user = User::factory()->create(['role' => 'user']);

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

test('admin can export report to pdf', function () {
    if (! class_exists(\Barryvdh\DomPDF\ServiceProvider::class)) {
        $this->markTestSkipped('Dompdf is not installed.');
    }

    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create(['role' => 'user']);

    $report = Report::query()->create([
        'user_id' => $user->id,
        'title' => 'Lampu jalan mati',
        'category' => 'Infrastruktur',
        'description' => 'Mohon diperbaiki.',
        'status' => 'pending',
        'waktu_pelaporan' => now(),
    ]);

    $response = $this->actingAs($admin)->post(route('admin.reports.export', $report));

    $response->assertOk();
    $response->assertHeader('content-type', 'application/pdf');
});
