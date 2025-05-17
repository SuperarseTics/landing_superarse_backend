<?php

namespace App\Services\Menu;

use App\Models\Menu;
use App\Models\Configuration;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\MenuResource;
use App\Http\Resources\MenuLandingResource;
use App\Repositories\MenuRepository;
use App\Traits\MenuValidationsTrait;
use App\Http\Requests\Menu\AddRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Menu\StoreRequest;
use App\Http\Requests\Menu\UpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class MenuService
{
    use MenuValidationsTrait;

    protected $menuRepository;

    public function __construct(MenuRepository $menuRepository) {
        $this->menuRepository = $menuRepository;
    }

    /**
     * Display a list menu.
     *
     * @return JsonResponse Returns a JSON response containing the menu data.
     */
    public function showAll(): JsonResponse
    {
        // Search for the menu in the database by its code
        $menu = $this->menuRepository->getMenu()->get();
        $properties = json_decode(Configuration::where('name', 'Menu')->first()->information);

        // Return a successful JSON response with the menu data
        return GeneralHelper::response(
            null,
            MenuLandingResource::collection($menu),
            201,
            [$properties]
        );
    }

    /**
     * Display a list menu.
     *
     * @return JsonResponse Returns a JSON response containing the menu data.
     */
    public function show(): JsonResponse
    {
        // Search for the menu in the database by its code
        $menu = $this->menuRepository->getMenu()->get();

        // Return a successful JSON response with the menu data
        return GeneralHelper::response(
            null,
            MenuResource::collection($menu),
            201
        );
    }

    /**
     * Store a new menu in the database.
     * This function handles storing a new menu by processing the incoming request.
     *
     * @param AddRequest $request The request containing the menu's data.
     *
     * @return JsonResponse Returns a JSON response with the newly created menu data and a success message.
     */
    public function add(AddRequest $request): JsonResponse
    {
        // Capture all data from the request into an array
        $data = $request->toArray();

        $limit = json_decode(Configuration::where('name', 'Menu')->first()->information)->limit;
        $menuActive = $this->menuRepository->getMenuActive()->get();
        $active = 1;
        if ($menuActive->count() >= $limit) {
            $active = 0;
        }
        $menu = $this->menuRepository->addMenu($data['name'], $active);

        return GeneralHelper::response(
            __('messages.menu_created_success'),
            new MenuResource($menu),
            201
        );
    }

    /**
     * Update an existing menu in the database.
     * This function updates the details of an existing menu.
     * It processes the incoming request, validates the menu's existence, and updates the menu's data in the database.
     *
     * @param UpdateRequest $request The request containing the menu's updated data.
     *
     * @return JsonResponse Returns a JSON response with the updated menu data and a success message.
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        // Capture all data from the request into an array
        $data = $request->toArray();

        // Search for the menu in the database by its ID
        $menu = $this->menuRepository->findById($data['id']);

        if ($data['active']) {
            $limit = json_decode(Configuration::where('name', 'Menu')->first()->information)->limit;
            $menuActive = $this->menuRepository->getMenuActive()->get();
            
            if ($menuActive->count() >= $limit) {
                return GeneralHelper::response(
                    __('messages.menu_limit_error'),
                    [],
                    400
                );
            }
        }

        // Validate if the menu exists
        $this->existsMenu($menu);

        if ($menu) {
            $data['name']   = $data['name'];
            $data['active'] = $data['active'];
        }

        // Update the menu's details in the database with the provided data
        $menu->update($data);

        // Return a success response with the updated menu data
        return GeneralHelper::response(
            __('messages.menu_updated_success'),
            new MenuResource($menu),
            201
        );
    }

    /**
     * Delete a menu from the database.
     * This function searches for a menu by its id, validates its existence,
     * and then deletes it from the database. It returns a JSON response indicating the result of the operation.
     *
     * @param string $id The unique id of the menu to be deleted.
     *
     * @return JsonResponse Returns a JSON response with a success message upon deletion.
     */
    public function destroy($id): JsonResponse
    {
        // Search for the menu in the database using its id
        $menu = $this->menuRepository->findById($id);

        // Validate if the menu exists
        $this->existsMenu($menu);

        // Delete the menu from the database
        $menu->delete();

        // Return a success response indicating the menu was deleted
        return GeneralHelper::response(
            __('messages.menu_destroyed_success'),
            [],
            201
        );
    }
}