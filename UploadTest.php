<html>
 <head>
  <title>PHP Test</title>
 </head>
 <body>
    <button onclick="nyLink()">Test knapp</button>
    
    <div id="test" style="margin-top:100px; width:100px; height:100px;"></div>
    <script>
    function nyLink(){
        //Henter inn info fra bruker
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
        //Legger til a element innenfor en div
        form.appendChild(navnLabel);
        form.appendChild(navn);
        form.appendChild(linkLabel);
        form.appendChild(link);
        form.appendChild(submit);
        document.getElementById("test").appendChild(form);

    }

    </script>
 </body>
</html>