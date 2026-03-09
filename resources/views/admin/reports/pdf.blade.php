<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan #{{ $report->id }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #111827; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #e5e7eb; padding-bottom: 10px; margin-bottom: 14px; }
        .title { font-size: 18px; font-weight: 700; }
        .meta { color: #374151; font-size: 12px; }
        .box { border: 1px solid #e5e7eb; padding: 10px; border-radius: 6px; margin-bottom: 12px; }
        .label { color: #6b7280; font-size: 11px; }
        .value { font-size: 12px; }
        .grid { width: 100%; }
        .grid td { vertical-align: top; padding: 6px; }
        .badge { display: inline-block; border: 1px solid #e5e7eb; padding: 2px 8px; border-radius: 999px; font-size: 11px; }
        img { max-width: 100%; height: auto; }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <div class="title">Laporin</div>
            <div class="meta">Export Laporan Pengaduan Publik</div>
        </div>
        <div class="meta">
            <div><strong>ID:</strong> #{{ $report->id }}</div>
            <div><strong>Tanggal:</strong> {{ $report->waktu_pelaporan?->format('d M Y H:i') }}</div>
        </div>
    </div>

    <div class="box">
        <table class="grid">
            <tr>
                <td style="width: 60%">
                    <div class="label">Judul</div>
                    <div class="value"><strong>{{ $report->title }}</strong></div>
                </td>
                <td style="width: 40%">
                    <div class="label">Status</div>
                    <div class="value"><span class="badge">{{ $report->status }}</span></div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">Kategori</div>
                    <div class="value">{{ $report->category }}</div>
                </td>
                <td>
                    <div class="label">Prioritas</div>
                    <div class="value">{{ $report->priority ?? '-' }}</div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="label">Pelapor</div>
                    <div class="value">{{ $report->user?->name }} ({{ $report->user?->email }})</div>
                </td>
                <td>
                    <div class="label">Lokasi</div>
                    <div class="value">{{ $report->location ?? '-' }}</div>
                </td>
            </tr>
        </table>
    </div>

    <div class="box">
        <div class="label">Deskripsi</div>
        <div class="value" style="white-space: pre-line; margin-top: 6px;">{{ $report->description }}</div>
    </div>

    @if ($report->attachments && $report->attachments->count())
        <div class="box">
            <div class="label">Lampiran</div>
            <div style="margin-top: 10px;">
                @foreach ($report->attachments as $attachment)
                    <div style="margin-bottom: 12px;">
                        <img src="{{ public_path('storage/'.$attachment->path) }}" alt="Lampiran" />
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</body>
</html>
