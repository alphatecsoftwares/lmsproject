<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-6 col-md-offset-3">
      <div class="well well-sm">
        <form class="form-horizontal" id="send-message-form" method="post">
          <fieldset>
            <legend class="text-center">Send Message</legend>
            <div class="text-center"><span id="msg"></span></div>
            <div class="form-group">
              <div class="col-md-9">
                <input
                  id="phone"
                  name="phone"
                  type="text"
                  placeholder="Recipient Phone Number"
                  class="form-control"
                />
              </div>
            </div>

            <!-- Message body -->
            <div class="form-group">
              <div class="col-md-9">
                <textarea
                  class="form-control"
                  id="message"
                  name="message"
                  placeholder="Please enter your message here..."
                  rows="5"
                ></textarea>
              </div>
            </div>

            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-12 text-right">
                <button
                  id="send-msg-btn"
                  type="submit"
                  class="btn btn-primary btn-lg"
                >
                  Submit
                </button>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</div>
