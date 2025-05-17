<?php
namespace App\Http\Controllers\Submenu;

use Illuminate\Http\Request;
use App\Services\Submenu\SubmenuService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Submenu\AddRequest;
use App\Http\Requests\Submenu\UpdateRequest;

class SubmenuController extends Controller
{
    protected $submenuService;

    public function __construct(SubmenuService $submenuService)
    {
        $this->submenuService = $submenuService;
    }

    public function show(): JsonResponse
    {
        return $this->submenuService->show();
    }

    public function add(AddRequest $request): JsonResponse
    {
        return $this->submenuService->add($request);
    }

    public function update(UpdateRequest $request): JsonResponse {
        return $this->submenuService->update($request);
    }

    public function destroy(int $id): JsonResponse {
        return $this->submenuService->destroy($id);
    }
}