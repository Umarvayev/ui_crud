<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Students;

class StudentsComponent extends Component
{
    public $student_id, $name, $email, $phone, $student_edit_id;


    // Input fields on update validation
    public function update($fields)
    {
        $this->validateOnly($fields, [
            'student_id' => 'required|unique:students', //Students = table name
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);
    }
    public function storeStudentData()
    {
        // on form submit validation
        $this->validate([
            'student_id' => 'required|unique:students', //Students = table name
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        //Add Student Data
        $student = new Students();
        $student->student_id = $this->student_id;
        $student->name = $this->name;
        $student->email = $this->email;
        $student->phone = $this->phone;

        $student->save();

        session()->flash('massage','New student has been added successfully');

        $this->student_id = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->student_edit_id = '';


        //For hide modal after add student success
        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetInputs()
    {
        $this->student_id = '';
        $this->name = '';
        $this->email = '';
        $this->phone = '';
    }

    public function editStudents($id)
    {
        $student = Students::where('id', $id)->first();

        $this->student_edit_id = $student->id;
        $this->student_id = $student->student_id;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->phone = $student->phone;

        $this->dispatchBrowserEvent('show-edit-student-modal');
    }

    public function editStudentData()
    {
        // on form submit validation
        $this->validate([
            'student_id' => 'required|unique:students', //Students = table name
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
        ]);

        $student = Students::where('id', $this->student_edit_id)->first();
         $student->student_id = $this->student_id;
         $student->name = $this->name;
         $student->email = $this->email;
         $student->phone = $this->phone;

         $student->save();

         session()->flash('massage','New student has been updated successfully');

           //For hide modal after add student success
        $this->dispatchBrowserEvent('close-modal');
    }

    public function render()
    {
        //get all students
        $students = Students::all();
        return view('livewire.students-component', ['students'=>$students])->layout('livewire.layouts.base');
    }
}
