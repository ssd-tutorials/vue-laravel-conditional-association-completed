<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\FetchRequest;
use App\Http\Requests\Category\ToggleRequest;

use Illuminate\Http\JsonResponse;

class ProductCategoryController extends Controller
{
    /**
     * Fetch records.
     *
     * @param  \App\Http\Requests\Category\FetchRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch(FetchRequest $request): JsonResponse
    {
        return new JsonResponse($request->responseData());
    }

    /**
     * Toggle category association.
     *
     * @param  \App\Http\Requests\Category\ToggleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggle(ToggleRequest $request): JsonResponse
    {
        return new JsonResponse(['is_attached' => $request->toggle()]);
    }
}
