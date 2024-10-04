<?php

namespace App\Controllers;

class Salarie extends BaseController
{
    public function liste(): string
    {
        return view('salaries_liste');
    }
}