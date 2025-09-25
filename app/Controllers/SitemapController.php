<?php

namespace App\Controllers;

use App\Modules\AdminTours\Models\TourAdminModel; // Usamos el modelo que ya tienes

class SitemapController extends BaseController
{
    // public function index()
    // {
    //     $tourModel = new TourAdminModel();

        
    //     // Obtenemos solo los tours que están publicados y aprobados
    //     $tours = $tourModel->where('status', 'published')
    //                        ->where('approval_status', 'approved')
    //                        ->findAll();


    //     $data['tours'] = $tours;

    //     // ¡Muy importante! Le decimos al navegador que esto es un archivo XML
    //     $this->response->setHeader('Content-Type', 'application/xml');
        
    //     // Cargamos la vista que crearemos en el siguiente paso
    //     return view('sitemap', $data);
    // }
    public function index()
    {
        // 1. Intentamos obtener el sitemap desde el caché
        if (! $sitemap = cache('sitemap_xml')) {
            
            // 2. Si no está en caché, lo generamos
            $tourModel = new \App\Modules\AdminTours\Models\TourAdminModel();
            $tours = $tourModel->where('status', 'published')
                            ->where('approval_status', 'approved')
                            ->get()
                            ->getResultArray();

            $data['tours'] = $tours;
            
            // Renderizamos la vista para obtener el contenido XML como un string
            $sitemap = view('sitemap', $data);

            // 3. Guardamos el resultado en el caché por 24 horas (86400 segundos)
            cache()->save('sitemap_xml', $sitemap, 86400);
        }

        // 4. Devolvemos el sitemap (ya sea el nuevo o el que estaba en caché)
        return $this->response->setXML($sitemap);
    }
}