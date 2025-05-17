<?php

namespace App\Repositories;

use App\Models\Configuration;

class ConfigRepository
{
    protected $config;

    public function __construct(Configuration $config) {
        $this->config = $config;
    }

    /**
     * List all configs.
     *
     * @return array An array of unique authors from active configs.
     */
    public function getConfig() {
        return $this->config;
    }

    /**
     * Find a config by its ID.
     *
     * This method retrieves a config from the database using its unique identifier.
     *
     * @param int $id The ID of the config to find.
     *
     * @return null|Config Returns the config model if found, null otherwise.
     */
    public function findById(int $id): ?Configuration {
        return $this->config::find($id);
    }

    /**
     * Add new config.
     *
     * This method retrieves a distinct list of authors from the active configs in the database.
     *
     * @return array An array of unique authors from active configs.
     */
    public function addConfig($request) {
        return $this->config::create([
            'name'          => $request['name'],
            'information'   => json_encode($request['information'])
        ]);
    }

}
