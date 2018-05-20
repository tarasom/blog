<?php

namespace app\Observers;

use App\Entities\Post;
use Illuminate\Support\Facades\Storage;

class PostObserver
{
    /**
     * Listen to the Post updating event.
     *
     * @param Post $post
     */
    public function updating(Post $post)
    {
        $obsoleteFileName = array_get($post->getDirty(), 'file_name');

        if (null !== $obsoleteFileName) {
            $this->deleteObsoleteImage($obsoleteFileName);
        }
    }

    /**
     * Listen to the Post deleting event.
     *
     * @param Post $post
     */
    public function deleting(Post $post)
    {
        $fileName = $post->getFileName();

        if (null !== $fileName) {
            $this->deleteObsoleteImage($fileName);
        }

        $post->categories()->sync([]);
    }

    /**
     * @param string $fileName
     */
    private function deleteObsoleteImage(string $fileName)
    {
        if (Storage::exists($fileName)) {
            Storage::delete($fileName);
        }
    }
}
