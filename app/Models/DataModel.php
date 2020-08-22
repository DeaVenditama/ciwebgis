<?php namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model{
    protected $table = 'data';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id', 'id_master_data', 'kode_wilayah', 'nilai'
    ];
    protected $returnType = 'App\Entities\Data';
    protected $useTimestamps = false;
}