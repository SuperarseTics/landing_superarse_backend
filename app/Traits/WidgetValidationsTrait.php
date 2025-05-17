<?php

namespace App\Traits;

use App\Models\Widget;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;

trait WidgetValidationsTrait
{
    /**
     * Check if a widget exists.
     *
     * This method verifies whether the provided widget instance exists.
     * If the widget is null, it returns a response indicating that the widget was not found.
     *
     * @param Widget|null $widget The widget instance to check for existence.
     *
     * @return JsonResponse|null Returns a JSON response indicating the result, or null if the widget exists.
     */
    protected function existsWidget(?Widget $widget): ?JsonResponse {
        if (!$widget) {
            return GeneralHelper::response(
                __('messages.widget_not_found'),
                [],
                404
            );
        }

        return null;
    }

}