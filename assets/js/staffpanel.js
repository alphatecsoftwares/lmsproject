$("document").ready(() => {
  const content_pane = $("#content-pane") && $("#content-pane");
  handleGETRequest("notifications.php", content_pane);
  content_pane
    ? $(
        "#edit-ld-cost,#edit-ls-cost,#send-message,#add-location,#add-category,#home,#update-luggage-status,#edit-profile,#confirm-payment,#credit-account,#cancel-delivery,#notifications,#logout"
      ).on("click", event => {
        const { id } = event.target;
        id === "credit-account"
          ? handleGETRequest("creditaccount.php", content_pane)
          : id === "notifications"
          ? handleGETRequest("notifications.php", content_pane)
          : id === "edit-profile"
          ? handleGETRequest("edituserprofile.php", content_pane)
          : id === "cancel-delivery"
          ? handleGETRequest("canceldelivery.php", content_pane)
          : id === "update-luggage-status"
          ? handleGETRequest("updateluggagestatus.php", content_pane)
          : id === "logout"
          ? handleGETRequest("logout.php", content_pane)
          : id === "home"
          ? (location.href = "index.html")
          : id === "add-category"
          ? handleGETRequest("addcategory.php", content_pane)
          : id === "add-location"
          ? handleGETRequest("addlocation.php", content_pane)
          : id === "send-message"
          ? handleGETRequest("sendmessage.php", content_pane)
          : id === "edit-ld-cost"
          ? handleGETRequest("editluggagedeliverycost.php", content_pane)
          : id === "edit-ls-cost"
          ? handleGETRequest("editluggagestoragecost.php", content_pane)
          : null;
      })
    : null;
});

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

$("document").ready(() => {
  $("#content-pane").on(
    "submit",
    [
      "#send-mesage-form",
      "#add-category",
      "#editluggagedeliverycost",
      "#editluggagestoragecost",
      "#credit-account"
    ],
    event => {
      console.log("Event fired");
      event.preventDefault();
      const { id } = event.target;
      if (id === "send-message-form") {
        handleSendMessageForm(id);
      } else if (id === "add-category") {
        saveCategory(id);
      } else if (id === "editluggagestoragecost") {
        editLSCost(id);
      } else if (id === "editluggagedeliverycost") {
        editLDCost(id);
      } else if (id === "credit-account") {
        creditAccount(id);
      }
    }
  );
});
const editLSCost = id => {
  const lid = $("#luggageid")[0].value;
  const np = $("#new-cost")[0].value;
  const mc = $("#min-cost")[0].value;
  const cph = $("#cost-per-hour")[0].value;

  let source = id;
  const data = {
    np,
    cph,
    lid,
    source,
    mc
  };
  console.log(data);
  $.ajax({
    url: "handlepost.php",
    type: "POST",
    data,
    dataType: "json",
    success: res => {
      console.log(res);
      if (res === 200) {
        $("#msg")
          .html("Cost Updated")
          .addClass("text-success");
        setTimeout(function() {
          $("#msg")
            .html("")
            .removeClass("text-success");
        }, 6000);
      } else {
        $("#msg")
          .html("Message sending failed, try again later")
          .addClass("text-danger");
        setTimeout(function() {
          $("#msg")
            .html("")
            .removeClass("text-danger");
        }, 6000);
      }
    }
  });
};
const editLDCost = id => {
  const np = $("#new-cost")[0].value;
  const lid = $("#luggageid")[0].value;
  const mc = $("#min-cost")[0].value;

  let source = id;
  const data = {
    mc,
    np,
    lid,
    source
  };
  $.ajax({
    url: "handlepost.php",
    type: "POST",
    data,
    dataType: "json",
    success: res => {
      if (res === 200) {
        $("#msg")
          .html("Cost Updated")
          .addClass("text-success");
        setTimeout(function() {
          $("#msg")
            .html("")
            .removeClass("text-success");
        }, 6000);
      } else {
        $("#msg")
          .html("Update failed, try again later")
          .addClass("text-danger");
        setTimeout(function() {
          $("#msg")
            .html("")
            .removeClass("text-danger");
        }, 6000);
      }
    }
  });
};

const handleSendMessageForm = id => {
  const rec = $("#phone")[0].value;
  const message = $("#message")[0].value;
  let source = id;
  const data = {
    rec,
    message,
    source
  };
  $.ajax({
    url: "handlepost.php",
    type: "POST",
    data,
    dataType: "json",
    success: res => {
      if (res === 200) {
        $("#msg")
          .html("Message sent successfully")
          .addClass("text-sucess");
        setTimeout(function() {
          $("#msg")
            .html("")
            .removeClass("text-success");
        }, 6000);
      } else {
        $("#msg")
          .html("Update failed, try again later")
          .addClass("text-danger");
        setTimeout(function() {
          $("#msg")
            .html("")
            .removeClass("text-danger");
        }, 6000);
      }
    }
  });
};

const saveCategory = id => {
  const cat = $("#category")[0].value;
  let source = id;
  let data = { cat, source };
  $.ajax({
    url: "handlepost.php",
    type: "POST",
    data,
    dataType: "json",
    success: res => {
      if (res === 200) {
        $("#msg")
          .html("Category Added")
          .addClass("text-success");
        setTimeout(function() {
          $("#msg")
            .html("")
            .removeClass("text-success");
        }, 6000);
      }
    }
  });
};
const creditAccount = id => {
  const source = id;
  const cust_phone = $("#phone")[0].value;
  const amount = $("#amount")[0].value;
  const data = {
    cust_phone,
    amount,
    source
  };
  console.log(data);
  $.ajax({
    url: "handlepost.php",
    type: "POST",
    data,
    dataType: "json",
    success: res => {
      if (res === 200) {
        $("#msg")
          .html("Category Added")
          .addClass("text-success");
        setTimeout(function() {
          $("#msg")
            .html("")
            .removeClass("text-success");
        }, 6000);
      } else {
        $("#msg")
          .html("Error encountered")
          .addClass("text-danger");
        setTimeout(function() {
          $("#msg")
            .html("")
            .removeClass("text-danger");
        }, 6000);
      }
    }
  });
};
