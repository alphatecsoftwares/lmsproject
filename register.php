<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>LMS | Register</title>
    <link
      rel="stylesheet"
      href="./assets/bootstrap/dist/css/bootstrap.min.css"
    />
  </head>
  <body>
    <div class="row justify-content-center my-5">
      <div class="col-md-6 border border-success rounded">
        <form autocomplete="off" id="editprofile" enctype="multipart/form-data">
          <div class="text-center my-3">
            <strong>Create Account</strong>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-9">
              <span id="msg">Message Here</span>
            </div>
          </div>
          <div class="row justify-content-center ">
            <div class="col-md-9 ">
              <div class="form-group d-flex">
                <input
                  type="text"
                  name="fname"
                  id="fname"
                  placeholder="First Name"
                  class="form-control mr-2"
                  required
                />
                <input
                  type="text"
                  name="lname"
                  id="lname"
                  placeholder="Last Name"
                  class="form-control mr-2"
                  required
                />
              </div>
            </div>
          </div>
          <div class="row justify-content-center ">
            <div class="col-md-9 ">
              <div class="form-group d-flex">
                <input
                  type="email"
                  name="email"
                  id="email"
                  placeholder="Email"
                  class="form-control mr-2"
                  required
                />
                <input
                  type="tel"
                  name="tel"
                  id="tel"
                  placeholder="07xxxxxxxxx"
                  class="form-control mr-2"
                  required
                />
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-md-9 ">
              <div class="form-group d-flex">
                <input
                  type="text"
                  name="username"
                  id="username"
                  placeholder="Username"
                  class="form-control mr-2"
                  required
                />
                <select
                  name="location"
                  id="location"
                  class="form-control mr-2"
                  required
                >
                  <option value="">Location</option>
                  <option value="chuka">Chuka</option>
                  <option value="chuka">Ndagani</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-md-9 ">
              <div class="form-group d-flex">
                <label for="profile" class="mr-3">Picture</label>
                <input
                  type="file"
                  name="profile"
                  id="profile"
                  class="form-control"
                />
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <div class="col-md-9 ">
              <div class="form-group d-flex">
                <button type="reset" class="btn btn-outline-warning mx-4">
                  Clear All Fields
                </button>
                <button
                  type="submit"
                  id="changeprofile"
                  class="btn btn-outline-success"
                >
                  Register
                </button>
              </div>
            </div>
          </div>

          <div class="row justify-content-center mb-5">
            <div class="col-md-9 d-flex">
              <span>Already Have Account? <a href="login.php">Login</a></span>
              <span class="float-left"
                ><a href="index.html" class="ml-5">Go Back Home</a></span
              >
            </div>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
