<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Download extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'downloads';
    protected $fillable = [
        'title',
        'description',
        'file_path',
        'program_id',
        'status',
    ];

    // Accessor for file size
    public function getFileSizeAttribute()
    {
        if ($this->file_path && Storage::disk('public')->exists($this->file_path)) {
            return Storage::disk('public')->size($this->file_path);
        }
        return null;
    }

    public function program()
    {
        return $this->belongsTo(\App\Models\Program::class);
    }
}
