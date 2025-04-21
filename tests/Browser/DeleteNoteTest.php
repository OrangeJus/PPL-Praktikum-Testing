<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DeleteNoteTest extends DuskTestCase
{
    public function testDeleteNote(): void
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

            // Klik tombol Delete untuk menghapus note
            ->press('Delete')

            // Cek bahwa note sudah terhapus
            ->assertDontSee('Judul yang Diedit'); // Cek apakah catatan yang dihapus tidak muncul di daftar catatan
        });
    }
}
