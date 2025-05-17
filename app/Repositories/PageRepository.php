<?php

namespace App\Repositories;

use App\Models\Page;

class PageRepository
{
    protected $page;

    public function __construct(Page $page) {
        $this->page = $page;
    }

    /**
     * List all pages.
     *
     * @return array An array of unique authors from active pages.
     */
    public function getPage() {
        return $this->page;
    }

    /**
     * Add new page.
     *
     * @return array An array of unique authors from active pages.
     */
    public function addPage($request) {
        return $this->page::create([
            'options_id'    => $request['options_id'],
            'name'          => $request['name'],
            'ruta'          => $request['ruta'],
            'properties'    => json_encode($request['properties'])
        ]);
    }

    /**
     * Find a page by its options_id.
     *
     * This method retrieves a page from the database using its unique identifier.
     *
     * @param int $id The options_id of the page to find.
     *
     * @return null|Page Returns the page model if found, null otherwise.
     */
    public function findByOptionId(int $options_id): ?Page {
        return $this->page::where('options_id', $options_id)->first();
    }

    /**
     * Find a page by its ID.
     *
     * This method retrieves a page from the database using its unique identifier.
     *
     * @param int $id The ID of the page to find.
     *
     * @return null|Page Returns the page model if found, null otherwise.
     */
    public function findById(int $id): ?Page {
        return $this->page::find($id);
    }

}
