<?php

namespace App\Services\Widget;

use App\Models\Widget;
use App\Models\Configuration;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\WidgetResource;
use App\Http\Resources\WidgetLandingResource;
use App\Repositories\WidgetRepository;
use App\Traits\WidgetValidationsTrait;
use App\Http\Requests\Widget\AddRequest;
use App\Http\Requests\Widget\UpdateRequest;

class WidgetService
{
    use WidgetValidationsTrait;

    protected $widgetRepository;

    public function __construct(WidgetRepository $widgetRepository) {
        $this->widgetRepository = $widgetRepository;
    }

    /**
     * Display a list widget.
     *
     * @return JsonResponse Returns a JSON response containing the widget data.
     */
    public function showAll(): JsonResponse
    {
        // Search for the widget in the database by its code
        $widget = $this->widgetRepository->getWidget()->get();

        // Return a successful JSON response with the widget data
        return GeneralHelper::response(
            null,
            WidgetLandingResource::collection($widget),
            201,
            [$properties]
        );
    }

    /**
     * Display a list widget.
     *
     * @return JsonResponse Returns a JSON response containing the widget data.
     */
    public function show(): JsonResponse
    {
        // Search for the widget in the database by its code
        $widget = $this->widgetRepository->getWidget()->get();

        // Return a successful JSON response with the widget data
        return GeneralHelper::response(
            null,
            WidgetResource::collection($widget),
            201
        );
    }

    /**
     * Store a new widget in the database.
     * This function handles storing a new widget by processing the incoming request.
     *
     * @param AddRequest $request The request containing the widget's data.
     *
     * @return JsonResponse Returns a JSON response with the newly created widget data and a success message.
     */
    public function add(AddRequest $request): JsonResponse
    {
        // Capture all data from the request into an array
        $data = $request->toArray();

        // if ($this->widgetRepository->findByOptionId($data['options_id'])) {
        //     return GeneralHelper::response(
        //         __('messages.widget_not_created'),
        //         [],
        //         404
        //     );
        // }
        $widget = $this->widgetRepository->addWidget($data);

        // Validate if the widget exists, throw an error if it does not
        $this->existsWidget($widget);

        return GeneralHelper::response(
            __('messages.widget_created_success'),
            new WidgetResource($widget),
            201
        );
    }

    /**
     * Update an existing widget in the database.
     * This function updates the details of an existing widget.
     * It processes the incoming request, validates the widget's existence, and updates the widget's data in the database.
     *
     * @param UpdateRequest $request The request containing the widget's updated data.
     *
     * @return JsonResponse Returns a JSON response with the updated widget data and a success message.
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        // Capture all data from the request into an array
        $data = $request->toArray();

        // Search for the widget in the database by its ID
        $widget = $this->widgetRepository->findById($data['id']);

        // Validate if the widget exists
        $this->existsWidget($widget);

        if ($widget) {
            $data['name']       = $data['name'];
            $data['properties'] = json_encode($request['properties']);
        }

        // Update the widget's details in the database with the provided data
        $widget->update($data);

        // Return a success response with the updated widget data
        return GeneralHelper::response(
            __('messages.widget_updated_success'),
            new WidgetResource($widget),
            201
        );
    }

    /**
     * Delete a widget from the database.
     * This function searches for a widget by its id, validates its existence,
     * and then deletes it from the database. It returns a JSON response indicating the result of the operation.
     *
     * @param string $id The unique id of the widget to be deleted.
     *
     * @return JsonResponse Returns a JSON response with a success message upon deletion.
     */
    public function destroy($id): JsonResponse
    {
        // Search for the widget in the database using its id
        $widget = $this->widgetRepository->findById($id);

        // Validate if the widget exists
        $this->existsWidget($widget);

        // Delete the widget from the database
        $widget->delete();

        // Return a success response indicating the widget was deleted
        return GeneralHelper::response(
            __('messages.widget_destroyed_success'),
            [],
            201
        );
    }
}