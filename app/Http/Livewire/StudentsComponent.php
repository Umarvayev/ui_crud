<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StudentsComponent extends Component
{
    public $student_id, $name, $email, $phone;


    // Input fields on update validation
    public function update($fields)
    {
        $this->validateOnly($fields, [
            'student_id' => 'required|unique:students', //Students = table name
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required|numberic',
        ]);
    }
    public function storeStudentData()
    {

    }
    public function render()
    {
        return view('livewire.students-component')->layout('livewire.layouts.base');
    }
}
