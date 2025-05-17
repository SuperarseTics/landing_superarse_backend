<?php
namespace App\Http\Controllers\Page;

use Illuminate\Http\Request;
use App\Services\Page\PageService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Page\AddRequest;
use App\Http\Requests\Page\UpdateRequest;

class PageController extends Controller
{
    protected $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function showAll(int $id): JsonResponse
    {
        return $this->pageService->showAll($id);
    }

    public function show(): JsonResponse
    {
        return $this->pageService->show();
    }

    public function add(AddRequest $request): JsonResponse
    {
        return $this->pageService->add($request);
    }

    public function update(UpdateRequest $request): JsonResponse {
        return $this->pageService->update($request);
    }

    public function destroy(int $id): JsonResponse {
        return $this->pageService->destroy($id);
    }
}