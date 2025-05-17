<?php

namespace App\Traits;

use App\Models\Configuration;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;

trait ConfigValidationsTrait
{
    /**
     * Check if a config exists.
     *
     * This method verifies whether the provided config instance exists.
     * If the config is null, it returns a response indicating that the config was not found.
     *
     * @param Configuration|null $config The config instance to check for existence.
     *
     * @return JsonResponse|null Returns a JSON response indicating the result, or null if the config exists.
     */
    protected function existsConfig(?Configuration $config): ?JsonResponse {
        if (!$config) {
            return GeneralHelper::response(
                __('messages.config_not_found'),
                [],
                404
            );
        }

        return null;
    }

}