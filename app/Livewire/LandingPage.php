<?php

namespace App\Livewire;

use App\Models\Report;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;

class LandingPage extends Component
{
    use WithFileUploads;

    public string $title = '';
    public string $category = '';
    public string $description = '';
    public $photo;

    protected $rules = [
        'title'       => 'required|min:5|max:150',
        'category'    => 'required',
        'description' => 'required|min:10',
        'photo'       => 'nullable|image|max:5120',
    ];

    protected $messages = [
        'title.required'       => 'Judul laporan wajib diisi.',
        'title.min'            => 'Judul minimal 5 karakter.',
        'category.required'    => 'Kategori wajib dipilih.',
        'description.required' => 'Deskripsi wajib diisi.',
        'description.min'      => 'Deskripsi minimal 10 karakter.',
        'photo.image'          => 'File harus berupa gambar.',
        'photo.max'            => 'Ukuran foto maksimal 5MB.',
    ];

    public function submit()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $this->validate();

        $attachmentPath = null;
        if ($this->photo) {
            $attachmentPath = $this->photo->store('attachments', 'public');
        }

        Report::create([
            'user_id'     => Auth::id(),
            'title'       => $this->title,
            'category'    => $this->category,
            'description' => $this->description,
            'attachment'  => $attachmentPath,
            'status'      => 'pending',
        ]);

        $this->reset(['title', 'category', 'description', 'photo']);
        session()->flash('success', 'Laporan berhasil dikirim!');
    }

    public function render()
    {
        $recentReports = Report::query()
            ->latest('waktu_pelaporan')
            ->take(3)
            ->get();

        return view('livewire.landing-page', [
            'recentReports' => $recentReports,
        ])->layout('components.layouts.public', [
            'title' => 'Laporin',
        ]);
    }
}
