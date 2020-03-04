<form id="updateluggagestatus" method="POST">
  <div class="text-center mt-3">
    <strong>Luggagge Status Form</strong>
  </div>
  <div class="text-center text-info font-weight-light">
    Details provided here will be automatically relayed to the concerned
    customer
  </div>
  <div class="row justify-content-center mt-3">
    <div class="col-md-9">
      <div class="form-group">
        <input
          class="form-control"
          type="text"
          name="luggage"
          id="luggage "
          placeholder="Enter Luggage ID"
        />
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-9">
      <textarea
        class="form-control"
        name="cancel-reason"
        id="cancel-reason"
        cols="60"
        rows="4"
        placeholder="Update Details"
      ></textarea>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-9 ">
      <div class="form-group">
        <button
          type="reset"
          class="btn btn-outline-warning form-control w-25 my-5"
        >
          Reset Fields
        </button>
        <button
          type="submit"
          class="btn btn-outline-success form-control w-25 my-5"
        >
          Update
        </button>
      </div>
    </div>
  </div>
</form>
