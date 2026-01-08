<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FolderImages extends Model
{
    use SoftDeletes;

    protected $table = 'folder_images';

    protected $fillable = [
        'folder_id',
        'image_path',
    ];

    public function folder()
    {
        return $this->belongsTo(Folder::class);
    }
}
