<?php
namespace App\Http\Controllers\Section;

use Illuminate\Http\Request;
use App\Services\Section\SectionService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Section\AddRequest;
use App\Http\Requests\Section\UpdateRequest;

class SectionController extends Controller
{
    protected $sectionService;

    public function __construct(SectionService $sectionService)
    {
        $this->sectionService = $sectionService;
    }

    public function showAll(): JsonResponse
    {
        return $this->sectionService->showAll();
    }

    public function show(): JsonResponse
    {
        return $this->sectionService->show();
    }

    public function add(AddRequest $request): JsonResponse
    {
        return $this->sectionService->add($request);
    }

    public function update(UpdateRequest $request): JsonResponse {
        return $this->sectionService->update($request);
    }

    public function destroy(int $id): JsonResponse {
        return $this->sectionService->destroy($id);
    }
}