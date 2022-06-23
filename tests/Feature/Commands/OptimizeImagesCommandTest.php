<?php

namespace Tests\Feature\Commands;

use App\Console\Commands\OptimizeImages;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use Tests\TestCase;

class OptimizeImagesCommandTest extends TestCase
{
    private OptimizeImages $optimizeImages;

    public function setUp(): void
    {
        parent::setUp();

        Storage::makeDirectory('tests');
        Storage::put('tests/image-1.png', Storage::disk('local')->get('private/tests/images/image-1.png'));
        Storage::put('tests/image-2.png', Storage::disk('local')->get('private/tests/images/image-2.png'));

        $this->optimizeImages = new OptimizeImages();
    }

    public function test_optimize_command_is_scheduled_when_activated_in_env(): void
    {
        config(['rox.image.optimize' => true]);
        $event = $this->getCommandFromSchedule();
        $this->assertNotNull($event);
    }

    public function test_optimize_command_is_not_scheduled_when_not_activated_in_env(): void
    {
        config(['rox.image.optimize' => false]);
        $event = $this->getCommandFromSchedule();
        $this->assertNull($event);
    }

    public function test_files_are_generated(): void
    {
        Storage::assertExists('tests/image-1.png');
        Storage::assertExists('tests/image-2.png');
    }

    public function test_file_path_defaults_to_public_images_(): void
    {
        $this->assertEquals('public/images', $this->optimizeImages->getPath());
        $this->assertEquals('public/images', $this->optimizeImages->getPath('public/images'));
    }

    public function test_file_path_can_be_set(): void
    {
        $this->assertEquals('private/images', $this->optimizeImages->getPath('private/images'));
    }

    public function test_images_are_found(): void
    {
        $images = $this->optimizeImages->getImages($this->optimizeImages->getPath('tests'));
        $preOptimization = $this->optimizeImages->outputFiles($images);

        $this->artisan('image:optimize tests')
            ->expectsOutput('The following 2 images will be optimized:')
            ->expectsTable(['path', 'filesize'], $preOptimization)
            ->expectsConfirmation('Do you wish to continue?', false);
    }

    public function test_file_list_can_be_generated(): void
    {
        $files = collect(Storage::files($this->optimizeImages->getPath('tests')));
        $images = $this->optimizeImages->outputFiles($files);

        $this->isInstanceOf($images, Collection::class);

        $images->each(function (array $image) {
            $this->assertArrayHasKey('path', $image);
            $this->assertArrayHasKey('original', $image);
        });
    }

    public function test_images_are_optimized(): void
    {
        $files = collect(Storage::files($this->optimizeImages->getPath('tests')));

        $images = $this->optimizeImages->outputFiles($files);

        $images->each(function (array $item): void {
            $path = storage_path("app/{$item['path']}");
            ImageOptimizer::optimize($path);
        });

        $this->optimizeImages->outputOptimized($images)
            ->each(function (array $image) {
                $this->assertArrayHasKey('path', $image);
                $this->assertArrayHasKey('original', $image);
                $this->assertArrayHasKey('optimized', $image);
                $this->assertTrue($image['original'] > $image['optimized']);
            });
    }

    private function getCommandFromSchedule(): ?Event
    {
        $schedule = app()->make(Schedule::class);

        return collect($schedule->events())
            ->filter(function (Event $event): bool {
                return str_contains($event->command, 'image:optimize');
            })
            ->first() ?? null;
    }
}
