<?php
namespace App\Http\Controllers\SubmenuOptions;

use Illuminate\Http\Request;
use App\Services\SubmenuOptions\SubmenuOptionsService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubmenuOptions\AddRequest;
use App\Http\Requests\SubmenuOptions\UpdateRequest;

class SubmenuOptionsController extends Controller
{
    protected $submenuService;

    public function __construct(SubmenuOptionsService $submenuService)
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