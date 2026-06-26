@extends('emails.layouts.app')

@section('content')

<h2>Status Laporan Diperbarui</h2>

<p>
    Halo <strong>{{ $report->user->name }}</strong>,
</p>

<p>

    Status laporan yang Anda kirim telah diperbarui oleh Administrator.

</p>

<table width="100%" cellpadding="10" style="border-collapse:collapse">

    <tr style="background:#f9fafb">
        <td><strong>ID Laporan</strong></td>
        <td>#{{ $report->id }}</td>
    </tr>

    <tr>
        <td><strong>Judul</strong></td>
        <td>{{ $report->title }}</td>
    </tr>

    <tr style="background:#f9fafb">
        <td><strong>Kategori</strong></td>
        <td>{{ $report->category }}</td>
    </tr>

    <tr>
        <td><strong>Tanggal Dibuat</strong></td>
        <td>{{ $report->created_at->format('d M Y H:i') }}</td>
    </tr>

    <tr style="background:#f9fafb">
        <td><strong>Status Sebelumnya</strong></td>
        <td>{{ ucfirst(str_replace('_',' ',$oldStatus)) }}</td>
    </tr>

    <tr>
        <td><strong>Status Sekarang</strong></td>

        <td>

            @switch($report->status)

            @case('pending')
            🟠 Menunggu
            @break

            @case('in_progress')
            🔵 Sedang Diproses
            @break

            @case('resolved')
            🟢 Selesai
            @break

            @case('rejected')
            🔴 Ditolak
            @break

            @endswitch

        </td>

    </tr>

    @if($report->resolved_at)

    <tr style="background:#f9fafb">
        <td><strong>Selesai Pada</strong></td>
        <td>{{ $report->resolved_at->format('d M Y H:i') }}</td>
    </tr>

    @endif

</table>

<br>

<p>

    Silakan login ke aplikasi untuk melihat perkembangan laporan Anda.

</p>

<p align="center">

    <a href="{{ url('/my-reports') }}"
        style="
background:#2563eb;
padding:14px 30px;
color:white;
text-decoration:none;
border-radius:6px;
display:inline-block;
">

        Lihat Laporan

    </a>

</p>

@endsection