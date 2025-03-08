<?php namespace App\Models;

use CodeIgniter\Model;

class TaskModel extends Model
{
    protected $table      = 'tasks';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'description', 'status'];

    protected $useTimestamps = true;

    protected $validationRules = [
        'title'       => 'required|max_length[255]',
        'description' => 'permit_empty',
        'status'      => 'required|in_list[pendente,em andamento,concluída]',
    ];
}
