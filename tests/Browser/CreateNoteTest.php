<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateNoteTest extends DuskTestCase
{
    public function testCreateNote(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://127.0.0.1:8000/login')
                ->type('email', 'testuser@example.com') // Memasukan email yang telah terdaftar
                ->type('password', 'password123')       // Begitu pun password nya
                ->press('LOG IN')                         // Tekan tombol login
                ->assertPathIs('/dashboard')             // Cek apakah sudah di dashboard
                
                // Masuk ke menu Notes
                ->clickLink('Notes')                     // Klik menu Notes di navbar
                ->assertPathIs('/notes')                 // Cek apakah sudah di halaman notes

                // Klik tombol untuk membuat note baru
                ->clickLink('Create Note')                   // Klik tombol Create Note

                // Sekarang masuk ke URL create-note
                ->type('title', 'Catatan Uji Coba')      // Isi judul catatan
                ->type('description', 'Ini adalah isi dari catatan ujicoba Laravel Dusk.') // Isi deskripsi catatan

                // Submit form
                ->press('CREATE')                        // Tekan tombol CREATE untuk menyimpan catatan

                // Cek hasilnya
                ->assertPathIs('/notes')                 // Pastikan kembali ke halaman notes
                ->assertSee('Catatan Uji Coba');         // Cek apakah catatan baru muncul di daftar catatan
        });
    }
}
