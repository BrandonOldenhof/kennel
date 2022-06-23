<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class OptimizeImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'image:optimize {path=public/images}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Optimize all images in the supplied storage {path}, or public/images by default.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $images = $this->getImages($this->getPath($this->argument('path')));
        $this->info("The following {$images->count()} images will be optimized:");

        $preOptimization = $this->outputFiles($images);

        $this->table(
            ['path', 'filesize'],
            $preOptimization
        );

        if (! $this->confirm('Do you wish to continue?', false)) {
            return;
        }

        $this->withProgressBar(
            $preOptimization,
            function (array $item): void {
                $path = storage_path("app/{$item['path']}");
                ImageOptimizer::optimize($path);
            }
        );

        $this->newLine();

        $this->table(
            ['path', 'filesize', 'optimized'],
            $this->outputOptimized($preOptimization)
        );
    }

    /**
     * Get the path to the images to optimize.
     * Fall back on public/images if none is supplied.
     */
    public function getPath(?string $path = 'public/images'): string
    {
        return $path;
    }

    public function getImages(string $path): Collection
    {
        return collect(Storage::files($path));
    }

    /**
     * Generate an array of files that will be optimized.
     * This array is displayed in a table.
     */
    public function outputFiles(Collection $images): Collection
    {
        return $images->map(function (string $path) {
            $size = Storage::size($path);

            return [
                'path' => $path,
                'original' => $this->formatBytes($size),
            ];
        });
    }

    /**
     * Add an "Optimized" column to the table that displays the optimized files.
     */
    public function outputOptimized(Collection $preOptimization): Collection
    {
        return $preOptimization->map(function (array $item) {
            $path = Storage::size($item['path']);

            return array_merge($item, ['optimized' => $this->formatBytes($path)]);
        });
    }

    /**
     * The default filesize displayed by the Storage::size function is in bytes.
     * To make the output of the command more readable we're formatting it to a human-readable unit.
     */
    public function formatBytes(float $size, int $precision = 2): string
    {
        $base = log($size, 1024);
        $suffixes = ['B', 'KB', 'MB', 'GB', 'TB'];

        return round(pow(1024, $base - floor($base)), $precision).' '.$suffixes[floor($base)];
    }
}
