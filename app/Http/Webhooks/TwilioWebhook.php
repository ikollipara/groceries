<?php

namespace App\Http\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\Grocery;
use App\Models\PhoneNumber;
use Illuminate\Http\Request;
use Twilio\TwiML\MessagingResponse;

class TwilioWebhook extends Controller
{
    public function __invoke(Request $request)
    {
        $body = $request->get('body');
        $response = new MessagingResponse;
        if(is_null($body)) {
            $response->message('Please have a message body.');
            return response($response->asXML())->header('Content-Type', 'text/xml');
        }

        $user = PhoneNumber::query()->where('number', $request->get('From'))->first()->user;

        if(is_null($user)) {
            $response->message('You are not authorized to use this service.');
            return response($response->asXML())->header('Content-Type', 'text/xml');
        }

        if($body === 'list') {
            $items = $user->groceries()->unpurchased()->get();
            $response->message('Your grocery list:');
            foreach($items as $item) {
                $response->message($item->item . "\n");
            }
            return response($response->asXML())->header('Content-Type', 'text/xml');
        }

        $item = Grocery::create([
            'item' => $body,
            'user_id' => $user->id,
        ]);

        $response->message("Added {$item->item} to your grocery list.");
        return response($response->asXML())->header('Content-Type', 'text/xml');
    }
}
