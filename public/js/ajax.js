window.addEventListener('load', function(){
    var req = new XMLHttpRequest();

    document.getElementById('public').addEventListener('click', function(){
        var publicValue = document.getElementById('public').checked; 

        req.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
            }
        };
        req.open('POST', sendTo, true); //last two user & pass
        req.setRequestHeader('X-CSRF-TOKEN', token)
       
        var data = new FormData();
        data.append('value', publicValue);
        data.append('id', id);
        req.send(data);
    });

    document.getElementById('searchBar').addEventListener('onkeyup', function(){
        var q = document.getElementById('searchBar').value; 

        req.onreadystatechange = function(){
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
            }
        };
        req.open('POST', sendTo, true); //last two user & pass
        req.setRequestHeader('X-CSRF-TOKEN', token)
       
        var data = new FormData();
        data.append('q', q);
        req.send(data);
    });
    
});

