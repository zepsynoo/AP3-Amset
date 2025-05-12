<?php

namespace App\Controllers;

class Amset extends BaseController
{

    public function main(): string
    {
        // rendirect vers la page d'accueil
        return view('accueil');
    }
}
