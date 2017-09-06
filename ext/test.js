//window.onclick=  function(event) { alert("abba "+event.toString())};

chrome.runtime.sendMessage("Hello World");

$("a").click(function(e) {

   /* event.preventDefault();

    // The URL to POST our data to
    var postUrl = 'https://localhost:8080/aw/index.php';

    // Set up an asynchronous AJAX POST request
    var xhr = new XMLHttpRequest();
    xhr.open('POST', postUrl, true);

    // Prepare the data to be POSTed by URLEncoding each field's contents
    var email = "Ankit";
    var password = "Goyal";

    var params = 'email=' + email +
        '&password=' + password;

    // Handle request state change events
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) { // complete and no errors
            alert(xhr.responseText); // some processing here, or whatever you want to do with the response
        }
    };

    // Send the request and set status
    xhr.send(params);


*/
    $.ajax({
        type: "POST",
        action: 'xhttp',
        url: "https://aw-assignment1.herokuapp.com/index.php",
        data: {myData:"urlretained"},
        success: function(response){
            alert(response+'Items added');
        },
        error: function(e){
            console.log(e.message);
            alert(e.message+'  Addition Failed');
        }
    });

    alert("aadda"+e.target.toString()); // gives the element's ID
     // gives the elements class(es)
});


$("input").click(function(e) {
    alert("aaa"+e.target.toString()); // gives the element's ID
    // gives the elements class(es)
});
