<div>
    <div class="containre">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <h5 style="float: left;"><strong>All Students</strong></h5>
                        <button class="btn btn-sm btn-primary" style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New Student </button>
                    </div>

                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>

  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" >Add New Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <from wire:submit.prevent="storeStudentData">
                <div class="form-group row">
                    <label for="student_id" class="col-3">Student ID</label>
                    <div class="col-9">
                        <input type="number" id="student_id" class="form-control" wire:modal="student_id">
                        @error('student_id')
                        <span class="text-danger" style="font-size: 11.5px">{{ $message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="name" class="col-3">Name</label>
                    <div class="col-9">
                        <input type="number" id="name" class="form-control" wire:modal="name">
                        @error('name')
                           <span class="text-danger" style="font-size: 11.5px">{{ $message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-3">Email</label>
                    <div class="col-9">
                        <input type="number" id="email" class="form-control" wire:modal="email">
                        @error('email')
                           <span class="text-danger" style="font-size: 11.5px">{{ $message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="
                    phone" class="col-3">Phone</label>
                    <div class="col-9">
                        <input type="number" id="
                        phone" class="form-control" wire:modal="
                        phone">
                        @error('
                        phone')
                           <span class="text-danger" style="font-size: 11.5px">{{ $message}}</span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row">
                    <label for="student_id" class="col-3"></label>
                    <div class="col-9">
                        <button type="submit" class="btn btn-sm btn-primary">Add Student</button>
                    </div>
                </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</div>
