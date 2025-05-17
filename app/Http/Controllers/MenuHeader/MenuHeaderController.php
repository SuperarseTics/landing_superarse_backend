<?php
namespace App\Http\Controllers\MenuHeader;

use Illuminate\Http\Request;
use App\Services\MenuHeader\MenuHeaderService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\MenuHeader\AddRequest;
use App\Http\Requests\MenuHeader\UpdateRequest;

class MenuHeaderController extends Controller
{
    protected $menuHeaderService;

    public function __construct(MenuHeaderService $menuHeaderService)
    {
        $this->menuHeaderService = $menuHeaderService;
    }

    public function showAll(): JsonResponse
    {
        return $this->menuHeaderService->showAll();
    }

    public function show(): JsonResponse
    {
        return $this->menuHeaderService->show();
    }

    public function add(AddRequest $request): JsonResponse
    {
        return $this->menuHeaderService->add($request);
    }

    public function update(UpdateRequest $request): JsonResponse {
        return $this->menuHeaderService->update($request);
    }

    public function destroy(int $id): JsonResponse {
        return $this->menuHeaderService->destroy($id);
    }
}