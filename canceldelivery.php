<form id="requestluggagestorage" method="POST">
  <div class="text-center mt-3">
    <strong>Cancel Delivery Form</strong>
  </div>
  <div class="text-center text-danger font-weight-light">
    Please note cancellation will initiate automatic refund to the customer
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
        placeholder="Details for Cancellation"
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
          Cancel Delivery
        </button>
      </div>
    </div>
  </div>
</form>
