<?php

class ApiService {
    private $apiUrl = 'http://localhost:5000';  // URL base de tu API

    // Obtener todas las reservas
    public function getReservas() {
        $url = $this->apiUrl . '/reservas';
        return $this->makeGetRequest($url);
    }

    // Eliminar una reserva por ID
    public function deleteReserva($idReserva) {
        $url = $this->apiUrl . '/reservas/' . $idReserva;
        return $this->makeDeleteRequest($url);
    }

    // Obtener todas las categorías de vehículos
    public function getCategorias() {
        $url = $this->apiUrl . '/categorias';
        return $this->makeGetRequest($url);
    }

    // Obtener todos los tipos de lavado
    public function getTiposLavado() {
        $url = $this->apiUrl . '/tipolavado';
        return $this->makeGetRequest($url);
    }

    // Obtener el número de reservas pendientes
    public function getReservasPendientes() {
        $reservas = $this->getReservas();
        return count(array_filter($reservas, function ($reserva) {
            return $reserva['estado_reserva'] === 'Pendiente';
        }));
    }

    // Método para realizar solicitudes GET a la API
    private function makeGetRequest($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);  // Decodificar el JSON recibido
    }

    // Método para realizar solicitudes DELETE a la API
    private function makeDeleteRequest($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        $response = curl_exec($ch);
        curl_close($ch);

        return json_decode($response, true);  // Decodificar el JSON recibido
    }
}
