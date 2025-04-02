function sortTable() {
    const table = document.getElementById("tableBody");
    const rows = Array.from(table.rows);
    const isAscending = table.getAttribute("data-sort-order") === "asc";

    rows.sort((a, b) => {
        const totalA = parseFloat(a.cells[5].textContent.replace(/[$,]/g, "")) || 0;
    const totalB = parseFloat(b.cells[5].textContent.replace(/[$,]/g, "")) || 0;

        return isAscending ? totalA - totalB : totalB - totalA;
    });

    table.innerHTML = "";
    rows.forEach(row => table.appendChild(row));

    table.setAttribute("data-sort-order", isAscending ? "desc" : "asc");
}
