<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Testimonial;
use Illuminate\Support\Str;

class GenerateTestimonialSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'testimonials:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for existing testimonials';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Generating slugs for testimonials...');

        $testimonials = Testimonial::whereNull('slug')->orWhere('slug', '')->get();

        if ($testimonials->isEmpty()) {
            $this->info('All testimonials already have slugs.');
            return;
        }

        $bar = $this->output->createProgressBar($testimonials->count());
        $bar->start();

        foreach ($testimonials as $testimonial) {
            $baseSlug = Str::slug($testimonial->name);
            $slug = $baseSlug;
            $counter = 1;

            // Ensure unique slug
            while (Testimonial::where('slug', $slug)->where('id', '!=', $testimonial->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $testimonial->update(['slug' => $slug]);
            $bar->advance();
        }

        $bar->finish();
        $this->newLine();
        $this->info('Slugs generated successfully for ' . $testimonials->count() . ' testimonials.');
    }
}
