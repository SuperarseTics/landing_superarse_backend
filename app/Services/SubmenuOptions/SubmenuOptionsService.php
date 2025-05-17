<?php

namespace App\Services\SubmenuOptions;

use App\Models\SubmenuOptions;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\SubmenuOptionResource;
use App\Repositories\SubmenuOptionsRepository;
use App\Traits\SubmenuOptionsValidationsTrait;
use App\Http\Requests\SubmenuOptions\AddRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\SubmenuOptions\StoreRequest;
use App\Http\Requests\SubmenuOptions\UpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SubmenuOptionsService
{
    use SubmenuOptionsValidationsTrait;

    protected $submenuOptionsRepository;

    public function __construct(SubmenuOptionsRepository $submenuOptionsRepository) {
        $this->submenuOptionsRepository = $submenuOptionsRepository;
    }

    /**
     * Display a list menu.
     *
     * @return JsonResponse Returns a JSON response containing the submenuOptions data.
     */
    public function show(): JsonResponse
    {
        // Search for the submenuOptions in the database by its code
        $submenuOptions = $this->submenuOptionsRepository->getSubmenuOptions()->get();
        // dd($submenuOptions);

        // Validate if the submenuOptions exists, throw an error if it does not
        // $this->existsSubmenuOptions($submenuOptions);

        // Return a successful JSON response with the submenuOptions data
        return GeneralHelper::response(
            null,
            SubmenuOptionResource::collection($submenuOptions),
            201
        );
    }

    /**
     * Store a new submenuOptions in the database.
     * This function handles storing a new submenuOptions by processing the incoming request.
     *
     * @param AddRequest $request The request containing the menu's data.
     *
     * @return JsonResponse Returns a JSON response with the newly created submenuOptions data and a success message.
     */
    public function add(AddRequest $request): JsonResponse
    {

        // Capture all data from the request into an array
        $data = $request->toArray();

        $submenuOptions = $this->submenuOptionsRepository->addSubmenuOptions($data);

        return GeneralHelper::response(
            __('messages.submenuOptions_created_success'),
            new SubmenuOptionResource($submenuOptions),
            201
        );
    }

    /**
     * Update an existing submenuOptions in the database.
     * This function updates the details of an existing menu.
     * It processes the incoming request, validates the menu's existence, and updates the menu's data in the database.
     *
     * @param UpdateRequest $request The request containing the menu's updated data.
     *
     * @return JsonResponse Returns a JSON response with the updated submenuOptions data and a success message.
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        // Capture all data from the request into an array
        $data = $request->toArray();

        // Search for the submenuOptions in the database by its ID
        $submenuOptions = $this->submenuOptionsRepository->findById($data['id']);

        // Validate if the submenuOptions exists
        $this->existsSubmenuOptions($submenuOptions);

        if ($submenuOptions) {
            $data['submenus_id']   = $data['submenus_id'];
            $data['name']       = $data['name'];
            $data['active']     = $data['active'];
        }

        // Update the menu's details in the database with the provided data
        $submenuOptions->update($data);

        // Return a success response with the updated submenuOptions data
        return GeneralHelper::response(
            __('messages.submenuOptions_updated_success'),
            new SubmenuOptionResource($submenuOptions),
            201
        );
    }

    /**
     * Delete a submenuOptions from the database.
     * This function searches for a submenuOptions by its code, validates its existence,
     * and then deletes it from the database. It returns a JSON response indicating the result of the operation.
     *
     * @param string $code The unique code of the submenuOptions to be deleted.
     *
     * @return JsonResponse Returns a JSON response with a success message upon deletion.
     */
    public function destroy($id): JsonResponse
    {
        // Search for the submenuOptions in the database using its code
        $submenuOptions = $this->submenuOptionsRepository->findById($id);

        // Validate if the submenuOptions exists
        $this->existsSubmenuOptions($submenuOptions);

        // Delete the submenuOptions from the database
        $submenuOptions->delete();

        // Return a success response indicating the submenuOptions was deleted
        return GeneralHelper::response(
            __('messages.submenuOptions_destroyed_success'),
            [],
            201
        );
    }
}