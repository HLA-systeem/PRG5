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
                        li.setAttribute("class", "well list-group-item");
                        a.appendChild(li);

                        var divRow = document.createElement("div");
                        divRow.setAttribute("class", "row");
                        li.appendChild(divRow);

                        var div1 = document.createElement("div");
                        var div2 = document.createElement("div");
                        div1.setAttribute("class", "col-xs-8");
                        div2.setAttribute("class", "col-xs-4");
                        divRow.appendChild(div1);
                        divRow.appendChild(div2);
                        
                        var span = document.createElement("span");
                        span.innerHTML = project.title;
                        div2.appendChild(span);
                        
                        
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

