<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Notifications\Notification;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    protected string $view = 'filament.pages.auth.login';

    public function authenticate(): ?LoginResponse
    {
        try {
            return parent::authenticate();
        } catch (ValidationException $e) {
            Notification::make()
                ->title('Login Failed')
                ->body($e->getMessage())
                ->danger()
                ->send();

            return null;
        }
    }

    public function getHeading(): string | Htmlable | null
    {
        return null; 
    }

    public function hasLogo(): bool
    {
        return false;
    }
}
