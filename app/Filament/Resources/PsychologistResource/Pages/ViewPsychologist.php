<?php

namespace App\Filament\Resources\PsychologistResource\Pages;

use App\Filament\Resources\PsychologistResource;
use Filament\Actions;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\Wizard;

class ViewPsychologist extends ViewRecord
{
    protected static string $resource = PsychologistResource::class;
    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
   use Actions\Concerns\HasWizard;

    protected function getSteps(): array
    {
        return [
            Wizard\Step::make('Контактна інформація')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    MarkdownEditor::make('title')
                        ->maxLength(255),
                    MarkdownEditor::make('subtitle')
                        ->maxLength(255),
                    TextInput::make('phone')
                        ->tel()
                        ->maxLength(255),
                    TextInput::make('email')
                        ->email()
                        ->maxLength(255),
                ]),
            Wizard\Step::make('Месенджери')
                ->schema([
                    TextInput::make('telegram')
                        ->tel()
                        ->maxLength(255),
                    TextInput::make('viber')
                        ->maxLength(255),
                ]),
            Wizard\Step::make('Соціальні мережі')
                ->schema([
                    TextInput::make('facebook')
                        ->maxLength(255),
                    TextInput::make('instagram')
                        ->maxLength(255),
                ]),
            Wizard\Step::make('Відео')
                ->schema([
                    MarkdownEditor::make('youtube_title')
                        ->maxLength(255),
                    TextInput::make('video_url')
                        ->maxLength(255),
                ]),
        ];
    }
}
