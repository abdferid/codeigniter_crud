<?php

namespace App\Models;

use CodeIgniter\Model;

class Tasks extends Model
{
    protected $table = 'tasks_table';
    protected $allowedFields = ['title', 'description', 'deadline', 'status', 'created_at', 'updated_at'];

    // You don't need a constructor in this case.

    public function insert_data($data)
    {
        // Insert data into the tasks_table
        $this->insert($data);

        // Check if insertion was successful
        if ($this->db->affectedRows() > 0) {
            // Return the ID of the inserted row
            return $this->db->insertID();
        } else {
            // Return false if insertion failed
            return false;
        }
    }
}
?>
