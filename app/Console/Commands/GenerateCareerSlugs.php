<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Career;
use Illuminate\Support\Str;

class GenerateCareerSlugs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'careers:generate-slugs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate slugs for existing careers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $careers = Career::all();
        $count = 0;

        foreach ($careers as $career) {
            if (empty($career->slug)) {
                $career->slug = Str::slug($career->title);
                $career->save();
                $count++;
                $this->info("Generated slug for: {$career->title} -> {$career->slug}");
            }
        }

        $this->info("Generated slugs for {$count} careers.");
    }
}
