import CookieConsent from "./cookie-consent.js";
import OttoIdLabel from "/public/assets/js/otto/otto-id-label.js";
import OttoLink from "/public/assets/js/otto/otto-link.js";
import OttoFormatDate from "/public/assets/js/otto/otto-format-date.js";
import OttoEpicene from "/public/assets/js/otto/otto-epicene.js";

document.addEventListener("DOMContentLoaded", function () {
  // clickable table rows
  const ottoIdLabel = new OttoIdLabel(".otto-id-label");
  ottoIdLabel.replace();

  OttoEpicene.choose("kx-gender");

  OttoLink.urls(".otto-url");
  OttoLink.emails(".otto-email");
  OttoLink.calls(".otto-phone");

  OttoFormatDate.searchAndFormat(".otto-date");

  document.querySelectorAll("a.print").forEach(function (link) {
    link.addEventListener("click", function (e) {
      window.print();
    });
  });

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
  const textContent = document.querySelector(".long-text-content");

  if (textContent && textContent.offsetHeight > 500) {
    const labelFold = "Masquer";
    const labelExpand = "Lire la suite";

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

  new CookieConsent();
});
