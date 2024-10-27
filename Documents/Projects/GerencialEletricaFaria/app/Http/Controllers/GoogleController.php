<?php

namespace App\Http\Controllers;

use Illuminate\Http\RequestException;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

//Para conectar ao google
use GuzzleHttp\Client;

class GoogleController extends Controller
{
    public function login()
    {
        return Socialite::driver('google')
            ->scopes(['https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/calendar'])
            ->with(['access_type' => 'offline'])
            ->redirect();
    }

    public function callback()
    {
        try {
            $user = Socialite::driver('google')->user();
    
            // Verificar se o usuário já existe no seu banco de dados
            $existingUser = User::where('email', $user->getEmail())->first();
    
            if (!$existingUser) {
                // Criar um novo usuário
                $existingUser = User::create([
                    'name' => $user->getName(),
                    'email' => $user->getEmail(),
                    'google_id' => $user->getId(),
                    'google_token' => $user->token,
                    'google_refresh_token' => $user->refreshToken,
                    'google_avatar' => $user->getAvatar(),
                ]);
            } else {
                // Atualizar os tokens do usuário existente
                $existingUser->google_token = $user->token;
                $existingUser->google_refresh_token = $user->refreshToken;
                $existingUser->google_avatar = $user->getAvatar();
                $existingUser->save();
            }
    
            // Logar o usuário
            Auth::login($existingUser);
    
            return redirect()->intended('/');
        } catch (\Exception $e) {
            Log::error('Erro ao obter o usuário do Google: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Um erro ocorreu durante o login.');
        }
    }

    function renovarToken($user_id)
    {
        $usuario = User::find($user_id);
        $accessToken = $usuario->google_access_token;
        $expiresAt = $usuario->google_token_expires_at; // Campo que armazena a expiração do access token
    
        // Verificar se o access token ainda é válido
        if ($expiresAt && now()->lt($expiresAt)) {
            // O access token ainda é válido, retornar ele
            return $accessToken;
        }
    
        // Caso o access token tenha expirado, renovar usando o refresh token
        $refreshToken = $usuario->google_refresh_token;
    
        if ($refreshToken) {
            try {
                $client = new Client();
                $response = $client->post('https://oauth2.googleapis.com/token', [
                    'form_params' => [
                        'client_id' => env('GOOGLE_CLIENT_ID'),
                        'client_secret' => env('GOOGLE_SECRET_ID'),
                        'refresh_token' => $refreshToken,
                        'grant_type' => 'refresh_token',
                    ],
                ]);
    
                $data = json_decode($response->getBody(), true);
    
                // Atualizar o access token e o tempo de expiração
                $usuario->google_access_token = $data['access_token'];
                $usuario->google_token_expires_at = now()->addSeconds($data['expires_in']); // 'expires_in' é em segundos
                $usuario->save();
    
                return $data['access_token']; // Retorna o novo access token
            } catch (RequestException $e) {
                Log::error('Erro ao renovar token do Google: ' . $e->getMessage());
                return null;
            }
        }
    
        return null; // Caso não tenha refresh token
    }

    public function addAgenda($id_usuario, $agenda)
    {
        $new_token = $this->renovarToken($id_usuario);

        if ($new_token == null)
            return [ 0=> "Não existe link com o google account, agenda não pode ser criada" ];
        else {
            //$this->atualizaTokenBase($id_usuario, $new_token);
            try {
                $client = new Client();
                $response = $client->post('https://www.googleapis.com/calendar/v3/calendars/primary/events', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $new_token,
                        'Content-Type'  => 'application/json',
                    ],
                    'json' => $agenda,
                ]);

                $retorno = $response->getBody();
                $retornoData = json_decode($retorno, true);
                $id = $retornoData['id'];
                return $id;

            } catch (RequestException $e) {
                $errorResponse = $e->getResponse();
                $errorBody = $errorResponse ? $errorResponse->getBody()->getContents() : 'Sem resposta de erro';
                echo "Erro: " . $errorBody;
                throw $e;
            }
        }
    }

    //Remover agenda do google drive
    public function removerAgenda($google_id, $id_usuario)
    {
        try {
            $token = $this->renovarToken($id_usuario);

            $client = new Client();
            $response = $client->delete("https://www.googleapis.com/calendar/v3/calendars/primary/events/$google_id", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                ],
            ]);
            return $response->getStatusCode(); // Deve retornar 204 se for removido com sucesso
        }
        catch (\Exception $e) {
            Log::error('Erro ao executar ação: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
        }
    }
}