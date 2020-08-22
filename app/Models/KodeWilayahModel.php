<?php namespace App\Models;

use CodeIgniter\Model;

class KodeWilayahModel extends Model{
    protected $table = 'kode_wilayah';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'kode_wilayah', 'nama_wilayah'
    ];
    protected $returnType = 'App\Entities\KodeWilayah';
    protected $useTimestamps = false;
}