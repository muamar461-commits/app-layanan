<?php

namespace Database\Seeders;

use App\Enums\InformationCategory;
use App\Enums\PublishStatus;
use App\Models\DownloadableForm;
use App\Models\Faq;
use App\Models\InformationPage;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Database\Seeder;

class InformationPortalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('email', 'admin@dinsos.blitarkab.go.id')->first()
            ?? User::first();

        if (! $admin) {
            return;
        }

        $dtsenService = ServiceType::where('code', 'DTSEN')->first();
        $pbiService = ServiceType::where('code', 'PBI')->first();
        $rehsosService = ServiceType::where('code', 'REHSOS')->first();
        $bansosService = ServiceType::where('code', 'BANSOS')->first();

        $pages = [
            [
                'title' => 'Layanan Penerbitan Surat Keterangan Terdaftar DTSEN',
                'slug' => 'surat-keterangan-dtsen',
                'category' => InformationCategory::Program,
                'service_type_id' => $dtsenService?->id,
                'description' => 'Layanan penerbitan Surat Keterangan Data Tunggal Sosial Ekonomi Nasional (DTSEN) untuk verifikasi status kepesertaan dan peringkat desil masyarakat Kabupaten Blitar.',
                'requirements' => "1. KTP pemohon/keluarga (asli/fotokopi jelas)\n2. Kartu Keluarga (KK) asli/terbaru\n3. Surat pengantar RT/RW atau Kepala Desa/Kelurahan (jika diperlukan)",
                'procedure' => "1. Pemohon mengajukan permohonan secara online melalui portal SAPA SOSIAL atau melalui kantor desa/kecamatan.\n2. Petugas memverifikasi kelengkapan dokumen dan mengecek basis data DTSEN.\n3. Pejabat berwenang melakukan validasi dan menandatangani surat secara digital.\n4. Pemohon dapat mengunduh surat ber-QR Code atau mengambil cetakan di loket pelayanan.",
                'service_hours' => 'Senin - Kamis: 08.00 - 15.00 WIB, Jumat: 08.00 - 14.30 WIB',
                'location' => 'Loket Pelayanan Terpadu Dinas Sosial Kabupaten Blitar, Jl. Kusuma Bangsa No. 15, Kanigoro',
                'contact' => 'WhatsApp Layanan: 0811-3333-001 | Email: dinsos@blitarkab.go.id',
                'publish_status' => PublishStatus::Published,
                'published_at' => now()->subDays(60),
                'manager_id' => $admin->id,
                'forms' => [
                    [
                        'name' => 'Formulir Permohonan Surat Keterangan DTSEN (F-DTSEN-01)',
                        'file_path' => 'forms/f_dtsen_01.pdf',
                        'version' => '1.0',
                        'is_current' => true,
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'Berapa lama proses penerbitan Surat Keterangan DTSEN?',
                        'answer' => 'Penerbitan surat membutuhkan waktu maksimal 1x24 jam kerja setelah berkas diverifikasi lengkap dan valid oleh petugas.',
                        'sort_order' => 1,
                    ],
                    [
                        'question' => 'Apakah layanan penerbitan surat keterangan ini dipungut biaya?',
                        'answer' => 'Tidak. Seluruh pelayanan administrasi di Dinas Sosial Kabupaten Blitar bersifat GRATIS (bebas pungli).',
                        'sort_order' => 2,
                    ],
                    [
                        'question' => 'Bagaimana jika NIK atau nama saya tidak terdaftar di DTSEN?',
                        'answer' => 'Jika tidak terdaftar, petugas dapat menerbitkan Surat Keterangan Tidak Terdaftar DTSEN atau merekomendasikan pemutakhiran data melalui Musyawarah Desa/Kelurahan (Musdes/Muskel).',
                        'sort_order' => 3,
                    ],
                ],
            ],
            [
                'title' => 'Layanan Reaktivasi Kepesertaan KIS / PBI-JK',
                'slug' => 'reaktivasi-pbi-jk',
                'category' => InformationCategory::Program,
                'service_type_id' => $pbiService?->id,
                'description' => 'Fasilitasi advokasi dan usulan pengaktifan kembali kartu BPJS Kesehatan Penerima Bantuan Iuran Jaminan Kesehatan (PBI-JK) APBN/APBD yang telah non-aktif bagi warga yang membutuhkan penanganan medis segera.',
                'requirements' => "1. Foto KTP asli atau Identitas Kependudukan Digital (IKD)\n2. Kartu Keluarga (KK) yang masih berlaku\n3. Kartu KIS/BPJS Kesehatan yang non-aktif\n4. Surat Keterangan Rawat Inap/Rujukan/Kondisi Medis dari Rumah Sakit atau Puskesmas",
                'procedure' => "1. Warga mendaftar melalui aplikasi SAPA SOSIAL dengan mengunggah dokumen persyaratan.\n2. Verifikator memeriksa status desil dan validitas rekam medis darurat.\n3. Dinas Sosial menerbitkan rekomendasi pengaktifan kembali dan mengirim usulan ke Kementerian Sosial / BPJS Kesehatan.\n4. Pemohon memantau perubahan status secara berkala di portal.",
                'service_hours' => 'Senin - Minggu (Layanan darurat medis 24 jam via kontak siaga)',
                'location' => 'Front Office Linjamsos, Dinsos Kab. Blitar / Loket RSUD Ngudi Waluyo Wlingi',
                'contact' => 'Unit Reaksi Cepat PBI: 0811-3333-002',
                'publish_status' => PublishStatus::Published,
                'published_at' => now()->subDays(45),
                'manager_id' => $admin->id,
                'forms' => [
                    [
                        'name' => 'Formulir Permohonan Pengaktifan Kembali KIS PBI (F-PBI-01)',
                        'file_path' => 'forms/f_pbi_01.pdf',
                        'version' => '1.2',
                        'is_current' => true,
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'Mengapa kartu KIS PBI-JK saya tiba-tiba berstatus tidak aktif?',
                        'answer' => 'Penonaktifan dapat disebabkan oleh pembersihan data berkala dari Kemensos RI berdasarkan pemutakhiran data kependudukan, perubahan desil ekonomi keluarga, atau ketidaksesuaian NIK dengan Dukcapil.',
                        'sort_order' => 1,
                    ],
                    [
                        'question' => 'Berapa lama batas waktu pengajuan reaktivasi setelah kartu non-aktif?',
                        'answer' => 'Reaktivasi dapat diajukan dalam kurun waktu 6 (enam) bulan sejak tanggal dinonaktifkan, terutama bagi peserta yang mengalami kondisi sakit kronis atau darurat medis.',
                        'sort_order' => 2,
                    ],
                ],
            ],
            [
                'title' => 'Penanganan & Rehabilitasi Sosial Pemerlu Pelayanan Kesejahteraan Sosial (PPKS)',
                'slug' => 'rehabilitasi-sosial-ppks',
                'category' => InformationCategory::Rehabilitation,
                'service_type_id' => $rehsosService?->id,
                'description' => 'Layanan terpadu penanganan, penjangkauan (outreach), asesmen komprehensif, dan rujukan panti/rumah sakit bagi penyandang disabilitas terlantar, lansia terlantar, anak berhadapan hukum, serta ODGJ terlantar.',
                'requirements' => "1. KTP/Identitas klien (jika ada)\n2. Kartu Keluarga (jika ada keluarga penjamin)\n3. Surat Laporan Kejadian / Berita Acara dari Satpol PP, Polsek, atau Pemdes setempat\n4. Surat pengantar fasilitas kesehatan (untuk kasus medis/kejiwaan)",
                'procedure' => "1. Laporan diterima tim TRC Dinsos dari masyarakat, desa, atau aparat penegak hukum.\n2. Pekerja Sosial melakukan penjangkauan dan asesmen kebutuhan sosial & psikologis.\n3. Perumusan rencana intervensi: pendampingan keluarga, bantuan darurat, atau rujukan balai/panti.\n4. Monitoring perkembangan pemulihan keberfungsian sosial klien.",
                'service_hours' => 'Layanan 24 Jam Siaga Kasus Terlantar dan Darurat Sosial',
                'location' => 'Bidang Rehabilitasi Sosial, Kantor Dinas Sosial Kabupaten Blitar',
                'contact' => 'Hotline TRC Rehsos: 0811-3333-003',
                'publish_status' => PublishStatus::Published,
                'published_at' => now()->subDays(30),
                'manager_id' => $admin->id,
                'forms' => [
                    [
                        'name' => 'Formulir Laporan Penanganan PPKS Terlantar (F-PPKS-01)',
                        'file_path' => 'forms/f_ppks_01.pdf',
                        'version' => '1.0',
                        'is_current' => true,
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'Apakah keluarga pemohon dipungut biaya perawatan di panti rujukan Dinsos?',
                        'answer' => 'Tidak dipungut biaya bagi PPKS yang memenuhi kriteria terlantar dan telah lolos asesmen sosial tim Pekerja Sosial Dinsos.',
                        'sort_order' => 1,
                    ],
                    [
                        'question' => 'Bagaimana alur rujukan penanganan ODGJ yang mengamuk atau membahayakan?',
                        'answer' => 'Segera hubungi tim terpadu (Kecamatan/Puskesmas/Satpol PP/Dinsos). Klien akan distabilkan di RSUD terlebih dahulu sebelum asesmen rehabilitasi sosial lanjutan.',
                        'sort_order' => 2,
                    ],
                ],
            ],
            [
                'title' => 'Rekomendasi Bantuan Sosial Terencana & Verifikasi Kelayakan',
                'slug' => 'rekomendasi-bansos-terencana',
                'category' => InformationCategory::Program,
                'service_type_id' => $bansosService?->id,
                'description' => 'Permohonan rekomendasi dan survei verifikasi faktual lapangan bagi calon penerima bantuan sosial terencana, perbaikan rumah tidak layak huni (RTLH), serta bantuan modal usaha ekonomi produktif (UEP).',
                'requirements' => "1. KTP dan Kartu Keluarga kepala keluarga\n2. Surat Keterangan Tidak Mampu (SKTM) dari Kelurahan/Desa\n3. Foto kondisi fisik rumah tampak depan, ruang tamu, dapur, dan MCK\n4. Surat pernyataan belum pernah menerima bantuan sejenis",
                'procedure' => "1. Pendaftaran proposal/permohonan secara perorangan atau kelompok.\n2. Verifikasi administratif dan validasi lapangan oleh Tenaga Kesejahteraan Sosial Kecamatan (TKSK).\n3. Verifikasi berjenjang oleh Tim Seleksi Dinas Sosial.\n4. Penerbitan Surat Keputusan / Rekomendasi Bantuan Sosial.",
                'service_hours' => 'Senin - Jumat: 08.00 - 15.00 WIB',
                'location' => 'Bidang Pemberdayaan Sosial & Penanganan Fakir Miskin, Dinsos Kab. Blitar',
                'contact' => 'Telp: (0342) 801234 ext. 104',
                'publish_status' => PublishStatus::Published,
                'published_at' => now()->subDays(20),
                'manager_id' => $admin->id,
                'forms' => [
                    [
                        'name' => 'Formulir Pengajuan Bantuan Sosial Terencana (F-BST-01)',
                        'file_path' => 'forms/f_bst_01.pdf',
                        'version' => '1.0',
                        'is_current' => true,
                    ],
                    [
                        'name' => 'Format Standar SKTM Desa/Kelurahan (F-SKTM-01)',
                        'file_path' => 'forms/f_sktm_01.docx',
                        'version' => '1.0',
                        'is_current' => true,
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'Apakah memiliki SKTM menjamin pasti menerima bantuan sosial?',
                        'answer' => 'SKTM merupakan syarat administratif. Kelayakan penerima akhir ditentukan berdasarkan hasil survei verifikasi faktual lapangan dan kuota anggaran daerah yang tersedia.',
                        'sort_order' => 1,
                    ],
                ],
            ],
            [
                'title' => 'Mekanisme Pengaduan & Aspirasi Layanan Sosial (SAPA SOSIAL)',
                'slug' => 'pengaduan-layanan-sosial',
                'category' => InformationCategory::Complaint,
                'service_type_id' => null,
                'description' => 'Kanal resmi pengaduan publik terkait ketidaktepatan penerima bansos, dugaan pungli, keluhan pelayanan, maupun laporan darurat sosial kemasyarakatan.',
                'requirements' => "1. Identitas pelapor (Nama, Nomor HP aktif, NIK)\n2. Uraian kejadian/keluhan yang jelas dan kronologis\n3. Bukti pendukung seperti foto, video, atau dokumen terkait\n4. Lokasi kejadian (Kecamatan dan Desa/Kelurahan)",
                'procedure' => "1. Buat laporan melalui menu Pengaduan di aplikasi SAPA SOSIAL.\n2. Tim verifikator memvalidasi laporan dalam kurun waktu 1x24 jam kerja.\n3. Laporan didisposisikan ke bidang teknis terkait untuk klarifikasi dan tindak lanjut lapangan.\n4. Pelapor menerima pemberitahuan hasil penanganan secara transparan melalui nomor tiket pengaduan.",
                'service_hours' => 'Online 24 Jam (Diproses setiap hari kerja)',
                'location' => 'Sekretariat Tim Penanganan Pengaduan, Dinsos Kab. Blitar',
                'contact' => 'WhatsApp Pengaduan: 0811-3333-007 | SP4N Lapor: lapor.go.id',
                'publish_status' => PublishStatus::Published,
                'published_at' => now()->subDays(15),
                'manager_id' => $admin->id,
                'forms' => [],
                'faqs' => [
                    [
                        'question' => 'Apakah identitas pelapor dijamin kerahasiaannya?',
                        'answer' => 'Ya, sistem SAPA SOSIAL menjamin kerahasiaan data pelapor dan dilindungi undang-undang perlindungan saksi/pelapor.',
                        'sort_order' => 1,
                    ],
                    [
                        'question' => 'Bagaimana cara memantau progres pengaduan saya?',
                        'answer' => 'Gunakan nomor tiket pengaduan (contoh: ADU-202609-0001) pada fitur Cek Status Pengaduan di halaman depan portal.',
                        'sort_order' => 2,
                    ],
                ],
            ],
            [
                'title' => 'Bantuan Alat Bantu Disabilitas & Pendampingan Lanjut Usia',
                'slug' => 'alat-bantu-disabilitas-lansia',
                'category' => InformationCategory::Disability,
                'service_type_id' => null,
                'description' => 'Penyaluran bantuan alat bantu mobilitas (kursi roda, tongkat adaptif, walker, kruk, alat bantu dengar) dan program permakanan/nutrisi bagi warga disabilitas serta lansia kurang mampu.',
                'requirements' => "1. Fotokopi KTP dan KK pemohon atau keluarga penjamin\n2. Surat Keterangan Disabilitas/Pemeriksaan Medis dari Faskes\n3. Foto kondisi calon penerima manfaat seluruh badan\n4. Surat permohonan yang diketahui oleh Kepala Desa/Lurah",
                'procedure' => "1. Pemohon mengajukan permohonan bantuan secara mandiri atau didaftarkan oleh Operator Desa.\n2. Petugas Rehsos melakukan verifikasi dan penyesuaian ukuran alat bantu (fitting).\n3. Penyerahan alat bantu secara langsung atau diantar oleh Pekerja Sosial Dinsos.",
                'service_hours' => 'Senin - Jumat: 08.00 - 15.00 WIB',
                'location' => 'Gudang Logistik & Pelayanan Rehsos, Dinsos Kab. Blitar',
                'contact' => 'Layanan Disabilitas: 0811-3333-005',
                'publish_status' => PublishStatus::Published,
                'published_at' => now()->subDays(10),
                'manager_id' => $admin->id,
                'forms' => [
                    [
                        'name' => 'Formulir Permohonan Alat Bantu Disabilitas & Lansia (F-ABD-01)',
                        'file_path' => 'forms/f_abd_01.pdf',
                        'version' => '1.1',
                        'is_current' => true,
                    ],
                ],
                'faqs' => [
                    [
                        'question' => 'Siapa yang berhak mendapatkan bantuan kursi roda?',
                        'answer' => 'Penyandang disabilitas fisik atau lansia tidak berdaya dari keluarga prasejahtera yang berdomisili di Kabupaten Blitar.',
                        'sort_order' => 1,
                    ],
                ],
            ],
        ];

        foreach ($pages as $pageData) {
            $forms = $pageData['forms'] ?? [];
            $faqs = $pageData['faqs'] ?? [];
            unset($pageData['forms'], $pageData['faqs']);

            $page = InformationPage::updateOrCreate(
                ['slug' => $pageData['slug']],
                $pageData
            );

            foreach ($forms as $formData) {
                DownloadableForm::updateOrCreate(
                    [
                        'information_page_id' => $page->id,
                        'name' => $formData['name'],
                    ],
                    $formData
                );
            }

            foreach ($faqs as $faqData) {
                Faq::updateOrCreate(
                    [
                        'information_page_id' => $page->id,
                        'question' => $faqData['question'],
                    ],
                    $faqData
                );
            }
        }

        // Global FAQs (General FAQ not tied to a specific page)
        $globalFaqs = [
            [
                'question' => 'Apa itu aplikasi SAPA SOSIAL Dinas Sosial Kabupaten Blitar?',
                'answer' => 'SAPA SOSIAL adalah portal Sistem Administrasi & Pelayanan Aspirasi Sosial terpadu untuk mempermudah warga Kabupaten Blitar mengajukan layanan sosial, mengecek kepesertaan DTSEN/PBI-JK, serta menyampaikan laporan pengaduan secara transparan.',
                'sort_order' => 10,
                'is_active' => true,
            ],
            [
                'question' => 'Bagaimana jika warga lansia atau disabilitas tidak memiliki smartphone untuk mendaftar?',
                'answer' => 'Warga dapat mendatangi Kantor Desa/Kelurahan setempat. Operator Desa yang terlatih siap membantu mendaftarkan dan mengurus permohonan melalui akun Operator Desa.',
                'sort_order' => 11,
                'is_active' => true,
            ],
            [
                'question' => 'Apakah ada batasan jam untuk mengakses portal informasi SAPA SOSIAL?',
                'answer' => 'Portal informasi publik dapat diakses online 24 jam sehari, 7 hari seminggu dari komputer maupun telepon pintar.',
                'sort_order' => 12,
                'is_active' => true,
            ],
        ];

        foreach ($globalFaqs as $gfaq) {
            Faq::updateOrCreate(
                [
                    'information_page_id' => null,
                    'question' => $gfaq['question'],
                ],
                $gfaq
            );
        }
    }
}
