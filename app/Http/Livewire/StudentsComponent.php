<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Students;

class StudentsComponent extends Component
{
    public $student_id, $name, $email, $phone;


    // Input fields on update validation
    public function update($fields)
    {
        $this->validateOnly($fields, [
            'student_id' => 'required|unique:students', //Students = table name
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numberic',
        ]);
    }
    public function storeStudentData()
    {
        // on form submit validation
        $this->validate([
            'student_id' => 'required|unique:students', //Students = table name
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numberic',
        ]);

        //Add Student Data
        $student = new Students();
        $student->student_id = $this->student_id;
        $student->name = $this->name;
        $student->email = $this->email;
        $student->phone = $this->phone;

        $student->save();

        session()->flash('massege','New student has been added successfully');

    }
    public function render()
    {
        return view('livewire.students-component')->layout('livewire.layouts.base');
    }
}
