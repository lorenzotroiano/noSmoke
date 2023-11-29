<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Smoke;
use Carbon\Carbon;

class SmokeController extends Controller
{
    public function index()
    {
        $stopSmoking = Smoke::latest()->first();

        if ($stopSmoking) {
            $stopSmoking->data_fine = Carbon::parse($stopSmoking->data_fine);
        }

        return view('smoke.index', compact('stopSmoking'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'data_fine' => 'required|date',
        ]);

        Smoke::create(['data_fine' => $request->input('data_fine')]);

        return redirect()->route('smoke.index');
    }
}
