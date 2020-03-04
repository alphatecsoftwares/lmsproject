<form id="removestaff" method="POST">
  <div class="text-center mt-3">
    <strong>Remove Staff Form</strong>
  </div>
  <div class="text-center text-info font-weight-light">
    Please provide the following details
  </div>
  <div class="row justify-content-center mt-3">
    <div class="col-md-9">
      <div class="form-group">
        <input
          class="form-control"
          type="text"
          name="staff-id"
          id="staff-id "
          placeholder="Staff ID"
        />
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-9">
      <textarea
        class="form-control"
        name="removal-reason"
        id="removal-reason"
        cols="60"
        rows="4"
        placeholder="Reason(s) for removal"
      ></textarea>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-9 ">
      <div class="form-group">
        <button
          type="submit"
          class="btn btn-outline-danger form-control w-25 my-5"
        >
          Remove Staff
        </button>
      </div>
    </div>
  </div>
</form>
