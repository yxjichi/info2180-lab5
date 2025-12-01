document.addEventListener("DOMContentLoaded", function () {

    // country lookup
    document.getElementById("lookup").addEventListener("click", async function () {
        const country = document.getElementById("country").value;
        const url = "world.php?country=" + encodeURIComponent(country);

        const response = await fetch(url);
        const data = await response.text();
        document.getElementById("result").innerHTML = data;
    });

    // cities lookup
    document.getElementById("lookup-cities").addEventListener("click", async function () {
        const country = document.getElementById("country").value;
        const url = "world.php?country=" + encodeURIComponent(country) + "&lookup=cities";

        const response = await fetch(url);
        const data = await response.text();
        document.getElementById("result").innerHTML = data;
    });

});
