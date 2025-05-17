<?php

namespace App\Repositories;

use App\Models\Section;

class SectionRepository
{
    protected $section;

    public function __construct(Section $section) {
        $this->section = $section;
    }

    /**
     * List all sections.
     *
     * This method retrieves a distinct list of authors from the active sections in the database.
     *
     * @return array An array of unique authors from active sections.
     */
    public function getSection() {
        return $this->section::all();
    }

    /**
     * Add new section.
     *
     * This method retrieves a distinct list of authors from the active sections in the database.
     *
     * @return array An array of unique authors from active sections.
     */
    public function addSection($request) {
        return $this->section::create([
            'pages_id'      => $request['pages_id'],
            'widgets_id'    => $request['widgets_id'],
            'name'          => $request['name'],
            'properties'    => json_encode($request['properties']),
            'data'          => json_encode($request['data'])
        ]);
    }

    /**
     * Find a  section by its ID.
     *
     * This method retrieves a  section from the database using its unique identifier.
     *
     * @param int $id The ID of the  section to find.
     *
     * @return null| Section Returns the  section model if found, null otherwise.
     */
    public function findById(int $id): ? Section {
        return $this-> section::find($id);
    }

}
