<?php

namespace App\Filament\Resources\OwnerResource\Pages;

use Filament\Actions;
use Filament\Notifications\Notification;
use App\Filament\Resources\OwnerResource;
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
}
