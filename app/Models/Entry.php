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

    protected $fillable = ['value', 'type'];
    protected $hidden = ['created_at', 'updated_at'];
}