<?php

namespace App\Traits;

use App\Models\Menu;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;

trait MenuValidationsTrait
{
    /**
     * Check if a menu exists.
     *
     * This method verifies whether the provided menu instance exists.
     * If the menu is null, it returns a response indicating that the menu was not found.
     *
     * @param Menu|null $menu The menu instance to check for existence.
     *
     * @return JsonResponse|null Returns a JSON response indicating the result, or null if the menu exists.
     */
    protected function existsMenu(?Menu $menu): ?JsonResponse {
        if (!$menu) {
            return GeneralHelper::response(
                __('messages.menu_not_found'),
                [],
                404
            );
        }

        return null;
    }

    /**
     * Check if a menu has stock.
     *
     * This method checks the stock level of the provided menu.
     * If the menu's stock is less than one, it returns a response indicating that the menu is out of stock.
     *
     * @param Menu $menu The menu instance to check for stock availability.
     *
     * @return JsonResponse|null Returns a JSON response indicating stock status, or null if the menu has stock.
     */
    protected function checkStock(Menu $menu): ?JsonResponse {
        if ($menu->stock < 1) {
            return GeneralHelper::response(
                __('messages.menu_without_stock'),
                [],
                409
            );
        }

        return null;
    }
}