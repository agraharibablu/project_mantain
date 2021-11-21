<?php namespace App\Models;

use CodeIgniter\Model;

class userAuthModel extends Model
{
    protected $table      = 'user_auth';
    protected $primaryKey = 'id';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'email','password','created_at','updated_at','deleted_at'];

    protected $useTimestamps = TRUE;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;
}