$(document).ready(function () {
  var form = $("#registerForm");

  var username = $("#username").val();
  var email = $("#email").val();
  var password = $("#password").val();
  var birthdate = $("#birthdate").val();
  var phone_number = $("#phone_number").val();
  var url = $("#url").val();

  form.submit(function (e) {
    e.preventDefault();

    if (
      validateUsername(username) &&
      validateEmail(email) &&
      validatePassword(password) &&
      validateBirthdate(birthdate) &&
      validatePhoneNumber(phone_number) &&
      validateURL(url)
    ) {
      $.ajax({
        url: "register.php",
        method: "POST",
        data: {
          username: username,
          email: email,
          password: password,
          birthdate: birthdate,
          phone_number: phone_number,
          url: url,
        },
        success: function (response) {
          alert(response);
        },
      });
    }
  });


  // well you can always make this validation awesome but lets stick to a simple implementation

  function validateUsername(val) { var regex = /^[a-zA-Z]+$/; return regex.test(val); }
  function validateEmail(val) { var regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/; return regex.test(val); }
  function validatePassword(val) { var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/; return regex.test(val); }
  function validateBirthdate(val) { var regex = /^\d{4}\/\d{2}\/\d{2}$/; return regex.test(val); }
  function validatePhoneNumber(val) { var regex = /^\d{10}$/; return regex.test(val); }
  function validateURL(val) { var regex = /^(https?:\/\/)?([\da-z.-]+)\.([a-z.]{2,6})([\/\w .-]*)*\/?$/; return regex.test(val); }
});
