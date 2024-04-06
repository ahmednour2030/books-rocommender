<?php

namespace App\Services;

use App\Models\ReadingIntervals;
use Illuminate\Support\Facades\DB;

class ReadingService
{
    /**
     * @return array
     */
    public function recommendBooksBuilder(): array
    {
        $query = file_get_contents(database_path('queries/query.sql'));

        return DB::select($query);
    }

    /**
     * @param $request
     * @return mixed
     */
    public function saveReading($request): mixed
    {
        return ReadingIntervals::create([
            'user_id' => $request->user_id,
            'book_id' => $request->book_id,
            'start_page' => $request->start_page,
            'end_page' => $request->end_page,
        ]);
    }

}
