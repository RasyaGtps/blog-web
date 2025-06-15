<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketentuan Layanan - ByRead</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    @vite('resources/css/app.css')
</head>
<body class="bg-[#f8f6f2]">
    <!-- Navigation -->
    <div class="bg-white w-full border-b border-gray-200">
        @include('layouts.navigation')
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto px-4 py-12">
        <h1 class="text-4xl font-bold mb-8">Ketentuan Layanan</h1>
        
        <div class="bg-white rounded-xl shadow-sm p-8 space-y-8">
            <section>
                <h2 class="text-2xl font-bold mb-4">Penerimaan Ketentuan</h2>
                <p class="text-gray-600 mb-4">
                    Dengan mengakses dan menggunakan platform ByRead, Anda menyetujui untuk terikat oleh ketentuan layanan ini. Jika Anda tidak setuju dengan ketentuan ini, mohon untuk tidak menggunakan layanan kami.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold mb-4">Akun Pengguna</h2>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>Anda bertanggung jawab atas keamanan akun Anda</li>
                    <li>Informasi akun harus akurat dan terkini</li>
                    <li>Satu email hanya untuk satu akun</li>
                    <li>Dilarang membagikan atau mentransfer akun</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold mb-4">Konten</h2>
                <div class="space-y-4">
                    <p class="text-gray-600">
                        Pengguna bertanggung jawab atas konten yang mereka posting. Konten yang dilarang meliputi:
                    </p>
                    <ul class="list-disc list-inside space-y-2 text-gray-600">
                        <li>Konten yang melanggar hak cipta</li>
                        <li>Konten yang mengandung kebencian atau diskriminasi</li>
                        <li>Informasi palsu atau menyesatkan</li>
                        <li>Konten dewasa atau tidak pantas</li>
                        <li>Spam atau konten promosi yang tidak sah</li>
                    </ul>
                </div>
            </section>

            <section>
                <h2 class="text-2xl font-bold mb-4">Keanggotaan Premium</h2>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>Pembayaran diproses sesuai paket yang dipilih</li>
                    <li>Pembatalan dapat dilakukan sebelum periode berakhir</li>
                    <li>Tidak ada pengembalian dana untuk periode berjalan</li>
                    <li>Harga dapat berubah dengan pemberitahuan</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold mb-4">Hak Kekayaan Intelektual</h2>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>Pengguna mempertahankan hak atas konten mereka</li>
                    <li>ByRead memiliki lisensi untuk menampilkan konten</li>
                    <li>Logo dan merek ByRead dilindungi hak cipta</li>
                    <li>Dilarang menggunakan merek ByRead tanpa izin</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold mb-4">Pembatasan Tanggung Jawab</h2>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>Layanan disediakan "sebagaimana adanya"</li>
                    <li>ByRead tidak bertanggung jawab atas kerugian tidak langsung</li>
                    <li>Pengguna menggunakan layanan atas risiko sendiri</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold mb-4">Perubahan Ketentuan</h2>
                <p class="text-gray-600">
                    ByRead berhak mengubah ketentuan layanan ini sewaktu-waktu. Perubahan akan diumumkan melalui platform dan berlaku sejak tanggal publikasi.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold mb-4">Kontak</h2>
                <p class="text-gray-600">
                    Untuk pertanyaan tentang ketentuan layanan ini, silakan hubungi:
                    <a href="mailto:legal@byread.com" class="text-blue-600 hover:underline">legal@byread.com</a>
                </p>
            </section>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')
</body>
</html> 