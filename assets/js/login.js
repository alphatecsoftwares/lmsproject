$("document").ready(() => {
  console.log("Script loaded");
  $("#login-form,#staff-login-form").on("submit", e => {
    e.preventDefault();
    let { id } = e.target;
    if (id === "staff-login-form") {
      const user = $("#phone")[0].value;
      const pass = $("#password")[0].value;
      // const submit = $("#submit")[0].value;
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
          console.log(res);
          if (res === 201) {
            console.log("Success");
            location.href = "staffpanel.php";
          } else if (res === 404) {
            $("#msg")
              .html("Username or password incorrect")
              .addClass("text-danger");
            setTimeout(() => {
              $("#msg")
                .html("")
                .removeClass("text-danger");
            }, 6000);
          } else if (res === 200) {
            console.log("Success");
            location.href = "adminpanel.php";
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
    } else if (id === "login-form") {
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
    }
  });
});
