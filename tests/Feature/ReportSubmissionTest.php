<?php

use App\Models\Report;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('authenticated user can submit a report with attachments', function () {
    Storage::fake('public');

    $user = User::factory()->create(['role' => 'user']);

    $response = $this->actingAs($user)->post(route('report.store'), [
        'title' => 'Jalan rusak',
        'category' => 'Infrastruktur',
        'description' => 'Banyak lubang dan membahayakan pengendara.',
        'location' => 'Jl. Merdeka',
        'priority' => 'high',
        'attachments' => [
            UploadedFile::fake()->image('a.jpg'),
            UploadedFile::fake()->image('b.png'),
        ],
    ]);

    $response->assertRedirect(route('home'));

    $this->assertDatabaseHas('reports', [
        'user_id' => $user->id,
        'title' => 'Jalan rusak',
        'category' => 'Infrastruktur',
        'status' => 'pending',
    ]);

    $report = Report::query()->where('user_id', $user->id)->firstOrFail();

    expect($report->attachments()->count())->toBe(2);

    foreach ($report->attachments as $att) {
        Storage::disk('public')->assertExists($att->path);
    }
});

test('guest cannot submit a report', function () {
    $response = $this->post(route('report.store'), [
        'title' => 'Tes',
        'category' => 'Lainnya',
        'description' => 'Tes',
    ]);

    $response->assertRedirect(route('login'));
});
