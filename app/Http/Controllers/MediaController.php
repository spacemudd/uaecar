<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MediaController extends Controller
{
    public function show($id, Request $request)
    {
        return Media::findOrFail($id)->toInlineResponse($request);
    }
}
