<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Laravel\Sanctum\HasApiTokens;

class UserController extends Controller
{
    // Créer un utilisateur
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string',
            'prenom' => 'required|string',
            'login' => 'required|string|email|unique:users,login',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'nom' => $validated['nom'],
            'prenom' => $validated['prenom'],
            'login' => $validated['login'],
            'password' => Hash::make($validated['password']),
        ]);

        return response()->json($user, 201);
    }

    // Authentifier un utilisateur et générer un token
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'login' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'login' => ['The provided credentials are incorrect.'],
            ]);
        }

        $user = Auth::user();

        if ($user instanceof User) {
            // Révoquer les tokens expirés
            $this->revokeExpiredTokens($user);

            // Générer un nouveau token
            $token = $user->createToken('auth_token', ['*'], now()->addMinutes(10))->plainTextToken;

            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
            ]);
        }

        return response()->json(['error' => 'User not authenticated'], 401);
    }

    // Afficher un utilisateur spécifique
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    // Modifier un utilisateur
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'nom' => 'sometimes|string',
            'prenom' => 'sometimes|string',
            'login' => 'sometimes|string|email|unique:users,login,' . $user->id,
            'password' => 'sometimes|string|min:8',
        ]);

        if (isset($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        }

        $user->update($validated);

        return response()->json($user);
    }

    // Supprimer un utilisateur
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }



        public function logout(Request $request)
            {
                $user = $request->user();

                if ($user instanceof User) {
                    // Révoquer tous les tokens de l'utilisateur
                    $user->tokens()->delete();

                    return response()->json(['message' => 'Logged out successfully']);
                }

                return response()->json(['message' => 'User not authenticated'], 401);
            }


    // Révoquer les tokens expirés
    protected function revokeExpiredTokens(User $user)
    {
        $user->tokens()->where('expires_at', '<', now())->delete();
    }
}
