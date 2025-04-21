<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LogoutTest extends DuskTestCase
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
            
            // Memunculkan menu dropdown user
            ->click('@navbar-user') // Klik menu user di navbar
            ->clickLink('Log Out') // Tekan tombol Log Out
            ->assertPathIs('/') // Cek apakah logout dengan user di redirect ke halaman awal (/)
            
            // Cek apakah sudah logout
            ->assertSee('Log in') // Cek apakah ada elemen Log in
            ->assertSee('Register'); // Cek apakah ada elemen Register

        });
    }
}
