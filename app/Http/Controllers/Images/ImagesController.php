<?php
namespace App\Http\Controllers\Images;

use Illuminate\Http\Request;
use App\Services\Images\ImagesService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Images\AddRequest;
use App\Http\Requests\Images\UpdateRequest;

class ImagesController extends Controller
{
    protected $imageService;

    public function __construct(ImagesService $imageService)
    {
        $this->imageService = $imageService;
    }

    public function add(AddRequest $request): JsonResponse
    {
        return $this->imageService->add($request);
    }

    public function show(): JsonResponse
    {
        return $this->imageService->show();
    }

    public function destroy(int $id): JsonResponse {
        return $this->imageService->destroy($id);
    }
}