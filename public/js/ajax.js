window.addEventListener('load', function(){
    document.getElementById('public').addEventListener('click', function(){
        var req = new XMLHttpRequest();
        var publicValue = document.getElementById('public').checked; //.value just returns 'on'

        req.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
            }
        };
        req.open('POST', sendTo, true); //last two user & pass
        req.setRequestHeader('X-CSRF-TOKEN', token)
       
        let data = JSON.stringify({"value":publicValue, "id":id}); 
        req.send(data);
    });

    var searchBar = document.getElementById('search');
});
