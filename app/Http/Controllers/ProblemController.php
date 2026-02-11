<?php

namespace App\Http\Controllers;

use App\Models\Device;

class ProblemController extends Controller
{
    public function index()
    {
        $devices = Device::with(['problems' => function ($query) {
            $query->where('is_active', true);
        }])
            ->where('is_active', true)
            ->get();

        return view('pages.problems', [
            'devices' => $devices,
        ]);
    }
}
