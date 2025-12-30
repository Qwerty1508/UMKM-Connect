<?php

namespace App\Livewire;

use Livewire\Component;

class HelpCenter extends Component
{
    public $faqs = [
        [
            'question' => 'Bagaimana cara mendaftar sebagai penjual?',
            'answer' => 'Anda dapat mendaftar dengan membuat akun, memilih opsi "Seller" saat registrasi, atau masuk ke menu "Gabung sebagai Mitra" di dashboard akun Anda.'
        ],
        [
            'question' => 'Apakah ada biaya layanan?',
            'answer' => 'Saat ini UMKM Connect tidak membebankan biaya layanan (Gratis) untuk mendukung pertumbuhan UMKM lokal.'
        ],
        [
            'question' => 'Bagaimana metode pembayarannya?',
            'answer' => 'Kami mendukung pembayaran melalui transfer bank manual. Bukti bayar harus diupload saat checkout.'
        ],
        [
            'question' => 'Apakah bisa COD (Bayar di Tempat)?',
            'answer' => 'Fitur COD tergantung pada kebijakan masing-masing penjual. Silakan chat penjual untuk memastikan.'
        ]
    ];

    public function render()
    {
        return view('livewire.help-center')->layout('layouts.app');
    }
}
