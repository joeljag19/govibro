<?php
use CodeIgniter\Files\File;

if (!function_exists('processAndResizeImage')) {
    /**
     * Procesa una imagen subida: la mueve, la redimensiona y crea una miniatura.
     *
     * @param File   $file         El objeto del archivo subido desde $this->request->getFile().
     * @param string $subfolder    La subcarpeta dentro de 'public/uploads/' donde se guardará (ej. 'tours', 'hotels').
     * @param int    $mainWidth    Ancho de la imagen principal.
     * @param int    $mainHeight   Alto de la imagen principal.
     * @param int    $thumbWidth   Ancho de la miniatura.
     * @param int    $thumbHeight  Alto de la miniatura.
     *
     * @return string|null El nuevo nombre del archivo guardado, o null si falla.
     */


    /*
        // Ejemplo de uso en un controlador:
        
            $imageFile = $files['image'] ?? null;
            if ($imageFile) {
                // La nueva función hace todo el trabajo pesado en una sola línea
                $imageName = processAndResizeImage($imageFile, 'tours'); 
                if ($imageName) {
                    $tourData['image_id'] = $imageName;
                }
            }
    */
    function processAndResizeImage(
        $file,
        string $subfolder,
        int $mainWidth = 1284,
        int $mainHeight = 600,
        int $thumbWidth = 400,
        int $thumbHeight = 400
    ): ?string
    {
        if (!$file || !$file->isValid() || $file->hasMoved()) {
            return null;
        }

        // 1. Definir y crear la ruta de destino
        $uploadPath = ROOTPATH . 'public/uploads/' . trim($subfolder, '/') . '/';
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }

        // 2. Mover el archivo
        $newName = $file->getRandomName();
        $file->move($uploadPath, $newName);

        try {
            $imageService = \Config\Services::image();

            // 3. Redimensionar la imagen principal
            $imageService->withFile($uploadPath . $newName)
                         ->fit($mainWidth, $mainHeight, 'center')
                         ->save($uploadPath . $newName);

            // 4. Crear la miniatura
            $thumbName = pathinfo($newName, PATHINFO_FILENAME) . '_thumb.' . pathinfo($newName, PATHINFO_EXTENSION);
            $imageService->withFile($uploadPath . $newName)
                         ->fit($thumbWidth, $thumbHeight, 'center')
                         ->save($uploadPath . $thumbName);
            
            return $newName; // Devolver el nombre del archivo principal

        } catch (\Exception $e) {
            log_message('error', '[ImageHelper] ' . $e->getMessage());
            return null; // Si algo falla, devolver null
        }
    }
}