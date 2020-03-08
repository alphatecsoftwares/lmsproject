$("document").ready(() => {
  const content_pane = $("#content-pane") && $("#content-pane");
  handleGETRequest("notifications.php", content_pane);
  content_pane
    ? $(
        "#home,#booking-reports,#add-staff,#edit-profile,#remove-staff,#delivery-reports,#notifications,#logout"
      ).on("click", event => {
        const { id } = event.target;
        id === "add-staff"
          ? handleGETRequest("addstaff.php", content_pane)
          : id === "notifications"
          ? handleGETRequest("notifications.php", content_pane)
          : id === "edit-profile"
          ? handleGETRequest("editstaffdetails.php", content_pane)
          : id === "delivery-reports"
          ? handleGETRequest("deliveryreports.php", content_pane)
          : id === "booking-reports"
          ? handleGETRequest("bookingreports.php", content_pane)
          : id === "logout"
          ? handleGETRequest("logout.php", content_pane)
          : id === "remove-staff"
          ? handleGETRequest("removestaff.php", content_pane)
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
