<?php

namespace App\Filament\Resources\PsychologistResource\Pages;

use Filament\Actions;
use App\Models\Psychologist;
use Filament\Pages\Actions\Action;
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
    public static function getNavigationLabel(): string
    {
        return 'Створити персональні дані';
    }
    protected function getHeaderActions(): array
    {
        return [
            Action::make('form-fake-filler')
                ->label('Заповнити форму')
                ->icon('heroicon-o-sparkles')
                ->color('info')
                ->action(function (self $livewire): void {
                    $data = Psychologist::factory()->make()->toArray();

                    $livewire->form->fill($data);
                })->visible(fn () => app()->environment('local')),
        ];
    }
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
                        ->maxLength(255)
                        ->label(__('Імя')),
                    TinyEditor::make('title')
                        ->label(__('Заголовок')),
                    TinyEditor::make('subtitle')
                        ->label(__('Опис'))
                        ->columnSpanFull()
                        ->fileAttachmentsDisk('local')
                        ->fileAttachmentsVisibility('public')
                        ->fileAttachmentsDirectory('images/uploads'),
                    TextInput::make('phone')
                        ->tel()
                        ->maxLength(255)
                        ->label(__('Телефон')),
                    TextInput::make('email')
                        ->email()
                        ->maxLength(255)
                        ->label(__('Пошта')),
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
                        ->maxLength(255)
                        ->label(__('Заголовок')),
                    TextInput::make('video_url')
                        ->maxLength(255)
                        ->label(__('Посилання на відео')),
                    FileUpload::make('image')
                        ->disk('local')
                        ->reorderable()
                        ->image()
                        ->imageEditor()
                        ->multiple()
                        ->directory('images/psychologist')
                        ->preserveFilenames()
                        ->label(__('Зображення'))
                ]),
        ];
    }
}
