<?php

namespace App\Traits;

use App\Models\Section;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;

trait SectionValidationsTrait
{
    /**
     * Check if a section exists.
     *
     * This method verifies whether the provided section instance exists.
     * If the section is null, it returns a response indicating that the section was not found.
     *
     * @param Section|null $section The section instance to check for existence.
     *
     * @return JsonResponse|null Returns a JSON response indicating the result, or null if the section exists.
     */
    protected function existsSection(?Section $section): ?JsonResponse {
        if (!$section) {
            return GeneralHelper::response(
                __('messages.section_not_found'),
                [],
                404
            );
        }

        return null;
    }

}