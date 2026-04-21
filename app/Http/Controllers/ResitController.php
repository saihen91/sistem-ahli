<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resit;

class ResitController extends Controller
{
    public function print($id)
    {
        $resit = Resit::with('anggota')->findOrFail($id);
        return view('resit.print', compact('resit'));
    }
}
