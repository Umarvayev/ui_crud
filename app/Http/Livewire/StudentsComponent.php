<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Students;

class StudentsComponent extends Component
{
    public $student_id, $name, $email, $phone, $student_edit_id, $student_delete_id;

    public $view_student_id, $view_student_name, $view_student_email, $view_student_phone;
    // Input fields on update validation
    public function update($fields)
    {
        $this->validateOnly($fields, [
            'student_id' => 'required|unique:students,student_id,'.$this->student_edit_id.'', //validation with ignoring own data
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
            'student_id' => 'required|unique:students,student_id,'.$this->student_edit_id.'', //validation with ignoring own data
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

         session()->flash('massage','Student has been updated successfully');

           //For hide modal after add student success
        $this->dispatchBrowserEvent('close-modal');
    }

    //delete Confirmation
    public function deleteConfirmation($id)
    {
        //$student = Students::where('id', $id)->first();

        $this->student_delete_id = $id; //Student id

        $this->dispatchBrowserEvent('show-delete-confirmation-modal');
    }

    public function deleteStudentData()
    {
        $student = Students::where('id', $this->student_delete_id)->first();
        $student -> delete();

        session()->flash('massage','Student has been deleted successfully');

        $this->dispatchBrowserEvent('close-modal');

        $this->student_delete_id = '';
    }

    public function cancel()
    {
        $this->student_delete_id = '';
    }

    public function viewStudentDetalis($id)
    {
        $student = Students::where('id', $id)->first();

        $this->view_student_id = $student->student_id;
        $this->view_student_name = $student->name;
        $this->view_student_email = $student->email;
        $this->view_student_phone = $student->phone;

        $this->dispatchBrowserEvent('show-edit-student-modal');
    }

    public function closeViewStudentModal()
    {
        $this->view_student_id = '';
        $this->view_student_name = '';
        $this->view_student_email = '';
        $this->view_student_phone = '';
    }
    public function render()
    {
        //get all students
        $students = Students::all();
        return view('livewire.students-component', ['students'=>$students])->layout('livewire.layouts.base');
    }
}
