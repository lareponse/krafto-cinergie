document.addEventListener("DOMContentLoaded", function () {
  // clickable table rows

  document.querySelectorAll(".table-clickable").forEach(function (table) {
    table.addEventListener("click", function (e) {
      const target = e.target;
      const row = target.closest("tr");
      if (row) {
        const action = row.getAttribute("data-action");
        if (action) {
          window.location.href = action;
        }
      }
    });
  });

});
