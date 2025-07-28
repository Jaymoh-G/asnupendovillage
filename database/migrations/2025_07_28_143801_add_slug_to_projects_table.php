<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Project;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First add the slug column without unique constraint
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
        });

        // Generate slugs for existing projects
        Project::whereNull('slug')->orWhere('slug', '')->each(function ($project) {
            $baseSlug = Str::slug($project->name);
            $slug = $baseSlug;
            $counter = 1;

            // Ensure unique slug
            while (Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $project->update(['slug' => $slug]);
        });

        // Now add unique constraint
        Schema::table('projects', function (Blueprint $table) {
            $table->string('slug')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
