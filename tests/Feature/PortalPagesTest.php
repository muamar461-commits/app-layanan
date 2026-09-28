<?php

namespace Tests\Feature;

use Tests\TestCase;

class PortalPagesTest extends TestCase
{
    public function test_home_page_renders_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('SAPA SOSIAL');
    }

    public function test_service_catalog_page_renders_successfully(): void
    {
        $response = $this->get('/layanan');

        $response->assertStatus(200);
        $response->assertSee('Katalog &amp; Informasi Layanan', false);
    }

    public function test_service_detail_page_renders_successfully(): void
    {
        $response = $this->get('/layanan/surat-keterangan-dtsen');

        $response->assertStatus(200);
        $response->assertSee('Layanan Penerbitan Surat Keterangan Terdaftar DTSEN');
    }

    public function test_service_request_form_renders_successfully(): void
    {
        $response = $this->get('/pengajuan');

        $response->assertStatus(200);
        $response->assertSee('Formulir Pengajuan Layanan');
    }

    public function test_complaint_form_renders_successfully(): void
    {
        $response = $this->get('/pengaduan');

        $response->assertStatus(200);
        $response->assertSee('Pengaduan &amp; Laporan Masalah Sosial', false);
    }

    public function test_track_ticket_page_renders_successfully(): void
    {
        $response = $this->get('/cek-status');

        $response->assertStatus(200);
        $response->assertSee('Lacak Status Permohonan');
    }

    public function test_verify_certificate_page_renders_successfully(): void
    {
        $response = $this->get('/verifikasi');

        $response->assertStatus(200);
        $response->assertSee('Verifikasi Keaslian Surat');
    }

    public function test_information_faq_page_renders_successfully(): void
    {
        $response = $this->get('/informasi');

        $response->assertStatus(200);
        $response->assertSee('Pusat Informasi &amp; FAQ', false);
    }

    public function test_citizen_auth_page_renders_successfully(): void
    {
        $response = $this->get('/masuk');

        $response->assertStatus(200);
        $response->assertSee('Masuk (Punya Akun)');
    }

    public function test_citizen_account_page_renders_successfully(): void
    {
        $response = $this->get('/akun-saya');

        $response->assertStatus(200);
        $response->assertSee('Akun Saya');
    }
}
