<?php

namespace App\Repositories;

use App\Models\Menu;

class MenuRepository
{
    protected $menu;

    public function __construct(Menu $menu) {
        $this->menu = $menu;
    }

    /**
     * List all menus.
     *
     * This method retrieves a distinct list of authors from the active menus in the database.
     *
     * @return array An array of unique authors from active menus.
     */
    public function getMenu() {
        return $this->menu;
    }

    /**
     * List all menus.
     *
     * This method retrieves a distinct list of authors from the active menus in the database.
     *
     * @return array An array of unique authors from active menus.
     */
    public function getMenuActive() {
        return $this->menu::active();
    }

    /**
     * Add new menu.
     *
     * This method retrieves a distinct list of authors from the active menus in the database.
     *
     * @return array An array of unique authors from active menus.
     */
    public function addMenu(string $name, $limit) {
        return $this->menu::create([
            'name' => $name,
            'active' => $limit
        ]);
    }

    /**
     * Find a menu by its ID.
     *
     * This method retrieves a menu from the database using its unique identifier.
     *
     * @param int $id The ID of the menu to find.
     *
     * @return null|Menu Returns the menu model if found, null otherwise.
     */
    public function findById(int $id): ?Menu {
        return $this->menu::find($id);
    }

}
