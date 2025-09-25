<?php
namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $allowedFields = ['title', 'slug', 'content', 'category_name', 'category_slug', 'image_id', 'status', 'created_at', 'updated_at'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    /**
     * Obtener noticias con límite
     *
     * @param int $limit
     * @return array
     */
    public function getNews($limit = 6)
    {
        return $this->where('status', 'publish')
                    ->limit($limit)
                    ->findAll();
    }
}