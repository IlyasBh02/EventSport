<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 
class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }
 
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:admin,organisateur,participant',
        ]);
 
        $user->update(['role' => $request->role]);
 
        return back()->with('success', 'Rôle de l\'utilisateur mis à jour avec succès.');
    }
 
    public function destroy(User $user)
    {
        if ($user->id === Auth::id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }
 
        $user->delete();
 
        return back()->with('success', 'Utilisateur supprimé avec succès.');
    }
}
