<?php

namespace App\Console\Commands;

use App\Models\Psychologist;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use App\Models\EducationalQualification;

class DeleteUnusedFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-unused-files';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $psychologistImages = Psychologist::pluck('image')->toArray();
        $psychologistFiles = [];
        foreach ($psychologistImages as $imagesJson) {
            $imagesArray = json_decode($imagesJson, true);
            if (is_array($imagesArray)) {
                $psychologistFiles = array_merge($psychologistFiles, $imagesArray);
            }
        }

        $educationalQualificationFiles = EducationalQualification::pluck('image')->toArray();

        $allFiles = array_merge($psychologistFiles, $educationalQualificationFiles);

        $storageFiles = collect(Storage::disk('local')->allFiles())
            ->reject(fn (string $file) => $file === '.gitignore')
            ->reject(fn (string $file) => in_array($file, $allFiles));

        $storageFiles->each(fn ($file) => Storage::disk('public')->delete($file));
    }
}
