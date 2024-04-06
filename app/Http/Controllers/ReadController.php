<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReadingRequest;
use App\Services\ReadingService;
use App\Traits\ApiResponse;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ReadController extends Controller
{
    use ApiResponse;

    public function __construct(public ReadingService $readingService)
    {
    }

    /**
     * @return Response|Application|ResponseFactory
     */
    public function calculateRecommendedBooks(): Response|Application|ResponseFactory
    {
        $recommendedBooks = $this->readingService->recommendBooksBuilder();

        return $this->apiResponse('successfully', $recommendedBooks);

    }

    /**
     * @param ReadingRequest $request
     * @return
     *
     */
    public function storeReadingBook(ReadingRequest $request): Response|Application|ResponseFactory
    {
        $data = $this->readingService->saveReading($request);

        return $this->apiResponse('successfully', $data);
    }
}
