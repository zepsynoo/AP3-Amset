<?php

namespace App\Controllers;

class Mission extends BaseController
{
    public function liste(): string
    {
        return view('mission_liste');
    }
}