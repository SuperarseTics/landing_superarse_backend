<?php

namespace App\Repositories;

use App\Models\SubmenuOptions;

class SubmenuOptionsRepository
{
    protected $submenuOptions;

    public function __construct(SubmenuOptions $submenuOptions) {
        $this->submenuOptions = $submenuOptions;
    }

    /**
     * List all menus.
     *
     * This method retrieves a distinct list of authors from the active menus in the database.
     *
     * @return array An array of unique authors from active menus.
     */
    public function getSubmenuOptions() {
        return $this->submenuOptions::active();
    }

    /**
     * Add new submenuOptions.
     *
     * This method retrieves a distinct list of authors from the active menus in the database.
     *
     * @return array An array of unique authors from active menus.
     */
    public function addSubmenuOptions($request) {
        return $this->submenuOptions::create([
            'name'      => $request['name'],
            'submenus_id'  => $request['submenus_id']
        ]);
    }

    /**
     * Find a submenuOptions by its ID.
     *
     * This method retrieves a submenuOptions from the database using its unique identifier.
     *
     * @param int $id The ID of the submenuOptions to find.
     *
     * @return null|SubmenuOptions Returns the submenuOptions model if found, null otherwise.
     */
    public function findById(int $id): ?SubmenuOptions {
        return $this->submenuOptions::find($id);
    }

}
