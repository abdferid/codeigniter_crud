<?php
namespace App\Controllers;
   
use App\Models\Tasks;
use CodeIgniter\Controller;


class TaskController extends BaseController {

    public function add_task() {
        $data = [
            'title' => $this->request->getPost('name'),
            'description' => $this->request->getPost('details'),
            'deadline' => $this->request->getPost('deadline'),
        ];
    
        $tasksModel = new \App\Models\Tasks();
        $insertId = $tasksModel->insert_data($data);
    
        if ($insertId) {
            echo json_encode(array('success' => true, 'message' => 'Data inserted successfully with ID: ' . $insertId));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Failed to insert data.'));
        }
    }

    public function view()
{
    $taskId = $this->request->getPost('taskId');

    $tasksModel = new Tasks();

    $task = $tasksModel->find($taskId);

    if ($task) {
        return $this->response->setJSON($task);
    } else {
        return $this->response->setJSON(['error' => 'Task not found']);
    }
}

public function edit()
{
    $taskId = $this->request->getPost('taskId');

    $tasksModel = new Tasks();

    $task = $tasksModel->find($taskId);

    if ($task) {
        return $this->response->setJSON($task);
    } else {
        return $this->response->setJSON(['error' => 'Task not found']);
    }
}

public function edit_save()
{ 
    $taskId = $_POST['id'];
    $name = $_POST['name'];
    $deadline = $_POST['deadline'];
    $details = $_POST['details'];

    $tasksModel = new Tasks();

    $data = [
        'title' => $name,
        'deadline' => $deadline,
        'description' => $details
    ];

    if ($tasksModel->update($taskId, $data)) {
        $updatedTask = $tasksModel->find($taskId);
        return json_encode(['success' => true, 'message' => 'Task updated successfully', 'task' => $updatedTask]);
    } else {
        echo "Failed to update task.";
    }
  
}

public function delete(){
    $taskId = $_POST['taskId'];
    $tasksModel = new Tasks();
    $data = [
        'status' => "0",
    ];

    if ($tasksModel->update($taskId, $data)) {
        echo json_encode(array('success' => true, 'message' => 'Task deleted successfully!'));
    } else {
        echo "Failed to update task.";
    }
}


}
