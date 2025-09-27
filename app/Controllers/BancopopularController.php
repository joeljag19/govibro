<?php
namespace App\Controllers;

use CodeIgniter\Controller;

// **RECOMENDACIÓN:** Corregir el nombre de la clase a Controller (con 'er')
class BancopopularController extends Controller
{
    public function webhook()
    {
        // Obtener los datos del webhook
        $input = $this->request->getJSON();

        // Validar y procesar los datos recibidos
        if ($input && isset($input->transaction_id) && isset($input->status)) {
            $transactionId = $input->transaction_id;
            $status = $input->status;

            // Aquí puedes agregar la lógica para actualizar el estado de la transacción en tu base de datos
            // Por ejemplo:
            // $transactionModel = new TransactionModel();
            // $transactionModel->updateStatus($transactionId, $status);

            return $this->response->setStatusCode(200, 'Webhook recibido y procesado correctamente.');
        } else {
            return $this->response->setStatusCode(400, 'Datos inválidos en el webhook.');
        }
    }

    public function index()
    {
        echo "BancopopularController está activo.";
        //return $this->response->setStatusCode(200, 'BancopopularController está activo.');
    }
}