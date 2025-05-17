<?php

namespace App\Traits;

use App\Models\Page;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;

trait PageValidationsTrait
{
    /**
     * Check if a page exists.
     *
     * This method verifies whether the provided page instance exists.
     * If the page is null, it returns a response indicating that the page was not found.
     *
     * @param Page|null $page The page instance to check for existence.
     *
     * @return JsonResponse|null Returns a JSON response indicating the result, or null if the page exists.
     */
    protected function existsPage(?Page $page): ?JsonResponse {
        if (!$page) {
            return GeneralHelper::response(
                __('messages.page_not_found'),
                [],
                404
            );
        }

        return null;
    }

}