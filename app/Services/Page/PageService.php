<?php

namespace App\Services\Page;

use App\Models\Page;
use App\Models\Configuration;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\PageResource;
use App\Http\Resources\PageLandingResource;
use App\Repositories\PageRepository;
use App\Traits\PageValidationsTrait;
use App\Http\Requests\Page\AddRequest;
use App\Http\Requests\Page\UpdateRequest;

class PageService
{
    use PageValidationsTrait;

    protected $pageRepository;

    public function __construct(PageRepository $pageRepository) {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Display a list page.
     *
     * @return JsonResponse Returns a JSON response containing the page data.
     */
    public function showAll($id): JsonResponse
    {
        // Search for the page in the database by its code
        $page = $this->pageRepository->findById($id);

        // Return a successful JSON response with the page data
        return GeneralHelper::response(
            null,
            new PageLandingResource($page),
            201
        );
    }

    /**
     * Display a list page.
     *
     * @return JsonResponse Returns a JSON response containing the page data.
     */
    public function show(): JsonResponse
    {
        // Search for the page in the database by its code
        $page = $this->pageRepository->getPage()->get();

        // Return a successful JSON response with the page data
        return GeneralHelper::response(
            null,
            PageResource::collection($page),
            201
        );
    }

    /**
     * Store a new page in the database.
     * This function handles storing a new page by processing the incoming request.
     *
     * @param AddRequest $request The request containing the page's data.
     *
     * @return JsonResponse Returns a JSON response with the newly created page data and a success message.
     */
    public function add(AddRequest $request): JsonResponse
    {
        // Capture all data from the request into an array
        $data = $request->toArray();

        if ($this->pageRepository->findByOptionId($data['options_id'])) {
            return GeneralHelper::response(
                __('messages.page_not_created'),
                [],
                404
            );
        }
        $page = $this->pageRepository->addPage($data);

        // Validate if the page exists, throw an error if it does not
        $this->existsPage($page);

        return GeneralHelper::response(
            __('messages.page_created_success'),
            new PageResource($page),
            201
        );
    }

    /**
     * Update an existing page in the database.
     * This function updates the details of an existing page.
     * It processes the incoming request, validates the page's existence, and updates the page's data in the database.
     *
     * @param UpdateRequest $request The request containing the page's updated data.
     *
     * @return JsonResponse Returns a JSON response with the updated page data and a success message.
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        // Capture all data from the request into an array
        $data = $request->toArray();

        // Search for the page in the database by its ID
        $page = $this->pageRepository->findById($data['id']);

        // Validate if the page exists
        $this->existsPage($page);

        if ($page) {
            $data['options_id'] = $data['options_id'];
            $data['name']       = $data['name'];
            $data['ruta']       = $data['ruta'];
            $data['properties'] = json_encode($request['properties']);
        }

        // Update the page's details in the database with the provided data
        $page->update($data);

        // Return a success response with the updated page data
        return GeneralHelper::response(
            __('messages.page_updated_success'),
            new PageResource($page),
            201
        );
    }

    /**
     * Delete a page from the database.
     * This function searches for a page by its id, validates its existence,
     * and then deletes it from the database. It returns a JSON response indicating the result of the operation.
     *
     * @param string $id The unique id of the page to be deleted.
     *
     * @return JsonResponse Returns a JSON response with a success message upon deletion.
     */
    public function destroy($id): JsonResponse
    {
        // Search for the page in the database using its id
        $page = $this->pageRepository->findById($id);

        // Validate if the page exists
        $this->existsPage($page);

        // Delete the page from the database
        $page->delete();

        // Return a success response indicating the page was deleted
        return GeneralHelper::response(
            __('messages.page_destroyed_success'),
            [],
            201
        );
    }
}