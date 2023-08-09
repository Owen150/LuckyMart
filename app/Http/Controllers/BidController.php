<?php

namespace App\Http\Controllers;

use App\Events\BidEvent;
use App\Models\Bid;
use App\Models\Lot;
use App\Services\MakeBidService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class BidController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param MakeBidService $service
     * @return RedirectResponse
     */
    public function store(MakeBidService $service)
    {
        event(new BidEvent($service->bid));
        return back()->with('success', 'Your bid is accepted.');
    }

    public function won()
    {
        $lots = Lot::all();

        $user_id = Auth::id();

        $winner = collect();

        foreach($lots as $lot)
        {
            $bids = Bid::where('lot_id', '=', $lot->id)->orderBy('price', 'DESC')->get();


            if(!$bids->isEmpty()) {
                if($user_id == $bids[0]->user_id) {
                    $winner->push($bids[0]);
                } 
            }
           
        }
        
        return view('lots.won')->with([
            'winner' => $winner
        ]);

    }
}
