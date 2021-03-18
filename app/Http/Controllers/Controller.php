<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
	 * @OA\Info(
	 *		version="1.0",
	 *		title="Boojbook API Documentation",
	 *		description="To help you get started with our API and learn the details, we've provided a way for you to make test calls. Just click the button labeled 'Authorize' below, enter your API key (Bearer Ni9aGNKNdYHUHJw4tSYIPQGWSXkAcbBO5IKr8R6), click save and then test the endpoints below."
	 * ),
	 */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
