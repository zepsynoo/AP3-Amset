<?php

namespace App\Controllers;

class Salarie extends BaseController
{
    private $salarieModel;

    public function __construct()
    {
        $this->salarieModel = model('Salarie');
    }

    //-----------------------------------
    // Liste
    public function liste(): string
    {
        return view('salaries_liste');
    }

    //-----------------------------------
    // Ajouter
    public function ajout()
    {
        return view(
            'salaries_ajoute',
            [
                ''=>
            ]
        );
    }

    // Create
    public function create(): string
    {
        return view('');
    }

    //-----------------------------------
    // Modifier
    public function modif(): string
    {
        return view('');
    }

    // Update
    public function update(): string
    {
        return view('');
    }

    //-----------------------------------
    // Delete
    public function delete(): string
    {
        return view('');
    }
}
