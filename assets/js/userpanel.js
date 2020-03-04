$("document").ready(() => {
  let content_pane = $("#content-pane") && $("#content-pane"); //check if content_pane is not  empty reference
  content_pane && handleGETRequest("notifications.php", content_pane); //display notifications by default on login
  $(
    "#home,#logout,#account,#billing,#edit-profile,#notification,#check-luggage-status,#notifications,#request-luggage-storage,#request-package-delivery"
  ).on("click", event => {
    const { id } = event.target;
    id === "request-luggage-storage"
      ? handleGETRequest("requestluggagestorage.php", content_pane)
      : id === "notifications"
      ? handleGETRequest("notifications.php", content_pane)
      : id === "edit-profile"
      ? handleGETRequest("edituserprofile.php", content_pane)
      : id === "request-package-delivery"
      ? handleGETRequest("requestluggagedelivery.php", content_pane)
      : id === "check-luggage-status"
      ? handleGETRequest("checkluggagestatus.php", content_pane)
      : id === "billing"
      ? handleGETRequest("billing.php", content_pane)
      : id === "account"
      ? handleGETRequest("account.php", content_pane)
      : id === "logout"
      ? handleGETRequest("logout.php", content_pane)
      : id === "home"
      ? (location.href = "index.html")
      : null;
  });
});

$("document").ready(() => {
  $("#content-pane").on(
    "submit",
    ["#requestluggagestorage,#requestluggagedelivery,#editprofile"],
    event => {
      event.preventDefault();
      const { id } = event.target;
      if (id === "requestluggagestorage") {
        processRequestLuggageStorage(id);
      } else if (id === "editprofile") {
        const file = $("#profile");
        editProfile(file, id);
      } else if (id === "requestluggagedelivery") {
        saveLuggageDeliveryRequestDetails(id);
      }
    }
  );
});

const editProfile = (file, id) => {
  const fname = $("#fname")[0].value;
  const location = $("#location")[0].value;
  const lname = $("#lname")[0].value;
  const tel = $("#tel")[0].value;
  const email = $("#email")[0].value;
  const password = $("#password")[0].value;
  const cpassword = $("#cpassword")[0].value;

  if (password === cpassword) {
    let file_data = file.prop("files")[0];
    console.log(file_data);
    // let form_data = new FormData();
    let data = {
      file_data,
      source: id,
      fname,
      lname,
      tel,
      email,
      password,
      location
    };

    $.ajax({
      url: "handlepost.php",
      type: "POST",
      enctype: "multipart/form-data",
      data,
      contentType: false,
      cache: false,
      success: response => {
        console.log(response);
        // if (response === 200) {
        //   console.log(response === 200);
        //   $("#msg").innerHTML = "Image Uploaded Successfull";
        // } else if (response === 400) {
        //   $("#msg").html("Empty form passed");
        // } else if (response === 403) {
        //   $("#msg").html(
        //     "Forbidden file uploaded, please upload only jpg, jpeg and png files"
        //   );
        // }
      }
    });
  } else {
    $("#msg")
      .html("Passwords do not match")
      .addClass("text-danger");
  }
};
const processRequestLuggageStorage = id => {
  const ltype = $("#luggagetype")[0].value;
  const name = $("#name")[0].value;
  const datefrom = $("#datefrom")[0].value;
  const dateto = $("#dateto")[0].value;
  const location = $("#location")[0].value;
  // console.log(ltype);
  data = {
    ltype,
    name,
    datefrom,
    dateto,
    location,
    source: id
  };
  // console.log(data);
  $.ajax({
    url: "handlepost.php",
    type: "POST",
    data,
    success: response => {
      console.log(response);
    }
  });
};

// fn to fetch a particular page
const handleGETRequest = (page, element) => {
  // page: page to be async fetched, element: where the loaded page will be rendered
  const request = new XMLHttpRequest();
  request.open("GET", page, true);
  request.onload = () => {
    // render the loaded page if open() runs successfully

    if (request.status === 200)
      if (request.readyState === 4) {
        //if the get request executes and returns some response
        element.html(request.response);
      }
  };
  request.send();
};

const saveLuggageDeliveryRequestDetails = id => {
  const ltype = $("#luggagetype")[0].value;
  const datefrom = $("#datefrom")[0].value;
  const dateto = $("#dateto")[0].value;
  const fname = $("#fname")[0].value;
  const lname = $("#lname")[0].value;
  const tel = $("#tel")[0].value;
  const email = $("#email")[0].value;
  data = {
    ltype,
    datefrom,
    dateto,
    location,
    source: id,
    fname,
    lname,
    email,
    password,
    tel
  };
  // console.log(data);
  $.ajax({
    url: "handlepost.php",
    type: "POST",
    data,
    success: response => {
      console.log(response);
    }
  });
};
