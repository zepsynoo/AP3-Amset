<?php

namespace App\Controllers;

class Profil extends BaseController
{
    public function liste(): string
    {
        return view('profils_liste');
    }
}