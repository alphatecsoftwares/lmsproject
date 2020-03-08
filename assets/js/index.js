$("document").ready(() => {
  data = {
    submit: "submit"
  };
  $.ajax({
    url: "dbUtils.php",
    type: "POST",
    data,
    success: res => {
      // console.log(res);
    }
  });
});
