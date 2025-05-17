<?php

namespace App\Repositories;

use App\Models\Images;

class ImagesRepository
{
    protected $image;

    public function __construct(Images $image) {
        $this->image = $image;
    }

    /**
     * List all images.
     *
     * This method retrieves a distinct list of authors from the active images in the database.
     *
     * @return array An array of unique authors from active images.
     */
    public function getImages() {
        return $this->image;
    }

    /**
     * Find a image by its ID.
     *
     * This method retrieves a image from the database using its unique identifier.
     *
     * @param int $id The ID of the image to find.
     *
     * @return null|Images Returns the image model if found, null otherwise.
     */
    public function findById(int $id): ?Images {
        return $this->image::find($id);
    }

}
