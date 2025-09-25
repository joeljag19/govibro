<?php
namespace App\Modules\Services\Controllers;

use App\Modules\Services\Models\ServiceModel;
use App\Modules\Services\Models\ServiceCarModel;
use App\Modules\Services\Models\ServiceBoatModel;
use App\Modules\Services\Models\ServiceTourModel;
use App\Modules\Services\Models\ServiceHotelModel;
use App\Modules\Services\Models\HotelRoomModel;
use CodeIgniter\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        $serviceModel = new ServiceModel();
        $data['services'] = $serviceModel->where('type', 'excursion')->findAll();
        $data['title'] = 'Tours';
        return view('App\Modules\Services\Views\tour_index', $data);
    }

    public function show($slug)
    {
        $serviceModel = new ServiceModel();
        $service = $serviceModel->where('slug', $slug)->first();

        if (!$service) {
            return redirect()->to('/')->with('error', 'Servicio no encontrado');
        }

        $data['service'] = $service;
        $data['title'] = $service['title'];

        switch ($service['type']) {
            case 'vehicle':
                $carModel = new ServiceCarModel();
                $data['details'] = $carModel->find($service['id']);
                return view('App\Modules\Services\Views\car_detail', $data);
            case 'boat':
                $boatModel = new ServiceBoatModel();
                $data['details'] = $boatModel->find($service['id']);
                return view('App\Modules\Services\Views\boat_detail', $data);
            case 'excursion':
                $tourModel = new ServiceTourModel();
                $data['details'] = $tourModel->find($service['id']);
                return view('App\Modules\Services\Views\tour_detail', $data);
            case 'property':
                $hotelModel = new ServiceHotelModel();
                $roomModel = new HotelRoomModel();
                $data['details'] = $hotelModel->find($service['id']);
                $data['rooms'] = $roomModel->where('service_id', $service['id'])->findAll();
                return view('App\Modules\Services\Views\hotel_detail', $data);
        }
    }
}