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

  /* long text expander */
  const labelFold = "Masquer";
  const labelExpand = "Lire la suite";

  const textContent = document.querySelector(".long-text-content");
  if (textContent) {
    const textContentHeight = textContent.offsetHeight;

    if (textContentHeight > 500) {
      textContent.classList.add("folded");
      textContent.insertAdjacentHTML(
        "afterend",
        '<button class="btn btn-primary toggle-button">' +
          labelExpand +
          "</button>"
      );

      let toggleButton = document.querySelector(".toggle-button");
      toggleButton.addEventListener("click", function () {
        textContent.classList.toggle("expanded");
        if (textContent.classList.contains("expanded")) {
          toggleButton.textContent = labelFold;
        } else {
          toggleButton.textContent = labelExpand;
        }
      });
    }
  }
});
