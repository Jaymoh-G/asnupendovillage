<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\Team;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('name');
        });

        // Generate slugs for existing team members
        $teams = Team::all();
        foreach ($teams as $team) {
            $baseSlug = Str::slug($team->name);
            $slug = $baseSlug;
            $counter = 1;

            while (Team::where('slug', $slug)->where('id', '!=', $team->id)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            $team->update(['slug' => $slug]);
        }

        // Now make slug unique and not nullable
        Schema::table('teams', function (Blueprint $table) {
            $table->string('slug')->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teams', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
