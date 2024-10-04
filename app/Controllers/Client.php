<?php

namespace App\Controllers;

class Client extends BaseController
{
    public function liste(): string
    {
        return view('clients_liste');
    }
}