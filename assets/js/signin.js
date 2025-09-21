const by_otp = document.querySelectorAll(".by_otp");
const by_pass = document.querySelectorAll(".by_pass");

const sign_in_otp = document.getElementById("sign_in_otp");
const sign_in_pass = document.getElementById("sign_in_pass");

const sign_in_form = document.getElementById("sign_in_form");

const email_field = document.getElementById("email");
const pass_field = document.getElementById("pass");

sign_in_pass.addEventListener("click", (e) => {
  e.preventDefault();
  by_otp.forEach((el) => el.classList.add("d-none"));
  by_pass.forEach((el) => el.classList.remove("d-none"));
});

sign_in_otp.addEventListener("click", (e) => {
  e.preventDefault();
  by_pass.forEach((el) => el.classList.add("d-none"));
  by_otp.forEach((el) => el.classList.remove("d-none"));
});

document.getElementById("send_otp").addEventListener("click", (e) => {
  e.preventDefault();

  if (email_field.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
    sign_in_form.action = "./handlers/sendOTPEmail.php";
    sign_in_form.submit();
  }
});

document.getElementById("email_pass_sign_in").addEventListener("click", (e) => {
  e.preventDefault();

  if (
    email_field.value.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/) &&
    pass_field.value.length > 0
  ) {
    sign_in_form.action = "./handlers/emailPassSignIn.php";
    sign_in_form.submit();
  }
});
