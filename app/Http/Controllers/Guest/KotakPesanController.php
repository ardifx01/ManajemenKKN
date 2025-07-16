<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\KotakPesan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class KotakPesanController extends Controller
{
    public function store(Request $request)
    {
        $ip = $request->ip();
        $rateKey = 'contact:' . $ip;

        // Limit 2 request per 30 menit per IP
        if (RateLimiter::tooManyAttempts($rateKey, 2)) {
            $seconds = RateLimiter::availableIn($rateKey);

            $minutes = ceil($seconds / 60); // dibulatkan ke atas
            $message = 'Terlalu sering mengirim pesan. Coba lagi dalam ' . $minutes . ' menit.';

            return back()->withErrors([$message]);
        }

        RateLimiter::hit($rateKey, 1800); // Tambah 1 hit, berlaku 30 menit

        // Validasi input
        $data = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'message' => 'required|string|max:1000',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'message.required' => 'Pesan wajib diisi.',
        ]);

        // Simpan ke database
        KotakPesan::create($data);

        return back()->with('success', 'Pesan berhasil dikirim.');
    }
}
