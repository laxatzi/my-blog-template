window.onload = function () {
  document
    .querySelector("#js--togglePassword")
    .addEventListener("click", function () {
      var passwordField = document.getElementById("js--floatingPassword");
      passwordField.type =
        passwordField.type === "password" ? "text" : "password";
    });
};
