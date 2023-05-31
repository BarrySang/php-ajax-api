let requestParams = {
    // method: "PUT",
    method: "POST",
    // method: "DELETE",
    // method: "GET",
    // url: "../server/update.php",
    // url: "../server/read.php?id=1",
    url: "../server/create.php",
    // url: "../server/delete.php",
    data: "firstname=john&lastname=doe&username=johndoe&email=john2@gmail.com&password=john123"
}

// "firstname=john&lastname=doe&username=johndoe&email=john@gmail.com&password=john123"

function request() {
    let xhttp = new XMLHttpRequest();
    xhttp.open(requestParams.method, requestParams.url);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(requestParams.data);
    // xhttp.send();
    xhttp.onload = function () {
        console.log(xhttp.responseText);
    }
}

request();