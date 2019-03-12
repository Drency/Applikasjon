<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
    <button onclick="nyLink()">Test knapp</button>

    <p id="terje"></p>

    <div id="test" style="margin-top:100px; width:100px; height:100px;"></div>
    <script>
        function nyLink(){
        
        //Lager form
        var form = document.createElement("form");
        
        var navnLabel = document.createElement("p");
        navnLabel.innerHTML = "Link navnet";
        var navn = document.createElement("input");
        
        var linkLabel = document.createElement("p");
        linkLabel.innerHTML = "URL:";
        var link = document.createElement("input");

        var submit = document.createElement("button");
        submit.innerHTML = "Submit";
        submit.style = "margin-top:5px;";
            
        //Legger inn elementene i form
        form.appendChild(navnLabel);
        form.appendChild(navn);
        form.appendChild(linkLabel);
        form.appendChild(link);
        form.appendChild(submit);

        //Legger for til på siden
        document.getElementById("test").appendChild(form);

        }

        

    </script>
 </body>
</html>