window.addEventListener('load', function(){
    var req = new XMLHttpRequest();
    if(document.getElementById('public') != null){
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
    }

    if(document.getElementById('searchBar') != null){
        document.getElementById('searchBar').addEventListener('keyup', search);
        document.getElementById('searchBar').addEventListener('paste', search);
    }

    function search(){
        setTimeout(function(){ 
            var q = document.getElementById('searchBar').value;
            
            req.onreadystatechange = function(){
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText)
                    var parent = document.getElementById('projectList');
                    parent.innerHTML = null;

                    for(let i=0; i<response.projects.length;i+=1){
                        var project = response.projects[i];
                
                        var a = document.createElement("a");
                        a.setAttribute("href", "/projects/" + project.id);
                        
                        var li = document.createElement("li");
                        li.setAttribute("class", "well list-group-item col-xs-12 row");
                        a.appendChild(li);
                        
                        var span = document.createElement("span");
                        span.innerHTML = project.title;
                        li.appendChild(span);
                        
                        
                        parent.appendChild(a);
                    }
                }
            };
            req.open('POST', sendTo, true); //last two user & pass
            req.setRequestHeader('X-CSRF-TOKEN', token)
        
            var data = new FormData();
            data.append('q', q);
            req.send(data);
        }, 1000);
    }
});

