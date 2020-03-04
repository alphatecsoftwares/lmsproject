$("document").ready(() => {
  const content_pane = $("#content-pane") && $("#content-pane");
  handleGETRequest("notifications.php", content_pane);
  content_pane
    ? $(
        "#home,#update-luggage-status,#edit-profile,#confirm-payment,#credit-account,#cancel-delivery,#notifications,#logout"
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
