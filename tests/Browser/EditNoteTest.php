<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class EditNoteTest extends DuskTestCase
{
    public function testEditNote(): void
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
                    
                    // Klik tombol untuk mengedit note
                    ->clickLink('Edit')                        

                    // Sekarang masuk ke URL edit-note
                    ->assertPathBeginsWith('/edit-note-page')         // Cek apakah sudah di halaman edit-note
                    ->assertSee('Edit Note') // Cek apakah ada elemen Edit Note
                    ->assertSee('Title')    // Cek apakah ada elemen Title
                    ->assertSee('Description')  // Cek apakah ada elemen Description
                    ->assertSee('UPDATE') // Cek apakah ada elemen UPDATE 

                    // Isi form edit
                    ->type('title', 'Judul yang Diedit') // Isi judul catatan
                    ->type('description', 'Deskripsi sudah diperbarui.') // Isi deskripsi catatan

                    // Submit form dengan menekan tombol UPDATE
                    ->press('UPDATE')

                    // Cek hasilnya
                    ->assertSee('Judul yang Diedit'); // Cek apakah catatan yang diedit muncul di daftar catatan
        });
    }
}
