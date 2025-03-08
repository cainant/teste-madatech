<?php

namespace App\Controllers;

use App\Models\TaskModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use ReflectionException;

class Task extends BaseController
{
    protected $helpers = ['form'];

    public function index(): string
    {
        $tasks = new TaskModel();

        $data['tasks'] = $tasks->findAll();
        return view('tasks/index', $data);
    }

    /**
     * @throws ReflectionException
     */
    public function create()
    {
        if ($this->request->is('get')) {
            return view('tasks/create');
        }

        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'required',
        ];
        $data = $this->request->getPost(array_keys($rules));
        if (!$this->validateData($data, $rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $tasks = new TaskModel();
        $task_data = [
            'title' => $data['title'],
            'description' => $data['title'],
            'status' => 'pendente'
        ];
        $tasks->save($task_data);

        return redirect()->to('tasks/');
    }

    /**
     * @throws ReflectionException
     */
    public function edit($id)
    {
        $tasks = new TaskModel();
        $task = $tasks->find($id);
        if (!$task)
            throw new PageNotFoundException('Tarefa não encontrada.');

        if ($this->request->is('get')) {
            return view('tasks/edit', ['task' => $task]);
        }

        $rules = [
            'title' => 'required|max_length[255]',
            'description' => 'required',
            'status' => 'required|in_list[pendente,em andamento,concluída]'
        ];
        $data = $this->request->getPost(array_keys($rules));
        if (!$this->validateData($data, $rules)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $task_data = [
            'title' => $data['title'],
            'description' => $data['title'],
            'status' => $data['status']
        ];
        $tasks->update($id, $task_data);
        
        return redirect()->to('tasks/');
    }

    public function delete($id)
    {
        $tasks = new TaskModel();
        $task = $tasks->find($id);
        if (!$task)
            throw new PageNotFoundException('Tarefa não encontrada.');

        $tasks->delete($id);

        return redirect()->to('tasks/');
    }
}
