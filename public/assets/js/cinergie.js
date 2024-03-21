document.addEventListener("DOMContentLoaded", function () {
  // clickable table rows
  const tables = document.querySelectorAll(".table-clickable");
  tables.forEach(function (table) {
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

  document.querySelectorAll("a.print").forEach(function (link) {
    link.addEventListener("click", function (e) {
      window.print();
    });
  });
});
