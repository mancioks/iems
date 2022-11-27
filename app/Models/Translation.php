<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $fillable = [
        'language_id',
        'entry_id',
        'translation',
    ];

    public function language()
    {
        return $this->hasOne(\App\Models\Language::class, 'id', 'language_id');
    }
}
