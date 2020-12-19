<?php
namespace AvoRed\Banner\Database\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    const ENABLED = 'ENABLED';
    const DISABLED = 'DISABLED';

    protected $fillable = [
        'name',
        'image_path',
        'alt_text',
        'url',
        'target',
        'status',
        'sort_order'
    ];
}
