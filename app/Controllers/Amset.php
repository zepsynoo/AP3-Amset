<?php

namespace App\Controllers;

class Amset extends BaseController
{
    public function page(): string
    {
        return view('connexion');
    }

    public function main(): string
    {
        return view('accueil');
    }
}
