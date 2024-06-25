<?php

namespace App\Filament\Resources\PsychologistResource\Pages;

use Filament\Actions;
use Filament\Forms\Components\Wizard;
use App\Models\EducationalQualification;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Pages\EditRecord;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\MarkdownEditor;
use App\Filament\Resources\PsychologistResource;
use Pboivin\FilamentPeek\Pages\Actions\PreviewAction;
use Pboivin\FilamentPeek\Pages\Concerns\HasPreviewModal;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Mohamedsabil83\FilamentFormsTinyeditor\Components\TinyEditor;


class EditPsychologist extends EditRecord
{
    use HasPreviewModal;
    protected static string $resource = PsychologistResource::class;
    public static function getNavigationLabel(): string
    {
        return 'Змінити персональні дані';
    }
    use EditRecord\Concerns\HasWizard;
    public function hasSkippableSteps(): bool
    {
        return true;
    }
    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            PreviewAction::make()
                ->viewData([
                    'psychologist' => $this->record,
                    'qualifications' => EducationalQualification::all(),
                ]),
        ];
    }
    protected function getPreviewModalView(): ?string
    {
        return 'source.about-me';
    }

    protected function getPreviewModalDataRecordKey(): ?string
    {
        return 'psychologist';
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
