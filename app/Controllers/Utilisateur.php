<?php

namespace App\Controllers;

class Utilisateur extends BaseController
{
    private function isAuthorized(): bool
    {
        $user = auth()->user();
        return $user->inGroup('admin');
    }

    public function liste(): string
    {
        if (!$this->isAuthorized()) {
            return redirect('accueil');
        }

        return view('utilisateur_liste');
    }
}
