<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
</head>

<body style="margin:0;padding:40px;background:#f5f5f5;font-family:Arial">

    <table width="700" align="center" cellpadding="0" cellspacing="0"
        style="background:white;border-radius:10px;overflow:hidden">

        <tr>
            <td style="background:#2563eb;color:white;padding:25px;text-align:center">

                <h1 style="margin:0">
                    📢 Laporin.com
                </h1>

                <p style="margin-top:10px">
                    Sistem Pengaduan Masyarakat
                </p>

            </td>
        </tr>

        <tr>
            <td style="padding:35px">

                @yield('content')

            </td>
        </tr>

        <tr>

            <td style="background:#f3f4f6;padding:20px;text-align:center;font-size:13px;color:#666">

                Email ini dikirim otomatis oleh sistem.

                <br>

                © {{ date('Y') }} Laporin.com

            </td>

        </tr>

    </table>

</body>

</html>