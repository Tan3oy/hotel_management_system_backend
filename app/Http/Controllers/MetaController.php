<?php

namespace App\Http\Controllers;
use App\Services\MetaService;
use Illuminate\Http\Request;

class MetaController extends Controller
{
    protected MetaService $metaService;
    public function __construct(MetaService $metaService)
    {
        $this->middleware('auth:api', ['except' => ['', '']]);
        $this->metaService = $metaService;
    }

    public function createRoomType(Request $request)
    {
        return $this->metaService->createRoomType($request);
    }

}