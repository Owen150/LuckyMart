<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Lot;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkoutPage($bid_id)
    {
        $bid = Bid::find($bid_id);

        return view('checkout.chechout_page')->with([
            'bid' => $bid
        ]);
    }


    public function getEncoded($consumerKey, $consumerSecret)
    {   
        $fullString = $consumerKey.":".$consumerSecret;
        $encoded = base64_encode($fullString);
        return $encoded;
    }

    public function getToken(Request $request, $id)
    {
        $bid = Bid::find($id);

        $phone = $request->phone;

        $key = '2TjuNLzJC1jG0GyVPUth27059aGswkpC';
        

        $secret = 'uBDYJdsHRRGfvOti';

        $encodedConsumer = $this->getEncoded($key, $secret);



        //dd($encodedConsumer . ' ' . 'MlRqdU5MekpDMWpHMEd5VlBVdGgyNzA1OWFHc3drcEM6dUJEWUpkc0hSUkdmdk90aQ==');

        
        $ch = curl_init('https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials');
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Basic $encodedConsumer"]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response = curl_exec($ch);
        curl_close($ch);

        $dec = json_decode($response, true);

        return $this->charge($dec['access_token'], $bid->price, $phone, $bid->id);


    }


    public function charge($token, $amount, $phone, $bid_id){
        
       $ShortCode = 8239368;
       $CommandID = "CustomerPayBillOnline";
       $Amount = $amount;
       $Msisdn = (string) $phone;
       $BillRefNumber = '12345678';
    
       $user_id = Auth::id();




        $payload = array(
            'ShortCode' => $ShortCode,
            'CommandID' => $CommandID,
            'Amount' => $Amount,
            'Msisdn' => $Msisdn,
            'BillRefNumber' => $BillRefNumber
        );

        $data = json_encode($payload);
        try {

        

            $ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/c2b/v1/simulate');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                "Authorization: Bearer $token",
                'Content-Type: application/json'
            ]);

            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response  = curl_exec($ch);
            curl_close($ch);

            

            return redirect()->route('success_page', [$bid_id, $user_id]);

        } catch (\Exception $e) 
        {
            return redirect()->back()->with('unsuccess', 'please try again an error occured');
        }

    }

    public function success($bid_id, $user_id) {
        $bid = Bid::find($bid_id);

        $purchase = new Purchase();
        $purchase->lot_id = $bid->lot_id;
        $purchase->user_id = $user_id;
        $purchase->price = $bid->price;
        $purchase->save();


        $lot = Lot::find($bid->lot_id);
        $lot->qty = $lot->qty - 1;
        $lot->update();

        $bids = Bid::where('lot_id', '=', $lot->id)->get();

        foreach($bids as $b){
            $b->delete();
        }

        return view('checkout.succes');
    }
}
