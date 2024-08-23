<?php

namespace App\Http\Controllers;

class TimeController extends Controller
{
    public function __invoke($subyear)
    {
        return now()->subYears($subyear)->toDateString();
    }
}
