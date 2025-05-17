<?php
namespace App\Http\Controllers\Widget;

use Illuminate\Http\Request;
use App\Services\Widget\WidgetService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Widget\AddRequest;
use App\Http\Requests\Widget\UpdateRequest;

class WidgetController extends Controller
{
    protected $widgetService;

    public function __construct(WidgetService $widgetService)
    {
        $this->widgetService = $widgetService;
    }

    public function showAll(): JsonResponse
    {
        return $this->widgetService->showAll();
    }

    public function show(): JsonResponse
    {
        return $this->widgetService->show();
    }

    public function add(AddRequest $request): JsonResponse
    {
        return $this->widgetService->add($request);
    }

    public function update(UpdateRequest $request): JsonResponse {
        return $this->widgetService->update($request);
    }

    public function destroy(int $id): JsonResponse {
        return $this->widgetService->destroy($id);
    }
}