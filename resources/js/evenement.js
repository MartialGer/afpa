document.addEventListener('DOMContentLoaded', function () {

    document.querySelector('#rechercher').addEventListener('keyup', () => {

        let input = document.getElementById("rechercher");
        let value = input.value;
        let table = document.getElementById("tableEvenements");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            console.log(rows[i].getElementsByTagName("td")[3]);

            if (rows[i].getElementsByTagName("td")[3] !== undefined) {

                let cible = rows[i].getElementsByTagName("td")[3];
                let targetText = cible.textContent.toLowerCase();

                if (value === "" || targetText.includes(value.toLowerCase())) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }
    });

    document.querySelector('#visibilite').addEventListener('change', () => {

        let select = document.getElementById("visibilite");
        let filterValue = select.value;
       
        let table = document.getElementById("tableEvenements");
        let rows = table.getElementsByTagName("tr");

        for (let i = 1; i < rows.length; i++) {
            
            let visibilite = rows[i].getElementsByTagName("td")[0];
    
            if (filterValue === "all" || visibilite.textContent === filterValue) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    });

});