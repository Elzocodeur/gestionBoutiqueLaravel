<?php
namespace App\Http\Controllers;

use App\Enums\StatusEnum;
use App\Http\Requests\ClientStoreRequest;
use App\Http\Requests\ClientUpdateRequest;
use App\Http\Traits\ResponseTrait; // Ajoutez ceci
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;



class ClientController extends Controller
{
    use ResponseTrait;

public function index(Request $request)
{
    // Vérification des paramètres de la requête
    $telephone = $request->query('telephone');
    $allClients = $request->query('allclient');

    // Log pour le débogage
    Log::info('Recherche de client', ['telephone' => $telephone, 'allClients' => $allClients]);

    // Initialiser la requête
    $query = Client::query();

    // Filtrer par numéro de téléphone
    if ($telephone) {
        // Utiliser LIKE pour une correspondance partielle et supprimer les espaces
        $formattedPhone = str_replace([' ', '+'], '%', $telephone);
        $query->where('telephone', 'LIKE', '%' . $formattedPhone . '%');

        // Log de la requête SQL pour le débogage
        Log::info('Requête SQL', ['sql' => $query->toSql(), 'bindings' => $query->getBindings()]);
    }
    // Récupérer tous les clients si 'allclient' est présent dans la requête
    elseif ($allClients) {
        // Pas besoin de modifier la requête ici
    }
    // Si aucun paramètre n'est fourni, retourner un message d'erreur
    else {
        return $this->sendResponse(StatusEnum::ECHEC, null, 'Aucun paramètre de requête valide fourni.');
    }

    // Exécuter la requête et récupérer les résultats
    $clients = $query->get();

    // Log du nombre de clients trouvés
    Log::info('Résultat de la recherche', ['count' => $clients->count()]);

    // Vérifier si des clients ont été trouvés
    if ($clients->isEmpty()) {
        return $this->sendResponse(StatusEnum::ECHEC, null, 'Aucun client trouvé.');
    }

    // Retourner la liste des clients
    return $this->sendResponse(StatusEnum::SUCCES, $clients, 'Clients récupérés avec succès.');
}

    public function show($id)
    {
        $client = Client::find($id);
        if (!$client) {
            return $this->sendResponse(StatusEnum::ECHEC, null, 'Client introuvable');
        }
        return $this->sendResponse(StatusEnum::SUCCES, $client, 'Client trouvé');
    }

    public function store(ClientStoreRequest $request)
    {
        // Begin transaction
        DB::beginTransaction();
        try {
            // Initialize user_id as null
            $user_id = null;

            // Check if a user account should be created
            if ($request->has('create_user') && $request->create_user) {
                // Ensure the user doesn't already exist
                $user = User::where('login', $request->email)->first();
                if ($user) {
                    // If user already exists, rollback the transaction and return an error response
                    DB::rollback();
                    return $this->sendResponse(StatusEnum::ECHEC, null, 'User already exists');
                }

                // Create the user
                $user = User::create([
                    'nom' => $request->nom,
                    'prenom' => $request->prenom,
                    'login' => $request->login,
                    'password' => Hash::make($request->password),
                ]);
                // Assign the created user ID to the client
                $user_id = $user->id;
            }

            // Create the client
            $client = Client::create([
                'surnom' => $request->surnom,
                'telephone' => $request->telephone,
                'adresse' => $request->adresse,
                'user_id' => $user_id,
            ]);

            // If a user was created, assign the created user ID to the client
            if ($user_id) {
                $client->user_id = $user_id;
                $client->save();
            }

            // Commit transaction
            DB::commit();

            return $this->sendResponse(StatusEnum::SUCCES, $client, 'Client created successfully');

        } catch (\Exception $e) {
            // Rollback transaction in case of any exception
            DB::rollback();
            // Include the exception message in the response for debugging
            return $this->sendResponse(StatusEnum::ECHEC, null, 'Failed to create client: ' . $e->getMessage());
        }
    }


    public function update(ClientUpdateRequest $request, $id)
    {
        try {
            $client = Client::findOrFail($id);

            // Update client details
            $client->update($request->validated());

            return $this->sendResponse(StatusEnum::SUCCES, $client, 'Client updated successfully');
        } catch (\Exception $e) {
            return $this->sendResponse(StatusEnum::ECHEC, null, 'Failed to update client');
        }
    }
}



