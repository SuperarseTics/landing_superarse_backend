<?php

namespace App\Services\MenuHeader;

use App\Models\Menu;
use App\Models\Configuration;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\MenuHeaderResource;
use App\Http\Resources\MenuLandingResource;
use App\Repositories\MenuHeaderRepository;
use App\Traits\MenuHeaderValidationsTrait;
use App\Http\Requests\MenuHeader\AddRequest;
use App\Http\Requests\MenuHeader\UpdateRequest;

class MenuHeaderService
{
    use MenuHeaderValidationsTrait;

    protected $menuHeaderRepository;

    public function __construct(MenuHeaderRepository $menuHeaderRepository) {
        $this->menuHeaderRepository = $menuHeaderRepository;
    }

    /**
     * Display a list menu header.
     *
     * @return JsonResponse Returns a JSON response containing the menu header data.
     */
    public function showAll(): JsonResponse
    {
        // Search for the menu in the database by its code
        $menu = $this->menuHeaderRepository->getMenuHeader()->get();
        $properties = json_decode(Configuration::where('name', 'MenuHeader')->first()->information);

        // Validate if the menu exists, throw an error if it does not
        $this->existsMenuHeader($menu);

        // Return a successful JSON response with the menu data
        return GeneralHelper::response(
            null,
            MenuHeaderResource::collection($menu),
            201,
            [$properties]
        );
    }

    /**
     * Display a list menu header.
     *
     * @return JsonResponse Returns a JSON response containing the menu header data.
     */
    public function show(): JsonResponse
    {
        // Search for the menu header in the database by its code
        $menu = $this->menuHeaderRepository->getMenuHeader()->get();

        // Validate if the menu header exists, throw an error if it does not
        $this->existsMenuHeader($menu);

        return GeneralHelper::response(
            null,
            MenuHeaderResource::collection($menu),
            201
        );
    }

    /**
     * Store a new menu header in the database.
     * This function handles storing a new menu header by processing the incoming request.
     *
     * @param AddRequest $request The request containing the menu header's data.
     *
     * @return JsonResponse Returns a JSON response with the newly created menu header data and a success message.
     */
    public function add(AddRequest $request): JsonResponse
    {
        $data = $request->toArray();

        $limit = json_decode(Configuration::where('name', 'MenuHeader')->first()->information)->limit;
        $menuActive = $this->menuHeaderRepository->getMenuHeaderActive()->get();
        $active = 1;
        if ($menuActive->count() >= $limit) {
            $active = 0;
        }
        $menu = $this->menuHeaderRepository->addMenuHeader($data['name'], $active);

        return GeneralHelper::response(
            __('messages.menuHeader_created_success'),
            new MenuHeaderResource($menu),
            201
        );
    }

    /**
     * Update an existing menu header in the database.
     * This function updates the details of an existing menu header.
     * It processes the incoming request, validates the menu header's existence, and updates the menu header's data in the database.
     *
     * @param UpdateRequest $request The request containing the menu header's updated data.
     *
     * @return JsonResponse Returns a JSON response with the updated menu header data and a success message.
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        // Capture all data from the request into an array
        $data = $request->toArray();

        // Search for the menu header in the database by its ID
        $menu = $this->menuHeaderRepository->findById($data['id']);

        if ($data['active']) {
            $limit = json_decode(Configuration::where('name', 'MenuHeader')->first()->information)->limit;
            $menuActive = $this->menuHeaderRepository->getMenuHeaderActive()->get();
            $active = 1;
            if ($menuActive->count() >= $limit) {
                $active = 0;
            }
    
            if ($menuActive->count() >= $limit) {
                return GeneralHelper::response(
                    __('messages.menuHeader_limit_error'),
                    [],
                    400
                );
            }
        }

        // Validate if the menu header exists
        $this->existsMenuHeader($menu);

        if ($menu) {
            $data['name']   = $data['name'];
            $data['active'] = $data['active'];
        }

        // Update the menu header's details in the database with the provided data
        $menu->update($data);

        // Return a success response with the updated menu header data
        return GeneralHelper::response(
            __('messages.menuHeader_updated_success'),
            new MenuHeaderResource($menu),
            201
        );
    }

    /**
     * Delete a menu header from the database.
     * This function searches for a menu header by its id, validates its existence,
     * and then deletes it from the database. It returns a JSON response indicating the result of the operation.
     *
     * @param string $id The unique id of the menu header to be deleted.
     *
     * @return JsonResponse Returns a JSON response with a success message upon deletion.
     */
    public function destroy($id): JsonResponse
    {
        // Search for the menu header in the database using its code
        $menu = $this->menuHeaderRepository->findById($id);

        // Validate if the menu header exists
        $this->existsMenuHeader($menu);

        // Delete the menu header from the database
        $menu->delete();

        // Return a success response indicating the menu header was deleted
        return GeneralHelper::response(
            __('messages.menuHeader_destroyed_success'),
            [],
            201
        );
    }
}