<?php

declare(strict_types=1);

namespace Mini\Controllers;

use Mini\Core\Controller;
use Mini\Models\Client;

final class AuthController extends Controller
{
    public function registerForm(): void
    {
        $this->render('auth/register', params: [
            'title' => 'Inscription',
            'error' => null,
        ]);
    }

    public function register(): void
    {
        $nom = trim((string) ($_POST['nom'] ?? ''));
        $email = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');
        $adresse = trim((string) ($_POST['adresse'] ?? ''));

        if ($nom === '' || $email === '' || $password === '' || $adresse === '') {
            $this->render('auth/register', params: [
                'title' => 'Inscription',
                'error' => 'Tous les champs sont obligatoires.',
            ]);
            return;
        }

        if (Client::findByEmail($email) !== null) {
            $this->render('auth/register', params: [
                'title' => 'Inscription',
                'error' => 'Email déjà utilisé.',
            ]);
            return;
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        $clientId = Client::create($nom, $email, $hash, $adresse);

        $_SESSION['client_id'] = $clientId;
        $this->redirect('/');
    }

    public function loginForm(): void
    {
        $this->render('auth/login', params: [
            'title' => 'Connexion',
            'error' => null,
        ]);
    }

    public function login(): void
    {
        $email = trim((string) ($_POST['email'] ?? ''));
        $password = (string) ($_POST['password'] ?? '');

        if ($email === '' || $password === '') {
            $this->render('auth/login', params: [
                'title' => 'Connexion',
                'error' => 'Email et mot de passe obligatoires.',
            ]);
            return;
        }

        $client = Client::findByEmail($email);
        if ($client === null) {
            $this->render('auth/login', params: [
                'title' => 'Connexion',
                'error' => 'Identifiants invalides.',
            ]);
            return;
        }

        $stored = (string) ($client['passsword_'] ?? '');
        $ok = false;
        if (str_starts_with($stored, '$2y$') || str_starts_with($stored, '$argon2')) {
            $ok = password_verify($password, $stored);
        } else {
            // Compat fixtures: mots de passe en clair
            $ok = hash_equals($stored, $password);
        }

        if (!$ok) {
            $this->render('auth/login', params: [
                'title' => 'Connexion',
                'error' => 'Identifiants invalides.',
            ]);
            return;
        }

        $_SESSION['client_id'] = (int) $client['id_client_'];
        $this->redirect('/');
    }

    public function logout(): void
    {
        unset($_SESSION['client_id']);
        $this->redirect('/');
    }
}
