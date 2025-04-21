<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class DisplayNoteTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testExample(): void
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
            ->assertSee('Create Note') // Cek apakah ada elemen Create Note
            ->assertPathIs('/notes'); // Cek apakah sudah di halaman notes
        });
    }
}
