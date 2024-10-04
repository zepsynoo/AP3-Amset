<?php

namespace App\Controllers;

class Mission extends BaseController
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