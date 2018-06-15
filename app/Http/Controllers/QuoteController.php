<?php

namespace App\Http\Controllers;

use App\Quote;
use App\Http\Controllers\Controller;
use App\Http\Resources\Quote as QuoteResource;
use App\Http\Resources\QuoteCollection;


class QuoteController extends Controller
{
    /**
     * Get quotes list.
     *
     * @param (json) $data
     *
     * @return QuoteCollection
     */
    public function quotes()
    {
        $data = $_GET;

        $decodeData = json_decode(key($data));

        $page = $decodeData->page;
        $totalItems = $decodeData->totalItems;
        $itemsPerPage = $decodeData->itemsPerPage;
        return (new QuoteCollection(Quote::all()))
            ->additional([
                'page' => $page,
                'totalItems' => $totalItems,
                'itemsPerPage' => $itemsPerPage
            ]);
    }

    /**
     * Get quote.

     * @param $id
     *
     * @return QuoteResource
     */
    public function quote($id)
    {
        $quote = Quote::find($id);

        return new QuoteResource($quote);
    }

    /**
     * Create the quote in storage.
     *
     * @param (json) $data
     */
    public function create()
    {
        $data = $_POST;

        $quote = new Quote();

        $decodeData = json_decode(key($data));

        $quote->author($decodeData->author);
        $quote->text($decodeData->text);

        $quote->save();
    }

    /**
     * Update the quote in storage.
     *
     * @param $id
     * @param (json) $data
     */
    public function update($id)
    {
        $data = $_POST;

        $quote = Quote::find($id);

        $decodeData = json_decode(key($data));

        $quote->author($decodeData->author);
        $quote->text($decodeData->text);

        $quote->save();

    }

    /**
     * Destroy the quote.
     *
     * @param $id
     */
    public function destroy($id)
    {
        Quote::find($id)->delete();
    }
}