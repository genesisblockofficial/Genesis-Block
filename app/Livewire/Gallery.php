<?php

namespace App\Livewire;

use App\Models\Folder;
use App\Models\FolderImages;
use Livewire\Component;

class Gallery extends Component
{
    public function render()
    {
        $folders = Folder::query()
            ->where('status', true)
            ->with('parent:id,name')
            ->orderBy('name')
            ->get();
        $relatedImages = FolderImages::query()
            ->whereIn('folder_id', $folders->pluck('id'))
            ->where('status', true)
            ->orderBy('id')
            ->get()
            ->groupBy('folder_id');

        $galleryItems = collect();

        foreach ($folders as $folder) {
            $category = $folder->parent?->name ?: $folder->name;
            $imagePaths = [];
            $storedImages = $folder->images ?? null;

            if (filled($storedImages)) {
                $decodedImages = is_string($storedImages) ? json_decode($storedImages, true) : null;
                $imagePaths = is_array($decodedImages) ? $decodedImages : [$storedImages];
            }

            foreach ($imagePaths as $imagePath) {
                if (filled($imagePath)) {
                    $galleryItems->push([
                        'category' => $category,
                        'title' => $folder->name,
                        'description' => $folder->description,
                        'image' => $imagePath,
                    ]);
                }
            }

            foreach ($relatedImages->get($folder->id, collect()) as $folderImage) {
                if (filled($folderImage->image_path)) {
                    $galleryItems->push([
                        'category' => $category,
                        'title' => $folder->name,
                        'description' => $folder->description,
                        'image' => $folderImage->image_path,
                    ]);
                }
            }
        }

        return view('livewire.gallery', [
            'galleryItems' => $galleryItems,
            'categories' => $galleryItems->pluck('category')->unique()->values(),
        ])->layout('layout.app');
    }
}
