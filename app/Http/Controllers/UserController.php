<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function postUser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'document' => 'required|max:11',
            'email' => 'required|email',
            'password' => 'required',
            'number' => 'required|max:11'
        ]);

        if(User::where('document', $request->input('document'))->exists()) {
            return response()->json(["message" => "there is a user using this document already"], 400);
        }

        if(User::where('email', $request->input('email'))->exists()) {
            return response()->json(["message" => "there is a user using this email already"], 400);
        }

        User::create($request->only('name', 'document', 'email', 'password', 'number'));

        return response()->json(["message" => "user registered succefully"]);
    }

    public function getUsers()
    {
        $user = User::paginate(10);

        return response()->json($user);
    }

    public function getUser(string $id)
    {
        try {
            $user = User::findOrFail($id);
        } catch (\Exception $exception) {
            return response()->json(["message" => "user not found"], 403);
        }

        return response()->json($user->first());
    }

    public function putUser(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|exists:users,id',
            'document' => 'max:11|unique:users,document',
            'email' => 'email|unique:users,email',
            'number' => 'max:11'
            ]);

        $user = User::where('id', $request->only('id'));

        $user->update($request->only('name', 'document', 'email', 'password', 'number'));

        return response()->json(["message" => "user updated"]);
    }

    public function deleteUser(Request $request, int $id)
    {
        $request->merge(['id' => $id]);

        $this->validate($request, [
            'id' => 'required|exists:users,id'
        ]);

        User::destroy($request->input('id'));

        return response()->json(["message" => "user deleted"]);
    }
}
