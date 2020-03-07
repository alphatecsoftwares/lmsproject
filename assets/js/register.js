$("document").ready(() => {
  $("#register-form").on("submit", event => {
    console.log("Loaded");
    event.preventDefault();
    const fname = $("#fname")[0].value;
    const lname = $("#lname")[0].value;
    const email = $("#email")[0].value;
    const tel = $("#tel")[0].value;
    const location = $("#location")[0].value;
    const password = $("#password")[0].value;
    const cpassword = $("#cpassword")[0].value;
    const source = event.target.id;

    if (password === cpassword && password.length > 7) {
      const data = {
        fname,
        lname,
        email,
        location,
        password,
        cpassword,
        source,
        tel
      };
      console.log(data);

      $.ajax({
        url: "handlepost.php",
        type: "POST",
        data,
        dataType: "json",
        success: res => {
          let elements = [
            $("#fname"),
            $("#lname"),
            $("#email"),
            $("#location"),
            $("#password"),
            $("#cpassword"),
            $("#tel")
          ];
          if (res === 200) {
            console.log("Success");
            // window.Location.pathname = "/userpanel.php";
            // // location.href = "userpanel.php";
            $("#msg")
              .html(
                "Successfully registered, Please log in to access your portal"
              )
              .addClass("text-success");
            clearFields(elements);
          } else if (res === 300) {
            $("#msg")
              .html("User already exists")
              .addClass("text-danger");
            setTimeout(() => {
              $("#msg")
                .html("")
                .removeClass("text-danger");
            }, 6000);
          } else if (res === 400) {
            $("#msg")
              .html("Error Occured, please try again later")
              .addClass("text-danger");
            setTimeout(() => {
              $("#msg")
                .html("")
                .removeClass("text-danger");
            }, 6000);
          }
        }
      });
    } else {
      $("#msg")
        .html("Password should match and be greater than 7 characters")
        .addClass("text-danger");
      setTimeout(() => {
        $("#msg")
          .html("")
          .removeClass("text-danger");
      }, 6000);
    }
  });
});

const clearFields = elements => {
  elements.forEach(element => {
    element.innerHTML = "";
  });
};
