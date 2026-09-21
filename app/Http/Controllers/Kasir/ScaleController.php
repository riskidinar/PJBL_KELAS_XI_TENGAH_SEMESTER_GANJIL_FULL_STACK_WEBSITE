<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use Illuminate\View\View;

class ScaleController extends Controller
{
    public function index(): View
    {
        return view('kasir.scale.index');
    }
}
