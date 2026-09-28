# Prompt Google Stitch — Portal Publik SAPA SOSIAL

Kumpulan prompt untuk membuat UI portal layanan publik **SAPA SOSIAL — Satu Pintu Layanan Sosial Kabupaten Blitar** di https://stitch.withgoogle.com/, berdasarkan `PRD_SAPA_SOSIAL.md`.

## Cara memakai

- Ada **14 halaman**. Setiap prompt **berdiri sendiri** (design system ringkas ikut di dalamnya), jadi bisa ditempel satu per satu ke Stitch tanpa urutan tertentu.
- Baris `Style:` di awal tiap prompt sengaja dibuat sama agar hasil antarhalaman konsisten. Kalau ingin mengganti warna atau font, ubah di semua prompt.
- Buat **satu halaman per prompt**. Kalau Stitch menolak prompt yang terlalu panjang (mis. Halaman 4), pecah per langkah dan tetap sertakan baris `Style:`.
- Teks UI ditetapkan berbahasa Indonesia, sedangkan instruksi prompt memakai bahasa Inggris karena Stitch lebih akurat.
- Hasil Stitch bisa diekspor ke HTML/CSS atau Figma. Karena proyek memakai Livewire + Tailwind, HTML hasil ekspor dipakai sebagai acuan struktur lalu di-porting ke komponen Blade/Livewire.

## Daftar Halaman

1. Beranda
2. Daftar Layanan (Informasi Layanan)
3. Detail Layanan
4. Pengajuan Surat Keterangan DTSEN (4 langkah)
5. Pengajuan Reaktivasi KIS / PBI-JK
6. Pengajuan Layanan Sosial Lainnya
7. Permohonan Rehabilitasi Sosial
8. Pengaduan dan Laporan Sosial
9. Pengajuan Berhasil (nomor tiket)
10. Cek Status Tiket
11. Verifikasi Keaslian Surat
12. Pencarian Informasi & FAQ
13. Masuk & Daftar Akun Masyarakat
14. Akun Saya (Riwayat)

---

## 1. Beranda

```
Style: Government social-services portal "SAPA SOSIAL — Satu Pintu Layanan Sosial Kabupaten Blitar" (Dinas Sosial Kabupaten Blitar, Indonesia). Mobile-first, responsive to desktop. Clean, warm, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, text #111827, muted #6B7280. Heroicons-style line icons, large tap targets. Thin crimson bar at the very top. All UI text in Bahasa Indonesia.

Page: Homepage "Beranda".
Navbar: logo placeholder + "SAPA SOSIAL", links (Beranda, Layanan, Pengaduan, Cek Status, Informasi), button "Masuk".
1. Hero: headline "Satu Pintu Layanan Sosial Kabupaten Blitar", subheadline "Ajukan layanan, sampaikan pengaduan, dan pantau prosesnya dengan nomor tiket — kapan saja, dari mana saja." Buttons "Ajukan Layanan" (primary) and "Cek Status Tiket" (outline). Friendly flat illustration.
2. Quick ticket-check card overlapping hero bottom: input "Nomor Tiket" (placeholder DTSEN-202610-00012), input "4 digit terakhir NIK / No. HP", button "Lacak".
3. "Layanan Prioritas": three large cards with icon, description, and "Ajukan" button: "Surat Keterangan DTSEN" (Untuk syarat SPMB, PIP, KIP Kuliah, bansos, dan layanan kesehatan), "Reaktivasi KIS / PBI-JK" (Aktifkan kembali kepesertaan JKN-KIS yang dinonaktifkan), "Pelayanan Rehabilitasi Sosial" (Lansia terlantar, penyandang disabilitas, ODGJ, anak, dan korban kekerasan).
4. Three secondary shortcut tiles: "Layanan Sosial Lainnya", "Pengaduan Sosial", "Verifikasi Keaslian Surat".
5. "Bagaimana Caranya?" 4-step flow: Pilih Layanan → Isi Formulir & Unggah Berkas → Dapatkan Nomor Tiket → Pantau Sampai Selesai.
6. FAQ accordion with 4 items.
7. Contact strip (alamat, telepon, jam layanan Senin–Jumat) and footer.
```

---

## 2. Daftar Layanan (Informasi Layanan)

```
Style: Government social-services portal "SAPA SOSIAL" of Dinas Sosial Kabupaten Blitar. Mobile-first, responsive. Clean, warm, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, text #111827, muted #6B7280. Heroicons-style line icons, large tap targets. Thin crimson top bar. All UI text in Bahasa Indonesia.

Page: "Informasi Layanan" listing page.
Same navbar as the site (Beranda, Layanan, Pengaduan, Cek Status, Informasi, Masuk).
Page title "Layanan Sosial", short intro sentence.
Large search bar "Cari layanan, persyaratan, atau informasi…" with search button.
Category filter chips: Semua, Bantuan Sosial, Kesehatan, Rehabilitasi Sosial, Disabilitas, Lansia, Pengaduan.
Grid (1 column mobile, 3 desktop) of service cards: icon, service name, one-line description, small tag for category, link "Lihat Detail →". Show 9 cards including Surat Keterangan DTSEN, Reaktivasi KIS/PBI-JK, Pelayanan Rehabilitasi Sosial, Pengaduan Sosial, Rekomendasi Bantuan.
Footer.
```

---

## 3. Detail Layanan

```
Style: Government social-services portal "SAPA SOSIAL" of Dinas Sosial Kabupaten Blitar. Mobile-first, responsive. Clean, warm, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, text #111827, muted #6B7280. Heroicons-style line icons, large tap targets. Thin crimson top bar. All UI text in Bahasa Indonesia.

Page: Service detail "Surat Keterangan DTSEN".
Breadcrumb (Beranda › Layanan › Surat Keterangan DTSEN), title, small label "Diperbarui: 25 September 2026".
Desktop: main content left, sticky side card right; on mobile the side card becomes a sticky bottom bar. Side card: button "Ajukan Sekarang" (primary), button "Unduh Formulir" (outline), estimated waktu layanan, jam layanan.
Sections (tabs or stacked): Deskripsi; Persyaratan (checklist: KTP, Kartu Keluarga); Alur Pelayanan (numbered vertical steps: Pilih tujuan penggunaan, Isi data & unggah berkas, Pemeriksaan berkas, Pengecekan data, Persetujuan pejabat, Surat terbit & diunduh); Lokasi & Kontak (address, phone, small map placeholder).
Downloadable forms list: file name, version badge "Versi Terbaru", download button.
Related FAQ accordion (3 items). Footer.
```

---

## 4. Pengajuan Surat Keterangan DTSEN (4 langkah)

```
Style: Government social-services portal "SAPA SOSIAL" of Dinas Sosial Kabupaten Blitar. Mobile-first (design at 390px width), responsive. Clean, warm, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, inputs 8px radius, text #111827, muted #6B7280. Large tap targets, visible field labels, inline validation in Indonesian. Thin crimson top bar. All UI text in Bahasa Indonesia.

Page: Multi-step form "Pengajuan Surat Keterangan DTSEN". Top stepper with 4 steps: 1 Tujuan, 2 Data Pemohon, 3 Unggah Berkas, 4 Tinjau & Kirim. Design all four steps as separate frames:

Step 1 "Tujuan Penggunaan": selectable radio cards (SPMB, PIP, KIP Kuliah, Bantuan Sosial, Layanan Kesehatan, Lainnya) each with icon and short description; when "Lainnya" is selected show a "Keterangan tujuan" text field. Button "Lanjut".

Step 2 "Data Pemohon": section "Data Pemohon" (Nama Lengkap, NIK 16 digit with helper text, No. KK, No. HP, Alamat, Kecamatan dropdown, Desa/Kelurahan dependent dropdown); section "Orang yang Diterangkan" (Nama, NIK, Hubungan dengan pemohon dropdown). Selected tujuan shown as a read-only chip. Show one field with error "NIK harus terdiri dari 16 digit". Buttons "Kembali" and "Lanjut".

Step 3 "Unggah Berkas": two upload cards (KTP, Kartu Keluarga) with drag-and-drop area, hint "JPG, PNG, atau PDF, maks. 2 MB", one card in uploaded state (thumbnail, file name, remove button). Info note "Dokumen Anda disimpan dengan aman dan hanya dapat dilihat petugas berwenang."

Step 4 "Tinjau & Kirim": read-only summary cards for each section with "Ubah" links, consent checkbox "Saya menyatakan data yang diisi adalah benar", primary button "Kirim Pengajuan".
```

---

## 5. Pengajuan Reaktivasi KIS / PBI-JK

```
Style: Government social-services portal "SAPA SOSIAL" of Dinas Sosial Kabupaten Blitar. Mobile-first (390px), responsive. Clean, warm, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, inputs 8px radius, text #111827, muted #6B7280. Large tap targets, visible labels, inline validation in Indonesian. Thin crimson top bar. All UI text in Bahasa Indonesia.

Page: "Pengajuan Reaktivasi KIS / PBI-JK" (single long form with section cards and a progress stepper: Data Peserta, Alasan, Berkas, Kirim).
Section "Data Peserta": Nama Peserta, NIK, No. KK, No. HP pemohon, No. Kartu BPJS/KIS, Perkiraan Tanggal Nonaktif (date picker), Kecamatan and Desa/Kelurahan dropdowns.
Section "Alasan Reaktivasi": radio cards — Penyakit kronis/katastropik, Kondisi darurat medis, Bayi baru lahir dari ibu peserta PBI, Lainnya. Show the state where "Kondisi darurat medis" is selected: a red-tinted notice "Pengajuan darurat medis akan diprioritaskan." and extra fields Nama Fasilitas Kesehatan and Nomor Surat Keterangan Faskes.
Section "Unggah Berkas": upload cards for KTP, KK, Kartu BPJS/KIS, Surat Keterangan Faskes (marked "Wajib untuk alasan medis").
Bottom: consent checkbox and primary button "Kirim Pengajuan".
```

---

## 6. Pengajuan Layanan Sosial Lainnya (form dinamis)

```
Style: Government social-services portal "SAPA SOSIAL" of Dinas Sosial Kabupaten Blitar. Mobile-first (390px), responsive. Clean, warm, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, inputs 8px radius, text #111827, muted #6B7280. Large tap targets, visible labels. Thin crimson top bar. All UI text in Bahasa Indonesia.

Page: "Ajukan Layanan Sosial" generic request form.
Step 1: dropdown/cards "Pilih Jenis Layanan" (e.g. Rekomendasi Bantuan Sosial, Permohonan Pelayanan Rehabilitasi). After selecting, show a card "Persyaratan yang Diperlukan" as a checklist that changes per service type.
Then form fields: Nama, NIK, No. KK, No. HP, Alamat, Kecamatan, Desa/Kelurahan, and dynamic upload cards for each required document (marked Wajib/Opsional), plus "Keterangan tambahan" textarea.
Primary button "Kirim Pengajuan" disabled until required documents are complete, with helper text "Lengkapi semua dokumen wajib untuk melanjutkan."
```

---

## 7. Permohonan Rehabilitasi Sosial

```
Style: Government social-services portal "SAPA SOSIAL" of Dinas Sosial Kabupaten Blitar. Mobile-first (390px), responsive. Clean, warm, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, inputs 8px radius, text #111827, muted #6B7280. Empathetic, calm tone; large tap targets. Thin crimson top bar. All UI text in Bahasa Indonesia.

Page: "Permohonan Pelayanan Rehabilitasi Sosial".
Top intro card: short explanation of the service and who can be helped, with an empathetic illustration.
Client category selection as chips/cards: Lansia Terlantar, Penyandang Disabilitas, ODGJ Terlantar, Anak, Korban Tindak Kekerasan, Lainnya.
Form: Data Pemohon (nama, NIK, No. HP, hubungan dengan calon klien), Data Calon Klien (nama, NIK opsional, jenis kelamin, usia, alamat, Kecamatan, Desa/Kelurahan), Kondisi & Kebutuhan (textarea), Unggah Dokumen Pendukung (opsional).
Info note: "Data klien bersifat rahasia dan hanya dapat diakses petugas yang ditugaskan."
Primary button "Kirim Permohonan". Add a small side card "Butuh bantuan segera? Hubungi kami" with phone button.
```

---

## 8. Pengaduan dan Laporan Sosial

```
Style: Government social-services portal "SAPA SOSIAL" of Dinas Sosial Kabupaten Blitar. Mobile-first (390px), responsive. Clean, warm, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, inputs 8px radius, text #111827, muted #6B7280. Large tap targets, visible labels, inline validation in Indonesian. Thin crimson top bar. All UI text in Bahasa Indonesia.

Page: "Pengaduan dan Laporan Sosial".
Info card: "Laporan Anda akan diverifikasi petugas sebelum ditindaklanjuti."
Form: Kategori Permasalahan (chips or dropdown), Lokasi Kejadian (Kecamatan, Desa/Kelurahan, detail alamat opsional), Deskripsi Permasalahan (textarea with character counter and hint "Jelaskan siapa, apa, kapan, dan di mana"), Unggah Foto/Dokumen (opsional, multiple, thumbnails), Nama Pelapor, No. HP.
Primary button "Kirim Laporan".
Also include a second frame "Laporan Terkirim": success icon, report number "ADU-202610-00004" with copy button, message "Petugas akan memverifikasi laporan Anda.", buttons "Lacak Status" and "Buat Laporan Lain".
```

---

## 9. Pengajuan Berhasil (nomor tiket)

```
Style: Government social-services portal "SAPA SOSIAL" of Dinas Sosial Kabupaten Blitar. Mobile-first (390px), responsive. Clean, warm, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, text #111827, muted #6B7280. Thin crimson top bar. All UI text in Bahasa Indonesia.

Page: "Pengajuan Berhasil Dikirim".
Green success icon, heading, large ticket number "DTSEN-202610-00012" in a highlighted box with a "Salin" button. Text: "Simpan nomor tiket ini untuk memantau perkembangan pengajuan Anda."
Summary card: Jenis Layanan, Tanggal Pengajuan, Status (badge "Diajukan"), Perkiraan proses.
Info card "Langkah Selanjutnya": 3 short bullets (petugas memeriksa berkas, Anda akan diminta memperbaiki bila ada kekurangan, pantau dengan nomor tiket).
Buttons: "Lacak Status" (primary), "Kembali ke Beranda" (outline).
```

---

## 10. Cek Status Tiket

```
Style: Government social-services portal "SAPA SOSIAL" of Dinas Sosial Kabupaten Blitar. Mobile-first (390px), responsive. Clean, warm, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, inputs 8px radius, text #111827, muted #6B7280. Status colors: success #16A34A, warning #D97706, danger #DC2626, info #2563EB. Thin crimson top bar. All UI text in Bahasa Indonesia.

Design three frames.

Frame A "Cek Status Tiket" (search): title, explanation, inputs "Nomor Tiket" and "4 digit terakhir NIK / No. HP", button "Lacak", helper link "Lupa nomor tiket? Hubungi kami".

Frame B "Hasil" for a Reaktivasi PBI-JK ticket: header card with ticket number PBI-202610-00007, service name, status pill "Diusulkan ke Kemensos", submitted date, petugas unit. Below, a vertical timeline marking completed, current, and upcoming stages: Diajukan, Pemeriksaan Berkas, Verifikasi Kelayakan, Menunggu Persetujuan, Surat Rekomendasi Terbit, Diusulkan ke Kemensos (current), Disetujui Kemensos, Kepesertaan Aktif Kembali, Selesai. Completed stages show date and short note. Show only first name and masked NIK (**** **** **** 1234).

Frame C "Perlu Perbaikan Berkas": amber alert card with petugas note "Foto KK kurang jelas, mohon unggah ulang", upload card, button "Unggah Perbaikan".

Optional variant: a finished DTSEN ticket with a green card "Surat Anda sudah terbit" and buttons "Unduh Surat (PDF)" and "Verifikasi Keaslian".
```

---

## 11. Verifikasi Keaslian Surat

```
Style: Government social-services portal "SAPA SOSIAL" of Dinas Sosial Kabupaten Blitar. Mobile-first (390px), responsive. Clean, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, text #111827, muted #6B7280. Success #16A34A, danger #DC2626. Thin crimson top bar. All UI text in Bahasa Indonesia.

Page: "Verifikasi Keaslian Surat" (opened by scanning a QR code on the letter).
Frame A (valid): large green check, heading "Surat Keterangan DTSEN Asli", details card: Nomor Surat 400.9/123/409.XX/2026, Tanggal Terbit, Berlaku Sampai, Nama yang Diterangkan (partially masked, e.g. "A*** R******"), Tujuan Penggunaan, Penandatangan "Kepala Dinas Sosial Kabupaten Blitar", green badge "Berlaku".
Frame B (invalid/expired): red warning icon, "Surat Tidak Dapat Diverifikasi", explanation "Kode tidak ditemukan atau surat sudah kedaluwarsa.", button "Hubungi Dinas Sosial".
Frame C (manual): input "Masukkan Kode Verifikasi" with button "Periksa" and hint on where to find the code.
```

---

## 12. Pencarian Informasi & FAQ

```
Style: Government social-services portal "SAPA SOSIAL" of Dinas Sosial Kabupaten Blitar. Mobile-first (390px), responsive. Clean, warm, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, text #111827, muted #6B7280. Thin crimson top bar. All UI text in Bahasa Indonesia.

Design two frames.
Frame A "Pusat Informasi": big search bar with suggestion chips of popular keywords (syarat DTSEN, reaktivasi KIS, cara lapor, jam layanan), sections of information cards (Program Sosial, Rehabilitasi Sosial, Disabilitas, Lansia, Pengaduan) with icon and article count, and "Informasi Paling Sering Dibaca" list.
Frame B "Hasil Pencarian" for keyword "syarat": result count text, list of results (title, category tag, short snippet with highlighted keyword, updated date), and an empty-state variant "Tidak ada hasil untuk pencarian Anda" with buttons "Ajukan Layanan" and "Hubungi Kami".
Add a "Tanya Jawab (FAQ)" section with grouped accordion items.
```

---

## 13. Masuk & Daftar Akun Masyarakat

```
Style: Government social-services portal "SAPA SOSIAL" of Dinas Sosial Kabupaten Blitar. Mobile-first (390px), responsive. Clean, warm, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, inputs 8px radius, text #111827, muted #6B7280. Thin crimson top bar. All UI text in Bahasa Indonesia.

Page: centered auth card with logo "SAPA SOSIAL" and tabs "Masuk" / "Daftar".
Masuk: Email atau No. HP, Password with show/hide icon, checkbox "Ingat saya", link "Lupa password?", primary button "Masuk". Show an inline error "Email atau password tidak sesuai."
Daftar: Nama Lengkap, NIK, No. HP, Email, Password, Konfirmasi Password, consent checkbox, button "Buat Akun".
Below the card: note "Tanpa akun? Anda tetap dapat mengecek status dengan nomor tiket." with link "Cek Status Tiket".
```

---

## 14. Akun Saya (Riwayat)

```
Style: Government social-services portal "SAPA SOSIAL" of Dinas Sosial Kabupaten Blitar. Mobile-first (390px), responsive. Clean, warm, trustworthy, accessible. Font Inter, body 16px min. Primary crimson #B91C1C, accent amber #F59E0B, background #FAFAFA, white cards with 1px #E5E7EB border, 12px radius, text #111827, muted #6B7280. Status colors: success #16A34A, warning #D97706, danger #DC2626, info #2563EB. Thin crimson top bar. All UI text in Bahasa Indonesia.

Page: "Akun Saya" for a logged-in citizen. Navbar shows user name with dropdown (Profil, Keluar).
Top: greeting "Halo, Budi Santoso" with quick action buttons "Ajukan Layanan" and "Buat Pengaduan".
Tabs: "Pengajuan", "Pengaduan", "Profil".
Pengajuan tab: list of cards, each with ticket number, service name, submitted date, status pill (Diajukan, Perlu Perbaikan, Diproses, Selesai, Ditolak), and a "Lihat Detail" link. Highlight a card needing action with an amber "Perlu Perbaikan Berkas" strip. Include a filter by status and an empty state illustration "Belum ada pengajuan".
Profil tab: editable fields (nama, No. HP, email) with masked NIK and button "Simpan Perubahan".
```

---

## Tips penyesuaian

- Hasil terlalu ramai: tambahkan `make it simpler, fewer decorations`.
- Ganti warna primer: ubah kode warna di baris `Style:` pada semua prompt (mis. hijau `#15803D` atau biru `#1D4ED8`). Kalau Dinas Sosial punya warna atau logo resmi, gunakan kode warna tersebut.
- Untuk versi desktop, ganti `Mobile-first (390px)` menjadi `Desktop-first (1440px)`.
