<?php

namespace App\Services\Submenu;

use App\Models\Submenu;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\SubmenuResource;
use App\Repositories\SubmenuRepository;
use App\Traits\SubmenuValidationsTrait;
use App\Http\Requests\Submenu\AddRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Submenu\StoreRequest;
use App\Http\Requests\Submenu\UpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SubmenuService
{
    use SubmenuValidationsTrait;

    protected $submenuRepository;

    public function __construct(SubmenuRepository $submenuRepository) {
        $this->submenuRepository = $submenuRepository;
    }

    /**
     * Display a list menu.
     *
     * @return JsonResponse Returns a JSON response containing the submenu data.
     */
    public function show(): JsonResponse
    {
        // Search for the submenu in the database by its code
        $submenu = $this->submenuRepository->getSubmenu()->get();

        // Validate if the submenu exists, throw an error if it does not
        // $this->existsSubmenu($submenu);

        // Return a successful JSON response with the submenu data
        return GeneralHelper::response(
            null,
            SubmenuResource::collection($submenu),
            201
        );
    }

    /**
     * Store a new submenu in the database.
     * This function handles storing a new submenu by processing the incoming request.
     *
     * @param AddRequest $request The request containing the menu's data.
     *
     * @return JsonResponse Returns a JSON response with the newly created submenu data and a success message.
     */
    public function add(AddRequest $request): JsonResponse
    {

        // Capture all data from the request into an array
        $data = $request->toArray();

        $submenu = $this->submenuRepository->addSubmenu($data);

        return GeneralHelper::response(
            __('messages.submenu_created_success'),
            new SubmenuResource($data),
            201
        );
    }

    /**
     * Update an existing submenu in the database.
     * This function updates the details of an existing menu.
     * It processes the incoming request, validates the menu's existence, and updates the menu's data in the database.
     *
     * @param UpdateRequest $request The request containing the menu's updated data.
     *
     * @return JsonResponse Returns a JSON response with the updated submenu data and a success message.
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        // Capture all data from the request into an array
        $data = $request->toArray();

        // Search for the submenu in the database by its ID
        $submenu = $this->submenuRepository->findById($data['id']);

        // Validate if the submenu exists
        $this->existsSubmenu($submenu);

        if ($submenu) {
            $data['menus_id']   = $data['menus_id'];
            $data['name']       = $data['name'];
            $data['active']     = $data['active'];
        }

        // Update the menu's details in the database with the provided data
        $submenu->update($data);

        // Return a success response with the updated submenu data
        return GeneralHelper::response(
            __('messages.submenu_updated_success'),
            new SubmenuResource($submenu),
            201
        );
    }

    /**
     * Delete a submenu from the database.
     * This function searches for a submenu by its code, validates its existence,
     * and then deletes it from the database. It returns a JSON response indicating the result of the operation.
     *
     * @param string $code The unique code of the submenu to be deleted.
     *
     * @return JsonResponse Returns a JSON response with a success message upon deletion.
     */
    public function destroy($id): JsonResponse
    {
        // Search for the submenu in the database using its code
        $submenu = $this->submenuRepository->findById($id);

        // Validate if the submenu exists
        $this->existsSubmenu($submenu);

        // Delete the submenu from the database
        $submenu->delete();

        // Return a success response indicating the submenu was deleted
        return GeneralHelper::response(
            __('messages.submenu_destroyed_success'),
            [],
            201
        );
    }
}