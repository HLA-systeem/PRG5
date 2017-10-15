/*$

$(document).ready(function(){
    $('#public').on('click', function(){
        /*$.ajax({
            method: 'POST',
            url: url,
            data: {}
        })
    });
});
*/

window.addEventListener("load", function(){
    document.getElementById('public').addEventListener('click', function(){
        var req = new XMLHttpRequest();
        var publicValue = document.getElementById('public').checked; //.value just returns 'on'
        console.log(publicValue);/*
        req.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //save data
            }
        req.open("POST", "", true); //last two user & pass
        req.send("public=" + publicValue);
        }*/
    });
});
