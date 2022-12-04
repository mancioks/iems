<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    public const TYPE_TEXT = 'text';
    public const TYPE_BLOCK = 'block';
    public const TYPE_NUMBER = 'number';

    public const TYPES = [
        self::TYPE_TEXT => 'Simple',
        self::TYPE_NUMBER => 'Number',
        self::TYPE_BLOCK => 'Block',
    ];

    protected $fillable = ['value', 'type'];
    protected $hidden = ['created_at', 'updated_at'];

    public function translations()
    {
        return $this->hasMany(\App\Models\Translation::class, 'entry_id', 'id');
    }
}
