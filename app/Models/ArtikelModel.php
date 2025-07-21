<?php
namespace App\Models;

use CodeIgniter\Model;

class ArtikelModel extends Model
{
    protected $table = 'artikel'; // nama tabel di database
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'judul',
        'slug',
        'isi',
        'penulis',
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true; // otomatis isi created_at & updated_at
}
