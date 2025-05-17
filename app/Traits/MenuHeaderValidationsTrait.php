<?php

namespace App\Traits;

use App\Models\MenuHeader;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;

trait MenuHeaderValidationsTrait
{
    /**
     * Check if a menuHeader exists.
     *
     * This method verifies whether the provided menuHeader instance exists.
     * If the menuHeader is null, it returns a response indicating that the menuHeader was not found.
     *
     * @param MenuHeader|null $menuHeader The menuHeader instance to check for existence.
     *
     * @return JsonResponse|null Returns a JSON response indicating the result, or null if the menuHeader exists.
     */
    protected function existsMenuHeader(?MenuHeader $menuHeader): ?JsonResponse {
        if (!$menuHeader) {
            return GeneralHelper::response(
                __('messages.menuHeader_not_found'),
                [],
                404
            );
        }

        return null;
    }

    /**
     * Check if a menuHeader has stock.
     *
     * This method checks the stock level of the provided menuHeader.
     * If the menuHeader's stock is less than one, it returns a response indicating that the menuHeader is out of stock.
     *
     * @param MenuHeader $menuHeader The menuHeader instance to check for stock availability.
     *
     * @return JsonResponse|null Returns a JSON response indicating stock status, or null if the menuHeader has stock.
     */
    protected function checkStock(MenuHeader $menuHeader): ?JsonResponse {
        if ($menuHeader->stock < 1) {
            return GeneralHelper::response(
                __('messages.menuHeader_without_stock'),
                [],
                409
            );
        }

        return null;
    }
}