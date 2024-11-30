<?php

namespace App\Controllers;

class Utilisateur extends BaseController
{
    public function liste(): string
    {
        return view('utilisateur_liste');
    }
}