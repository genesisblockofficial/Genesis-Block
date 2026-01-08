<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Folder extends Model
{
    use SoftDeletes;
    
    protected $table = 'folders';

    protected $fillable = [
        'name',
        'description',
        'images',
        'parent_id',
    ];

    public function parent()
    {
        return $this->belongsTo(Folder::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Folder::class, 'parent_id');
    }

    public function images()
    {
        return $this->hasMany(FolderImages::class, 'folder_id');
    }
}
