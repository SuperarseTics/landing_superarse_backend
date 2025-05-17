<?php

namespace App\Repositories;

use App\Models\Widget;

class WidgetRepository
{
    protected $widget;

    public function __construct(Widget $widget) {
        $this->widget = $widget;
    }

    /**
     * List all widgets.
     *
     * This method retrieves a distinct list of authors from the active widgets in the database.
     *
     * @return array An array of unique authors from active widgets.
     */
    public function getWidget() {
        return $this->widget::all();
    }

    /**
     * Add new widget.
     *
     * This method retrieves a distinct list of authors from the active widgets in the database.
     *
     * @return array An array of unique authors from active widgets.
     */
    public function addWidget(string $name): array {
        return $this->widget::create([
            'name'          => $name,
            'properties'    => json_encode($request['properties']),
        ]);
    }

    /**
     * Find a widget by its ID.
     *
     * This method retrieves a widget from the database using its unique identifier.
     *
     * @param int $id The ID of the widget to find.
     *
     * @return null|  Widget Returns the widget model if found, null otherwise.
     */
    public function findById(int $id): ?  Widget {
        return $this->  widget::find($id);
    }

}
