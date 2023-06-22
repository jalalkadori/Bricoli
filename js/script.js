/*******************
 * hide and show the password feild whene clicking on the eye icon
 *******************/
  function togglePasswordVisibility() {
    var passwordInput = document.getElementById("password");
    var toggleIcon = document.querySelector(".toggle-icon");

    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      toggleIcon.innerHTML = '<i class="fas fa-eye-slash"></i>';
    } else {
      passwordInput.type = "password";
      toggleIcon.innerHTML = '<i class="fas fa-eye"></i>';
    }
  }

/*******************
 * hide and show the password feild whene clicking on the eye icon
 *******************/ 