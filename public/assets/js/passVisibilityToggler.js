const eyeIcon = document.querySelector("#js--toggleImg"); //js--toggleImg
const password = document.querySelector("#js--floatingPassword"); //js--floatingPassword

if (password) {
  let passwordValue = password.value;
  console.log(passwordValue);
} else {
  console.error("Password input field not found!");
}

const typeToggler = function (e) {
  e.preventDefault();
  if (password.type == "password") {
    password.type = "text";
  } else if (password.type == "text") {
    password.type = "password";
  }
};

eyeIcon.addEventListener("click", typeToggler);
