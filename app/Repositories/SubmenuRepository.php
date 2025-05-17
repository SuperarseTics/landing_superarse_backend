<?php

namespace App\Repositories;

use App\Models\Submenu;

class SubmenuRepository
{
    protected $submenu;

    public function __construct(Submenu $submenu) {
        $this->submenu = $submenu;
    }

    /**
     * List all menus.
     *
     * This method retrieves a distinct list of authors from the active menus in the database.
     *
     * @return array An array of unique authors from active menus.
     */
    public function getSubmenu() {
        return $this->submenu::active();
    }

    /**
     * Add new submenu.
     *
     * This method retrieves a distinct list of authors from the active menus in the database.
     *
     * @return array An array of unique authors from active menus.
     */
    public function addSubmenu($request) {
        return $this->submenu::create([
            'name'      => $request['name'],
            'menus_id'  => $request['menus_id']
        ]);
    }

    /**
     * Find a submenu by its ID.
     *
     * This method retrieves a submenu from the database using its unique identifier.
     *
     * @param int $id The ID of the submenu to find.
     *
     * @return null|Submenu Returns the submenu model if found, null otherwise.
     */
    public function findById(int $id): ?Submenu {
        return $this->submenu::find($id);
    }

}
