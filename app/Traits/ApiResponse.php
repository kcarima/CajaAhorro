<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
    public function successMessage(string $title = '¡Exito!', ?string $message = null, mixed $data = null, int $code = 200)
    {
        return $this->message($title, $message, $data, $code);
    }

    public function errorMessage(string $title = '¡Whoops! Algo salió mal', ?string $message = null, mixed $data = null, int $code = 500)
    {
        return $this->message($title, $message, $data, $code);
    }

    public function message(string $title, ?string $message, mixed $data = null, int $code)
    {
        return new JsonResponse([
            'title' => $title,
            'message' => $message,
            'data' => $data,
        ], $code);
    }
}
