<?php

namespace App\Controllers;

use App\Models\Tasks;

class Home extends BaseController
{
    public function index()
{
    $tasksModel = new Tasks();

    $data['tasks'] = $tasksModel->where('status', 1)->findAll();

    return view('welcome_message.php', $data);
}

}