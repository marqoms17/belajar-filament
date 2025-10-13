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
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                ]),
            Step::make('Type')
                ->description('Give pet type')
                ->schema([
                    Select::make('type')
                        ->options([
                            'cat' => 'Cat',
                            'dog' => 'Dog',
                            'rabbit' => 'Rabbit'
                        ])
                        ->required(),
                ]),
            Step::make('Date of Birth')
                ->description('Give pet Date of Birth')
                ->schema([
                    DatePicker::make('date_of_birth')
                        ->required()
                        ->maxDate(now()),
                ]),
            Step::make('Owner')
                ->description('Choose patient owner')
                ->schema([
                    Select::make('owner_id')
                        ->relationship('owner', 'name')
                        ->searchable()
                        ->preload()
                        ->createOptionForm([
                            TextInput::make('name')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('email')
                                ->label('Email Address')
                                ->email()
                                ->required()
                                ->maxLength(255),
                            TextInput::make('phone')
                                ->label('Phone Number')
                                ->tel()
                                ->required(),
                        ])
                ]),
        ];
    }

    // public function hasSkippableSteps(): bool
    // {
    //     return true;
    // }
}
