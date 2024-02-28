<?php 

namespace App\Models;
use CodeIgniter\Models;

class User extends Models
{
    protected $table = 'postman';
    protected $primaryKey = 'id';
    protected $allowedFields = [
      'username', 
      'umur',
      'alamat',
    ];
}
