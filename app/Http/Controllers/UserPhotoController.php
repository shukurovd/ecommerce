<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserPhotoRequest;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class UserPhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth:sanctum");
    }

    public function index(User $user){
        //dd($user->photos);
        return $this->response($user->photos);
    }
    public function store(StoreUserPhotoRequest $request, User $user){
        Gate::authorize('user:create');
        if($request->photos){
            $path = $request->photos->store('users/'.$user->id, 'public');
            $fullname = $request->photos->getClientOriginalName();

            $user->photos()->create([
                'full_name' => $fullname,
                'path' => $path,
            ]);
        return $this->success('User photos added');
        }else{
            return $this->error('asdfasdf');
        }
    }

    public function destroy(User $user, Photo $photo){

        Gate::authorize('user:destroy');
        if ($photo->user_id !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        if (Storage::exists($photo->path)) {
            Storage::delete($photo->path);
        } else {
            return response()->json(['error' => 'File not found'], 404);
        }
        $photo->delete();

        return response('success', 'User Photo deleted');
    }
}
