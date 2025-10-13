<?php

namespace App\Filament\Resources\OwnerResource\Pages;

use Filament\Actions;
use Illuminate\Support\Facades\Auth;
use Filament\Notifications\Notification;
use App\Filament\Resources\OwnerResource;
use Filament\Notifications\Actions\Action;
use Filament\Resources\Pages\CreateRecord;

class CreateOwner extends CreateRecord
{
    protected static string $resource = OwnerResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('Owner registered')
            ->body('The owner has been created successfully.');
    }

    protected function beforeCreate(): void
    {
        $user = Auth::user();

        // 1) Hanya admin yang boleh create
        if (! $user || ! (bool) $user->is_admin) {
            Notification::make()
                ->danger()
                ->title('Akses denied')
                ->body('You dont have permission to create this Data!.')
                ->persistent()
                ->actions([
                    Action::make('Back to Dashboard')
                        ->button()
                        ->url(OwnerResource::getUrl('index'), shouldOpenInNewTab: true),
                ])
                ->send();

            $this->halt();
            return;
        }
    }
}
