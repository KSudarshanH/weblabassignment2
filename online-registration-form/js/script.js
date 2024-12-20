$(document).ready(function () {
  $('#registrationForm').on('submit', function (e) {
    e.preventDefault();

    // Basic form validation
    if (!validateForm()) {
      return false;
    }

    // Show loading state
    $('#submitBtn').prop('disabled', true).text('Submitting...');

    // Collect form data
    const formData = $(this).serialize();

    // Submit form using AJAX
    $.ajax({
      type: 'POST',
      url: 'process.php',
      data: formData,
      dataType: 'json',
      success: function (response) {
        console.log('Response received:', response);
        if (response.status === 'success') {
          displayResult(response.data, true);
        } else {
          displayResult('Registration failed: ' + response.message, false);
        }
      },
      error: function (xhr, status, error) {
        console.error('AJAX Error:', {
          status: status,
          error: error,
          responseText: xhr.responseText
        });
        displayResult('An error occurred. Technical details: ' + error, false);
      },
      complete: function () {
        $('#submitBtn').prop('disabled', false).text('Submit Registration');
      }
    });
  });

  function displayResult(data, isSuccess) {
    const resultDiv = $('#registrationResult');
    resultDiv.removeClass('hidden success error');

    if (isSuccess) {
      resultDiv.addClass('success');
      resultDiv.html(`
              <h2>Registration Successful!</h2>
              <div class="registration-details">
                  <p><strong>Name:</strong> ${data.fullName}</p>
                  <p><strong>Email:</strong> ${data.email}</p>
                  <p><strong>Phone:</strong> ${data.phone}</p>
                  <p><strong>Date of Birth:</strong> ${data.dob}</p>
                  <p><strong>Gender:</strong> ${data.gender}</p>
                  <p><strong>Address:</strong> ${data.address}</p>
                  <p><strong>Education:</strong> ${data.education}</p>
              </div>
          `);

      $('#registrationForm')[0].reset();
    } else {
      resultDiv.addClass('error');
      resultDiv.html(`<h2>Error</h2><p>${data}</p>`);
    }

    resultDiv.show();
    $('html, body').animate({
      scrollTop: resultDiv.offset().top
    }, 500);
  }
});