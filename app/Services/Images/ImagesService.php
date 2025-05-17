<?php

namespace App\Services\Images;

use App\Models\Image;
use App\Models\Configuration;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ImageResource;
use App\Repositories\ImagesRepository;
use App\Http\Requests\Images\AddRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Images\UpdateRequest;

class ImagesService
{

    protected $imagesRepository;

    public function __construct(ImagesRepository $imagesRepository) {
        $this->imagesRepository = $imagesRepository;
    }

    /**
     * Display a list image.
     *
     * @return JsonResponse Returns a JSON response containing the image data.
     */
    public function show(): JsonResponse
    {
        // Search for the image in the database by its code
        $image = $this->imagesRepository->getImages()->get();

        // Return a successful JSON response with the image data
        return GeneralHelper::response(
            null,
            ImageResource::collection($image),
            201
        );
    }

    /**
     * Store a new image in the database.
     * This function handles storing a new image by processing the incoming request, uploading the image's cover image,
     * saving the file with its original name in the specified folder, and storing the image's data in the database.
     *
     * @param AddRequest $request The request containing the image's data, including the cover image file.
     *
     * @return JsonResponse Returns a JSON response with the newly created image data and a success message.
     */
    public function add(AddRequest $request): JsonResponse
    {
        // Capture all data from the request into an array
        $data = $request->toArray();

        // Retrieve the original name of the uploaded image file
        $filename = $request->file('img')->getClientOriginalName();

        // Save the image in the 'images' directory with the original filename
        $path = $request->file('img')->storeAs("images", $filename, 'public');

        // Add the public URL of the uploaded image to the data array for storage
        $data['url'] = url(Storage::url($path));

        // Create a new image in the database with the provided data and return a success response
        return GeneralHelper::response(
            __('messages.image_created_success'),
            new ImageResource(Image::create($data)),
            201
        );
    }

    /**
     * Delete a image from the database.
     * This function searches for a image by its id, validates its existence,
     * and then deletes it from the database. It returns a JSON response indicating the result of the operation.
     *
     * @param string $id The unique id of the image to be deleted.
     *
     * @return JsonResponse Returns a JSON response with a success message upon deletion.
     */
    public function destroy($id): JsonResponse
    {
        // Search for the image in the database using its id
        $image = $this->imagesRepository->findById($id);

        // Delete the image from the database
        $image->delete();

        // Return a success response indicating the image was deleted
        return GeneralHelper::response(
            __('messages.image_destroyed_success'),
            [],
            201
        );
    }

}