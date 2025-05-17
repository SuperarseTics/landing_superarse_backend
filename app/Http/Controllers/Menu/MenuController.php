<?php
namespace App\Http\Controllers\Menu;

use Illuminate\Http\Request;
use App\Services\Menu\MenuService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\AddRequest;
use App\Http\Requests\Menu\UpdateRequest;

class MenuController extends Controller
{
    protected $menuService;

    public function __construct(MenuService $menuService)
    {
        $this->menuService = $menuService;
    }

    public function showAll(): JsonResponse
    {
        return $this->menuService->showAll();
    }

    public function show(): JsonResponse
    {
        return $this->menuService->show();
    }

    public function add(AddRequest $request): JsonResponse
    {
        return $this->menuService->add($request);
    }

    public function update(UpdateRequest $request): JsonResponse {
        return $this->menuService->update($request);
    }

    public function destroy(int $id): JsonResponse {
        return $this->menuService->destroy($id);
    }
}