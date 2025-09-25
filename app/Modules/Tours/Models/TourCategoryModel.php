<?php

namespace App\Modules\Tours\Models;

use CodeIgniter\Model;

class TourCategoryModel extends Model
{
    protected $table = 'tour_categories';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name'];

    // Obtener todas las categorías
    public function getAllCategories()
    {
        return $this->findAll();
    }

    // Obtener un mapa de categorías (id => name)
    public function getCategoryMap()
    {
        $categories = $this->select('id, name')->findAll();
        $categoryMap = [];
        foreach ($categories as $category) {
            $categoryMap[$category['id']] = $category['name'];
        }
        return $categoryMap;
    }
}