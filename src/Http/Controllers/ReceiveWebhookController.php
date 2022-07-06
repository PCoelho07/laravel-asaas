<?php

namespace Laravel\Asaas\Http\Controllers;

use App\Http\Controllers\Controller;
use Request;

class ReceiveWebhookController extends Controller {
    public function index(Request $request)
    {
        $job = config('asaas.webhooks.processor');
        dispatch(new $job($request->all()));
    }
}
