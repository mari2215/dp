<?php

namespace App\Filament\Resources\PsychologistResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Wizard\Step;
use Filament\Resources\Pages\CreateRecord;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\PsychologistResource;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;

class CreatePsychologist extends CreateRecord
{
    use CreateRecord\Concerns\HasWizard;

    protected static string $resource = PsychologistResource::class;

    public function hasSkippableSteps(): bool
    {
        return true;
    }

    protected function getSteps(): array
    {
        return [
            Wizard\Step::make('Контактна інформація')
                ->schema([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255),
                    TinyEditor::make('title')
                        ->maxLength(255),
                    TinyEditor::make('subtitle'),
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
                    TinyEditor::make('youtube_title')
                        ->maxLength(255),
                    TextInput::make('video_url')
                        ->maxLength(255),
                    FileUpload::make('image')
                        ->disk('local')
                        ->image() // Дозволяє завантаження зображень
                        ->imageEditor() // Дозволяє редагування зображень
                        ->multiple() // Дозволяє завантаження декількох файлів
                        ->directory('images/psychologist')
                        ->preserveFilenames()
                ]),
        ];
    }
}
