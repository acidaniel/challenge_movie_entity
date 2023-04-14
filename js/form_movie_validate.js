// Getting form for edit or add movie.
const form = (document.getElementById('movie-add-form')) ? document.getElementById('movie-add-form') : document.getElementById('movie-edit-form') ;

// Getting Date Value from field.
const dateField = document.querySelector('#edit-release-date-0-value-date');

if (form) {
  dateField.addEventListener('input', function() {
    // Getting value of selected date.
    const dateValue = dateField.value;
    // Getting current Date.
    const currentDate = new Date().getTime();
    // Converting selected Date to time.
    const selectedDate = new Date(dateValue).getTime();
    // Compare if selected date is greater than now.
    if (selectedDate > currentDate) {
      // Adding custom message to field.
      dateField.setCustomValidity('Release date cannot be in the future.');
      // Adding custom class to date field.
      dateField.classList.add('future_date');
    }
    else {
      dateField.classList.remove('future_date');
      dateField.setCustomValidity('');
    }
  });

  // Force the check of validity when date value changes.
  dateField.addEventListener('input', function() {
    if (dateField.checkValidity()) {
      dateField.setCustomValidity('');
    }
  });

  // Adding Event Listener to submit form to check validity.
  form.addEventListener('submit', function(event) {
    if (!dateField.checkValidity()) {
      // Disable submit if validity is set.
      event.preventDefault();
    }
  });
}


