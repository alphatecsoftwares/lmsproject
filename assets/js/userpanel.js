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
        editProfile(id);
      } else if (id === "requestluggagedelivery") {
        saveLuggageDeliveryRequestDetails(id);
      }
    }
  );
});

const editProfile = id => {
  const fname = $("#fname")[0].value;
  const location = $("#location")[0].value;
  const lname = $("#lname")[0].value;
  const email = $("#email")[0].value;
  const password = $("#password")[0].value;
  const cpassword = $("#cpassword")[0].value;

  const elements = [
    $("#fname")[0],
    $("#location")[0],
    $("#lname")[0],
    $("#email")[0],
    $("#password")[0],
    $("#cpassword")[0]
  ];

  if (password === cpassword) {
    if (password.length > 7) {
      let source = id;
      let data = {
        fname,
        lname,
        email,
        password,
        location,
        source
      };
      // console.log(source);
      $.ajax({
        url: "handlepost.php",
        type: "POST",
        data,
        dataType: "JSON",
        success: response => {
          if (response[0]) {
            $("#msg")
              .html("Profile Updated Successfully")
              .removeClass("text-danger")
              .addClass("text-success");
            clearFields(elements); //clear fields after successful submission
            setTimeout(function() {
              //timeout fn to remove the message field by setting its innerText to empty after 5000 ms
              $("#msg")
                .html("")
                .removeClass("text-sucess");
            }, 5000);
          }
        }
      });
    } else {
      $("#msg")
        .html("Passwords should be atleast 8 characters long")
        .addClass("text-danger");
      setTimeout(function() {
        $("#msg").html("");
      }, 5000);
    }
  } else {
    $("#msg")
      .html("Passwords do not match")
      .addClass("text-danger");
    setTimeout(function() {
      $("#msg")
        .html("")
        .removeClass("text-sucess");
    }, 5000);
  }
};
// fn to clear fields form elements
const clearFields = elements => {
  elements.forEach(element => {
    element.html("");
  });
};

const getDeliveryCost = (luggageType, origin, dest) => {
  if (luggageType && origin && dest) {
    const data = {
      luggageType,
      origin,
      dest,
      source: "get-delivery-cost"
    };
    console.log(data);
    $.ajax({
      url: "handlepost.php",
      type: "POST",
      data,
      dataType: "JSON",
      success: res => {
        console.log(res);
      }
    });
  }
};
//this segment handles luggage storage form
$(document).ready(() => {
  let df = null;
  let dt = null;
  let ltype = null;

  $("#content-pane").on(
    "change",
    ["form #datefrom", "form #dateto", "form #luggageid"],
    event => {
      let source = "get-storage-cost";
      if (event.target.id === "datefrom") {
        df = event.target.value;
      } else if (event.target.id === "dateto") {
        dt = event.target.value;
      } else if (event.target.id === "luggageid") {
        ltype = event.target.value;
      }
      if (dt && df && ltype) {
        //when date from, date to and luggage type is provided, calculate the cost
        if (dt !== df) {
          //check to see that date from and to are not same
          const dfj = new Date(df);
          const dtj = new Date(dt);
          const today = new Date();
          if (dfj >= today && dtj >= today) {
            //dates should be greater than 2day
            let dateDif = Math.abs(dtj - dfj); //date difference in ms
            let days = dateDif / 3600000 / 24; //convert time to days
            console.log(dateDif, days);
            $.ajax({
              url: "handlepost.php",
              type: "POST",
              data: {
                ltype,
                days,
                source
              },
              dataType: "JSON",
              success: res => {
                console.log(res);
                if (res) {
                  $("#cost").html(res);
                }
              }
            });
          } else {
            $("#msg")
              .html("Date should be greater or equal to today")
              .addClass("text-danger");
            $("#dateto,#datefrom").addClass("border border-danger");
            setTimeout(function() {
              $("#msg")
                .html("")
                .removeClass("text-danger");
            }, 6000);
            $("#dateto,#datefrom").on("change", () => {
              $("#dateto,#datefrom").removeClass("border border-danger");
            });
          }
        } else {
          $("#msg")
            .html("Select Different dates")
            .addClass("text-danger");
          $("#dateto,#datefrom").addClass("border border-danger");
          setTimeout(function() {
            $("#msg")
              .html("")
              .removeClass("text-danger");
          }, 6000);
          $("#dateto,#datefrom").on("change", () => {
            $("#dateto,#datefrom").removeClass("border border-danger");
          });
        }
      }
    }
  );
});
//this segment handles luggage delivery form
$(document).ready(() => {
  let ltype = null;
  let origin = null;
  let dest = null;
  $("#content-pane").on(
    "change",
    ["form #luggagetype", "form #origin", "form #destination"],
    event => {
      let source = "get-delivery-cost";
      if (event.target.id === "luggagetype") {
        ltype = event.target.value;
      } else if (event.target.id === "origin") {
        origin = event.target.value;
      } else if (event.target.id === "destination") {
        dest = event.target.value;
      }
      if (ltype && origin && dest) {
        if (origin === dest) {
          $("#msg")
            .html("Origin and Destination are same!")
            .addClass("text-danger");
          $("#origin").addClass("border border-danger");
          $("#destination").addClass("border border-danger");
          $("#destination,#origin").on("change", () => {
            $("#origin").removeClass("border border-danger");
            $("#destination").removeClass("border border-danger");
          });
          setTimeout(function() {
            $("#msg")
              .html("")
              .removeClass("text-danger");
          }, 6000);
        }
        $.ajax({
          url: "handlepost.php",
          type: "POST",
          data: {
            ltype,
            origin,
            dest,
            source
          },
          dataType: "JSON",
          success: res => {
            console.log(res);
            if (res) {
              $("#cost").html(res);
            }
          }
        });
      } else {
        // console.log("Not filled");
      }
      // let { value } = event.target;
      // let source = "get-storage-cost";
    }
  );
});

const processRequestLuggageStorage = id => {
  const ltype = $("#luggageid")[0].value;
  const name = $("#name")[0].value;
  const datefrom = $("#datefrom")[0].value;
  const dateto = $("#dateto")[0].value;
  const location = $("#location")[0].value;

  const df = new Date(datefrom);
  const dt = new Date(dateto);
  let dateDiff = Math.abs(dt - df); //date difference in ms
  let days = dateDiff / 3600000 / 24; //convert time to days
  data = {
    ltype,
    days,
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
  let source = id;
  const ltype = $("#luggagetype")[0].value;
  const tel = $("#tel")[0].value;
  const name = $("#luggage-name")[0].value;
  const origin = $("#origin")[0].value;
  const destination = $("#destination")[0].value;
  const cost = $("#cost")[0].innerHTML;

  if (tel.length !== 10) {
    $("#msg")
      .html("Phone number should be 10 digits")
      .addClass("text-danger");
    $("#tel").addClass("border border-danger");
    setTimeout(function() {
      $("#msg")
        .html("")
        .removeClass("text-danger");
    }, 6000);
    $("#tel").on("change", () => {
      $("#tel").removeClass("border border-danger");
    });
  } else {
    data = {
      origin,
      name,
      destination,
      cost,
      ltype,
      source,
      tel
    };
    console.log(data);
    $.ajax({
      url: "handlepost.php",
      type: "POST",
      data,
      dataType: "JSON",
      success: response => {
        console.log(response[0]);
      }
    });
  }
};
$(document).ready(() => {
  $("#content-pane").on("change", "#luggagestatus", event => {
    const { value } = event.target;
    $("#content-pane")
      .add("<div />")
      .text("Details Are Coming");
  });
});
