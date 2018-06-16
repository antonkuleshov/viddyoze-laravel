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
        if(isset($_GET['page'])) {
            $page = $_GET['page'];
        }

        if(isset($_GET['totalItems'])) {
            $totalItems = $_GET['totalItems'];
        }

        if(isset($_GET['itemsPerPage'])) {
            $itemsPerPage = $_GET['itemsPerPage'];
        }

        if(isset($_GET['author'])) {
            $author = $_GET['author'];
        }

        return (new QuoteCollection(
                    (isset($author)) ? Quote::where('author', $author)->get() : Quote::all()
                )
            )
            ->additional([
                'page' => (isset($page)) ? $page : null,
                'totalItems' => (isset($totalItems)) ? $totalItems : null,
                'itemsPerPage' => (isset($itemsPerPage)) ? $itemsPerPage : null,
                'author' => (isset($author)) ? $author : null
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
        $data = $_POST['json'];

        $quote = new Quote();

        $decodeData = json_decode($data);

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
        $data = $_POST['json'];

        $quote = Quote::find($id);

        $decodeData = json_decode($data);

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