<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $images = DB::table('images')->select('id', 'caption', 'original_name', 'filename')->get();
        foreach ($images as $image) {
            if (empty($image->caption)) {
                $name = $image->original_name ?: $image->filename;
                $fallback = pathinfo($name, PATHINFO_FILENAME);
                DB::table('images')->where('id', $image->id)->update(['caption' => $fallback]);
            }
        }
    }

    public function down(): void
    {
        // No-op: do not unset captions once set
    }
};


