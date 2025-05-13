@extends('layouts.errors.app', [
    'error' => 503,
    'subtitle' => 'Serveur non disponible',
    'description' => 'Le serveur n\'est pas disponible pour effectuer votre requête.'
])
