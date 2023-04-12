// Adding custom pure JavaScript tp validate date field.
document.querySelector('#movie-add-form').addEventListener('submit', function (event) {
    // Getting Date Value from field.
    var dateField = document.querySelector('#edit-release-date-0-value-date');
    var dateValue = dateField.value;
    // Getting current Date.
    var currentDate = new Date().getTime();
    // Converting selected Date to time.
    var selectedDate = new Date(dateValue).getTime();
    // Compare if selected date is greater than now.
    if (selectedDate > currentDate) {
      // Disable submit.
      event.preventDefault();
      // Adding custom class to date field.
      dateField.classList.add('future_date');
    }
});
