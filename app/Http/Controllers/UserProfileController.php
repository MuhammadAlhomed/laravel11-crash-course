<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Storage;

class UserProfileController extends Controller
{
    function index(){
        return redirect()->route('profile.show', auth()->user());
    }
    function show(Request $request, User $user){
        $user = $user->load('notes');
        $notes = $user->notes()->orderByDesc('created_at')->paginate(10);

        // Set the note -> user relationship without calling the database again.
        foreach ($notes as $note) {
            $note->setRelation('user', $user);
        }

        return view('profile.show', ['user' => $user,'notes' => $notes]);
    }
    function update(Request $request){

        $request->validate([
            'username' => [Rule::unique('users', 'username')->ignore(auth()->user()->id)],
            'name' => ['string', 'max:32'],
            'email' => ['email'],
            'old_password' => ['current_password:web', 'nullable'],
            'password' => [Rule::requiredIf(filled($request->old_password)) ,'min:8' , 'confirmed', 'nullable']
        ]);

        auth()->user()->update([
            'name' => $request->name,
            'username' => $request->username,
            'bio' => $request->bio,
            'email' => $request->email,
            ...($request->filled('password') ? ['password' => $request->password] : []),
        ]);

        return back()->with('message', 'Profile has updated successfully');
    }

    function updateImage(Request $request) {
        $request->validate([
            'image' => ['image', 'max:2048', 'mimes:png,jpg']
        ]);

        $user = auth()->user();
        $newProfileImage = $request->file('image');

        if($request->file('image')) {

            // Delete old image
            if($user->avatar){
                Storage::disk('public')->delete($user->avatar);
            }

            // Store new image
            $path = $newProfileImage->store('avatar', 'public');
            $user->update([
                'avatar' => $path
            ]);

            // Response
            return response()->json([
                'success' => true,
                'image_url' => Storage::url($path),
            ]);
        }
        // Response (Failure)
        return response()->json([
                'success' => false,
                'image_url' => Storage::url($user->avatar),
        ]);
    }
}
