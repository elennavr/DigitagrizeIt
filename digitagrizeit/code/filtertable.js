function filterTable(searchbar, databaseTable, column, no_results) {
  var input, filter, table, tr, td, i, txtValue, no_res;
  input = document.getElementById(searchbar);
  no_res = document.getElementById(no_results);
  filter = input.value.toUpperCase();
  table = document.getElementById(databaseTable);
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[column];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
        no_results.style.visibility = "visible";
      } else {
        tr[i].style.display = "none";
        no_results.style.visibility = "hidden";
      }
    }       
  }
}

onkeyup="var num = filterTable('search-bar-database','database', 3, 'no_results')"