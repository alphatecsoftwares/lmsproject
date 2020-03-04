$("document").ready(() => {
  console.log("Index Page Loaded");
  data = {
    submit: "submit"
  };
  $.ajax({
    url: "dbUtils.php",
    type: "POST",
    data,
    success: res => {
      console.log(res);
    }
  });
});
