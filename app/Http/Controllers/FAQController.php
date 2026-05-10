<?php

namespace App\Http\Controllers;

use App\Models\Faq; // Import Model Faq yang kita buat tadi
use Illuminate\Http\Request;

class FAQController extends Controller
{
    public function index()
    {
        // Ambil semua data FAQ dari database
        $faqs = Faq::orderBy('order', 'asc')->get();

        // Kirim data ke file view resources/views/faq/index.blade.php
        return view('faq.index', compact('faqs'));
    }
}