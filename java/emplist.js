
document.querySelectorAll('.toggle-details').forEach(item => {
  item.addEventListener('click', function () {
    const row = this.closest('tr'); // Get the row element (tr)
    row.classList.toggle('expanded'); // Toggle the expanded class to show/hide details
  });
});
