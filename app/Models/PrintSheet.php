<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'sheet_url'
    ];

    // hasmany relation with PrintSheetItem
    public function sheetItems()
    {
        return $this->hasMany(PrintSheetitem::class);
    }
}
