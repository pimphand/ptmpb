<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use http\Env\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
        return view('admin.messages', [
            'title' => 'Message'
        ]);
    }

    /**
     * get all data.
     */

    public function data(\Illuminate\Http\Request $request): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        $messages = Message::when($request->search,function ($query) use ($request){
            $query->where('name', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%")
                ->orWhere('message', 'like', "%{$request->search}%");
        })
            ->latest()
            ->paginate(10);
        return MessageResource::collection($messages);
    }
}
