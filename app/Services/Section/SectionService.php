<?php

namespace App\Services\Section;

use App\Models\Section;
use App\Models\Configuration;
use App\Helpers\GeneralHelper;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\SectionResource;
use App\Http\Resources\SectionLandingResource;
use App\Repositories\SectionRepository;
use App\Traits\SectionValidationsTrait;
use App\Http\Requests\Section\AddRequest;
use App\Http\Requests\Section\UpdateRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SectionService
{
    use SectionValidationsTrait;

    protected $sectionRepository;

    public function __construct(SectionRepository $sectionRepository) {
        $this->sectionRepository = $sectionRepository;
    }

    /**
     * Display a specific section by its code.
     * This function searches for a section in the database by its unique code, validates
     * if the section exists, and returns the section data in a JSON response.
     *
     *
     * @return JsonResponse Returns a JSON response containing the section data or an error message if not found.
     */
    public function showAll(): JsonResponse
    {
        // Search for the section in the database by its code
        $section = $this->sectionRepository->getSection()->get();

        // Validate if the section exists, throw an error if it does not
        // $this->existsSection($section);

        // Return a successful JSON response with the section data
        return GeneralHelper::response(
            null,
            SectionLandingResource::collection($section),
            201
        );
    }

    /**
     * Display a specific section by its code.
     * This function searches for a section in the database by its unique code, validates
     * if the section exists, and returns the section data in a JSON response.
     *
     *
     * @return JsonResponse Returns a JSON response containing the section data or an error message if not found.
     */
    public function show(): JsonResponse
    {
        // Search for the section in the database by its code
        $section = $this->sectionRepository->getSection();

        // Return a successful JSON response with the section data
        return GeneralHelper::response(
            null,
            SectionResource::collection($section),
            201
        );
    }

    /**
     * Store a new section in the database.
     * This function handles storing a new section by processing the incoming request, uploading the section's cover image,
     * saving the file with its original name in the specified folder, and storing the section's data in the database.
     *
     * @param AddRequest $request The request containing the section's data, including the cover image file.
     *
     * @return JsonResponse Returns a JSON response with the newly created section data and a success message.
     */
    public function add(AddRequest $request): JsonResponse
    {

        // Capture all data from the request into an array
        $data = $request->toArray();

        $section = $this->sectionRepository->addSection($request);

        // Create a new section in the database with the provided data and return a success response
        return GeneralHelper::response(
            __('messages.section_created_success'),
            new SectionResource($section),
            201
        );
    }

    /**
     * Update an existing section in the database.
     * This function updates the details of an existing section, including the option to update the section's cover image.
     * It processes the incoming request, validates the section's existence, optionally uploads a new cover image,
     * and updates the section's data in the database.
     *
     * @param UpdateRequest $request The request containing the section's updated data, including an optional new cover image.
     *
     * @return JsonResponse Returns a JSON response with the updated section data and a success message.
     */
    public function update(UpdateRequest $request): JsonResponse
    {
        // Capture all data from the request into an array
        $data = $request->toArray();

        // Search for the section in the database by its ID
        $section = $this->sectionRepository->findById($data['id']);

        // Validate if the section exists
        $this->existsSection($section);

        if ($section) {
            $data['pages_id']   = $data['pages_id'];
            $data['widgets_id'] = $data['widgets_id'];
            $data['name']       = $data['name'];
            $data['properties'] = json_encode($request['properties']);
            $data['data']       = json_encode($request['data']);
        }

        // Update the section's details in the database with the provided data
        $section->update($data);

        // Return a success response with the updated section data
        return GeneralHelper::response(
            __('messages.section_updated_success'),
            new SectionResource($section),
            201
        );
    }

    /**
     * Delete a section from the database.
     * This function searches for a section by its code, validates its existence,
     * and then deletes it from the database. It returns a JSON response indicating the result of the operation.
     *
     * @param string $code The unique code of the section to be deleted.
     *
     * @return JsonResponse Returns a JSON response with a success message upon deletion.
     */
    public function destroy($id): JsonResponse
    {
        // Search for the section in the database using its code
        $section = $this->sectionRepository->findById($id);

        // Validate if the section exists
        $this->existsSection($section);

        // Delete the section from the database
        $section->delete();

        // Return a success response indicating the section was deleted
        return GeneralHelper::response(
            __('messages.section_destroyed_success'),
            [],
            201
        );
    }
}