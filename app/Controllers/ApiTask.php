<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\RESTful\ResourceController;

class ApiTask extends ResourceController
{
    use ResponseTrait;

    public function index()
    {
        $tasks = new TaskModel();

        return $this->respond($tasks->findAll());
    }

    public function create()
    {
        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'required'
        ];
        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $tasks = new TaskModel();
        $task_data = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'status' => 'pendente'
        ];
        $tasks->save($task_data);
        $task_data['id'] = $tasks->getInsertID();

        return $this->respondCreated($task_data);
    }

    public function edit($id = null)
    {
        $tasks = new TaskModel();
        if (!$tasks->find($id)) return $this->failNotFound('Tarefa não encontrada.');

        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'required',
            'status' => 'required|in_list[pendente,em andamento,concluída]'
        ];

        if (!$this->validate($rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $task_data = [
            'title' => $this->request->getVar('title'),
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status')
        ];
        $tasks->update($id, $task_data);
        return $this->respondUpdated($task_data);
    }

    public function delete($id = null)
    {
        $tasks = new TaskModel();
        if (!$tasks->find($id)) return $this->failNotFound('Tarefa não encontrada.');

        $tasks->delete($id);
        return $this->respondDeleted(['message' => 'Tarefa removida com sucesso']);
    }
}
