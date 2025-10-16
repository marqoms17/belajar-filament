<?php

namespace App\Filament\Resources\PatientResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\PatientResource;

class CreatePatient extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;
    protected static string $resource = PatientResource::class;

    protected function getSteps(): array
    {
        return [
            Step::make('Name')
                ->description('Give pet name')
                ->schema([
                    PatientResource::getNameFormField(),
                ]),
            Step::make('Type')
                ->description('Give pet type')
                ->schema([
                    PatientResource::getTypeFormField(),
                ]),
            Step::make('Date of Birth')
                ->description('Give pet Date of Birth')
                ->schema([
                    PatientResource::getDateFormField()
                ]),
            Step::make('Owner')
                ->description('Choose patient owner')
                ->schema([
                    PatientResource::getOwnerFormField(),
                ]),
        ];
    }

    // public function hasSkippableSteps(): bool
    // {
    //     return true;
    // }
}
