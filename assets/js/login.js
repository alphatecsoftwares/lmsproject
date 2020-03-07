$("document").ready(() => {
  console.log("Script loaded");
  $("#login-form").on("submit", e => {
    e.preventDefault();
    const user = $("#phone")[0].value;
    const pass = $("#password")[0].value;
    // const submit = $("#submit")[0].value;
    let { id } = e.target;
    const data = {
      user,
      pass,
      source: id
    };
    $.ajax({
      url: "handlepost.php",
      type: "POST",
      data,
      dataType: "json",
      success: res => {
        if (res === 200) {
          console.log("Success");
          location.href = "userpanel.php";
        } else if (res === 404) {
          $("#msg")
            .html("Username or password incorrect")
            .addClass("text-danger");
          setTimeout(() => {
            $("#msg")
              .html("")
              .removeClass("text-danger");
          }, 6000);
        } else {
          $("#msg")
            .html("User Does Not Exist")
            .addClass("text-danger");
          setTimeout(() => {
            $("#msg")
              .html("")
              .removeClass("text-danger");
          }, 6000);
        }
      }
    });
  });
});
