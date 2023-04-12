
document.addEventListener('DOMContentLoaded', function () {
    document.querySelector('#rechercher').addEventListener("input", () => {
        let input = document.getElementById("rechercher");
        let value = input.value;
        let articles = document.getElementsByTagName("article");

        console.log(articles);

        for (let i = 0; i < articles.length; i++) {
            let cible1 = articles[i].getElementsByTagName("h1")[0];
            let cible2 = articles[i].getElementsByTagName("p")[0];

            if (value === "" || cible1.textContent.includes(value) || cible2.textContent.includes(value)) {
                articles[i].style.display = "";
            } else {
                articles[i].style.display = "none";
            }
        }
    });
});