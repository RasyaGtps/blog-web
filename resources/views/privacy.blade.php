<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi - ByRead</title>
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
        <h1 class="text-4xl font-bold mb-8">Kebijakan Privasi</h1>
        
        <div class="bg-white rounded-xl shadow-sm p-8 space-y-8">
            <section>
                <h2 class="text-2xl font-bold mb-4">Pendahuluan</h2>
                <p class="text-gray-600 mb-4">
                    ByRead berkomitmen untuk melindungi privasi pengguna kami. Kebijakan privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi pribadi Anda.
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold mb-4">Informasi yang Kami Kumpulkan</h2>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>Informasi profil (nama, email, foto profil)</li>
                    <li>Informasi aktivitas (artikel yang dibaca, komentar, interaksi)</li>
                    <li>Informasi teknis (IP address, browser, device info)</li>
                    <li>Informasi pembayaran (untuk pengguna premium)</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold mb-4">Penggunaan Informasi</h2>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>Menyediakan dan meningkatkan layanan kami</li>
                    <li>Personalisasi konten dan rekomendasi</li>
                    <li>Komunikasi dengan pengguna</li>
                    <li>Keamanan dan pencegahan penipuan</li>
                    <li>Analisis dan pengembangan platform</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold mb-4">Keamanan Data</h2>
                <p class="text-gray-600 mb-4">
                    Kami mengimplementasikan langkah-langkah keamanan yang ketat untuk melindungi data Anda, termasuk:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>Enkripsi data end-to-end</li>
                    <li>Akses terbatas ke data pribadi</li>
                    <li>Pemantauan keamanan secara regular</li>
                    <li>Backup data berkala</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold mb-4">Hak Pengguna</h2>
                <p class="text-gray-600 mb-4">
                    Anda memiliki hak untuk:
                </p>
                <ul class="list-disc list-inside space-y-2 text-gray-600">
                    <li>Mengakses data pribadi Anda</li>
                    <li>Memperbarui atau mengoreksi data Anda</li>
                    <li>Meminta penghapusan data</li>
                    <li>Menolak penggunaan data untuk tujuan tertentu</li>
                </ul>
            </section>

            <section>
                <h2 class="text-2xl font-bold mb-4">Kontak</h2>
                <p class="text-gray-600">
                    Jika Anda memiliki pertanyaan tentang kebijakan privasi kami, silakan hubungi kami di:
                    <a href="mailto:privacy@byread.com" class="text-blue-600 hover:underline">privacy@byread.com</a>
                </p>
            </section>

            <section>
                <h2 class="text-2xl font-bold mb-4">Pembaruan Kebijakan</h2>
                <p class="text-gray-600">
                    Kami dapat memperbarui kebijakan privasi ini dari waktu ke waktu. Perubahan akan diumumkan melalui platform kami dan, jika signifikan, kami akan memberitahu Anda melalui email.
                </p>
            </section>
        </div>
    </div>

    <!-- Footer -->
    @include('layouts.footer')
</body>
</html> 