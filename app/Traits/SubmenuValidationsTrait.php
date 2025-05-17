<?php

namespace App\Traits;

use App\Models\Submenu;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;

trait SubmenuValidationsTrait
{
    /**
     * Check if a submenu exists.
     *
     * This method verifies whether the provided submenu instance exists.
     * If the submenu is null, it returns a response indicating that the submenu was not found.
     *
     * @param Submenu|null $submenu The submenu instance to check for existence.
     *
     * @return JsonResponse|null Returns a JSON response indicating the result, or null if the submenu exists.
     */
    protected function existsSubmenu(?Submenu $submenu): ?JsonResponse {
        if (!$submenu) {
            return GeneralHelper::response(
                __('messages.submenu_not_found'),
                [],
                404
            );
        }

        return null;
    }

    /**
     * Check if a submenu has stock.
     *
     * This method checks the stock level of the provided submenu.
     * If the submenu's stock is less than one, it returns a response indicating that the submenu is out of stock.
     *
     * @param Submenu $submenu The submenu instance to check for stock availability.
     *
     * @return JsonResponse|null Returns a JSON response indicating stock status, or null if the submenu has stock.
     */
    protected function checkStock(Submenu $submenu): ?JsonResponse {
        if ($submenu->stock < 1) {
            return GeneralHelper::response(
                __('messages.submenu_without_stock'),
                [],
                409
            );
        }

        return null;
    }
}