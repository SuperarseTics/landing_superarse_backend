<?php

namespace App\Repositories;

use App\Models\MenuHeader;

class MenuHeaderRepository
{
    protected $menuHeader;

    public function __construct(MenuHeader $menuHeader) {
        $this->menuHeader = $menuHeader;
    }

    /**
     * List all menus.
     *
     * This method retrieves a distinct list of authors from the active menus in the database.
     *
     * @return array An array of unique authors from active menus.
     */
    public function getMenuHeader() {
        return $this->menuHeader;
    }

    /**
     * List all menus.
     *
     * This method retrieves a distinct list of authors from the active menus in the database.
     *
     * @return array An array of unique authors from active menus.
     */
    public function getMenuHeaderActive() {
        return $this->menuHeader::active();
    }

    /**
     * Add new menuHeader.
     *
     * This method retrieves a distinct list of authors from the active menus in the database.
     *
     * @return array An array of unique authors from active menus.
     */
    public function addMenuHeader(string $name, $active) {
        return $this->menuHeader::create([
            'name'  => $name,
            'active' => $active
        ]);
    }

    /**
     * Find a menuHeaderby its ID.
     *
     * This method retrieves a menuHeaderfrom the database using its unique identifier.
     *
     * @param int $id The ID of the menuHeaderto find.
     *
     * @return null|Menu Returns the menuHeadermodel if found, null otherwise.
     */
    public function findById(int $id): ?MenuHeader {
        return $this->menuHeader::find($id);
    }

}
