document.addEventListener("DOMContentLoaded", function () {

  // clickable table rows
  const tables = document.querySelectorAll(".table-clickable")
  tables.forEach(function (table) {
    table.addEventListener("click", function (e) {
      const target = e.target
      const row = target.closest("tr")
      if (row) {
        const action = row.getAttribute("data-action")
        if (action) {
          window.location.href = action
        }
      }
    })
  })

  document.querySelectorAll(".humanDate").forEach(function (date) {
    date.innerHTML = humanDate(date.innerHTML);
  })

});

// yyyy-mm-dd hh:mm:ss to (d)d month yyyy
const humanDate = (date) => {
  const mois = [
    "janvier",
    "février",
    "mars",
    "avril",
    "mai",
    "juin",
    "juillet",
    "août",
    "septembre",
    "octobre",
    "novembre",
    "décembre",
  ];

  const [annee, moisIndex, jour] = date.split(" ")[0].split("-");
  const moisEnLettres = mois[moisIndex - 1];
  return `${parseInt(jour)} ${moisEnLettres} ${annee}`;
}