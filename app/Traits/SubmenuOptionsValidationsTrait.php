<?php

namespace App\Traits;

use App\Models\SubmenuOptions;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;

trait SubmenuOptionsValidationsTrait
{
    /**
     * Check if a submenuOptions exists.
     *
     * This method verifies whether the provided submenuOptions instance exists.
     * If the submenuOptions is null, it returns a response indicating that the submenuOptions was not found.
     *
     * @param SubmenuOptions|null $submenuOptions The submenuOptions instance to check for existence.
     *
     * @return JsonResponse|null Returns a JSON response indicating the result, or null if the submenuOptions exists.
     */
    protected function existsSubmenuOptions(?SubmenuOptions $submenuOptions): ?JsonResponse {
        if (!$submenuOptions) {
            return GeneralHelper::response(
                __('messages.submenuOptions_not_found'),
                [],
                404
            );
        }

        return null;
    }

}