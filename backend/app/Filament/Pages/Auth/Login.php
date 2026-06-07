<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Facades\Filament;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\HtmlString;

class Login extends BaseLogin
{
    public function mount(): void
    {
        if (Filament::auth()->check()) {
            redirect()->intended(Filament::getUrl());
        }

        $this->form->fill([
            'email' => 'academiaseuracha@seuracha.com',
            'password' => '12345678',
        ]);
    }

    public function getHeading(): string|Htmlable|null
    {
        return 'Acesse sua conta';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return new HtmlString('Ou <a href="'.url('/').'" class="ar-front-login-link">volte para a pagina inicial</a>');
    }
}
