<?php
namespace App\Http\Controllers\Config;

use Illuminate\Http\Request;
use App\Services\Config\ConfigService;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Config\UpdateRequest;
use App\Http\Requests\Config\AddRequest;

class ConfigController extends Controller
{
    protected $configService;

    public function __construct(ConfigService $configService)
    {
        $this->configService = $configService;
    }

    public function show(): JsonResponse
    {
        return $this->configService->show();
    }

    public function update(UpdateRequest $request): JsonResponse {
        return $this->configService->update($request);
    }

    public function add(AddRequest $request): JsonResponse {
        return $this->configService->add($request);
    }

    public function destroy(int $id): JsonResponse {
        return $this->configService->destroy($id);
    }

}