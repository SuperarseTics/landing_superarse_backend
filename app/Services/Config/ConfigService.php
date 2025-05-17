<?php

namespace App\Services\Config;

use App\Models\Configuration;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\ConfigResource;
use App\Http\Resources\ConfigLandingResource;
use App\Repositories\ConfigRepository;
use App\Traits\ConfigValidationsTrait;
use App\Http\Requests\Config\AddRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Config\StoreRequest;
use App\Http\Requests\Config\UpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ConfigService
{
    use ConfigValidationsTrait;

    protected $configRepository;

    public function __construct(ConfigRepository $configRepository) {
        $this->configRepository = $configRepository;
    }

    /**
     * Display a list config.
     *
     * @return JsonResponse Returns a JSON response containing the config data.
     */
    public function show(): JsonResponse
    {
        // Search for the config in the database by its code
        $config = $this->configRepository->getConfig()->get();

        // Return a successful JSON response with the config data
        return GeneralHelper::response(
            null,
            ConfigResource::collection($config),
            201
        );
    }

    /**
     * Update an existing config in the database.
     * This function updates the details of an existing config.
     * It processes the incoming request, validates the config's existence, and updates the config's data in the database.
     *
     * @param UpdateRequest $request The request containing the config's updated data.
     *
     * @return JsonResponse Returns a JSON response with the updated config data and a success message.
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        // Capture all data from the request into an array
        $data = $request->toArray();

        // Search for the config in the database by its ID
        $config = $this->configRepository->findById($data['id']);

        // Validate if the config exists
        $this->existsConfig($config);

        if ($config) {
            $data['name']   = $data['name'];
            $data['information'] = json_encode($request['information']);
        }

        // Update the config's details in the database with the provided data
        $config->update($data);

        // Return a success response with the updated config data
        return GeneralHelper::response(
            __('messages.config_updated_success'),
            new ConfigResource($config),
            201
        );
    }

    /**
     * Store a new config in the database.
     * This function handles storing a new config by processing the incoming request.
     *
     * @param AddRequest $request The request containing the config's data.
     *
     * @return JsonResponse Returns a JSON response with the newly created config data and a success message.
     */
    public function add(AddRequest $request): JsonResponse
    {
        // Capture all data from the request into an array
        $data = $request->toArray();

        $config = $this->configRepository->addConfig($request);

        // Create a new config in the database with the provided data and return a success response
        return GeneralHelper::response(
            __('messages.config_created_success'),
            new ConfigResource($config),
            201
        );
    }

    /**
     * Delete a config from the database.
     * This function searches for a config by its code, validates its existence,
     * and then deletes it from the database. It returns a JSON response indicating the result of the operation.
     *
     * @param string $code The unique code of the config to be deleted.
     *
     * @return JsonResponse Returns a JSON response with a success message upon deletion.
     */
    public function destroy($id): JsonResponse
    {
        // Search for the config in the database using its code
        $config = $this->configRepository->findById($id);

        // Validate if the config exists
        $this->existsConfig($config);

        // Delete the config from the database
        $config->delete();

        // Return a success response indicating the config was deleted
        return GeneralHelper::response(
            __('messages.config_destroyed_success'),
            [],
            201
        );
    }

}