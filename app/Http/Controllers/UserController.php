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
            'document' => 'max:11|unique:users,document',
            'email' => 'email|unique:users,email',
            'password' => 'required',
            'number' => 'required|max:11'
        ]);

        User::create($request->only('name', 'document', 'email', 'password', 'number'));

        return response()->json(["message" => "user registered succefully"]);
    }

    public function getUsers()
    {
        $user = User::paginate(10);

        return response()->json($user);
    }

    public function getUser(Request $request, int $id)
    {
        $request->merge(['id' => $id]);

        $this->validate($request, [
            'id' => 'required|exists:users,id'
        ]);

        $user = User::findOrFail($id);

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
