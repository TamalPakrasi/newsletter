const inputs = document.querySelectorAll(".form-control");

const allowedKeys = [
  "Tab",
  "capslock",
  "Control",
  "Shift",
  "F1",
  "F2",
  "F3",
  "F4",
  "F5",
  "F6",
  "F7",
  "F8",
  "F9",
  "F10",
  "F11",
  "F12",
  "0",
  "1",
  "2",
  "3",
  "4",
  "5",
  "6",
  "7",
  "8",
  "9",
];

inputs.forEach((inp) => {
  inp.addEventListener("keydown", (e) => {
    if (!allowedKeys.includes(e.key)) {
      e.preventDefault();
    }
  });
});

document.querySelector("form").addEventListener("submit", (e) => {
  e.preventDefault();

  let data = "";

  inputs.forEach((el) => {
    data += el.value;
  });

  if (data.length === 6) {
    document.getElementById("otp").value = data;
    e.target.submit();
  }
});
