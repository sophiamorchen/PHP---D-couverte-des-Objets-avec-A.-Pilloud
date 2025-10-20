<?php

namespace App\Controller;

abstract class AbstractController
{
    protected ?string $redirectUri = null;
    public function addFlash(string $key, string $message)
    {
        $_SESSION['flash'][$key] = $message;
    }

    public function getFlash(string $key)
    {
        $flash = $_SESSION['flash'][$key] ?? null;
        unset($_SESSION['flash'][$key]);

        return $flash;
    }
    public function redirectToUri(string $uri)
    {
        $this->redirectUri = $uri;

        // au cas où on voudrait l'utiliser ailleurs -> on la retourne.
        return $this->redirectUri;
    }

    public function getRedirectUri()
    {
        return $this->redirectUri;
    }
}