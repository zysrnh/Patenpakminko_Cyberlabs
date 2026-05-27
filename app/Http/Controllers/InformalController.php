<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InformalController extends Controller
{
    /**
     * Menampilkan halaman peta publik (Informal) yang dibatasi untuk area Sukabumi.
     */
    public function index()
    {
        return view('informal.index');
    }
}
