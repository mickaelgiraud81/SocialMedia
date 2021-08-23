

document.addEventListener("DOMContentLoaded", function(event) {
    let Btn = document.getElementById("add_social");

    Btn.addEventListener("click", function() {
        let container = document.getElementById("form_add_socialmedia");

        let div = document.createElement("div");
        container.append(div);

        let l_img = document.createElement("label"); 
        l_img.setAttribute('for',"img_social");
        l_img.textContent = "Choisir une image";
        div.appendChild(l_img);

        let img = document.createElement("input"); 
        img.setAttribute('type',"file");
        img.setAttribute('name',"img_social");
        div.appendChild(img); 

        let l_name = document.createElement("label"); 
        l_name.setAttribute('for',"name_social");
        l_name.textContent = "Nom du réseau social";
        div.appendChild(l_name);

        let i_name = document.createElement("input"); 
        i_name.setAttribute('type',"text");
        i_name.setAttribute('name',"name_social");
        div.appendChild(i_name);

        let l_link = document.createElement("label"); 
        l_link.setAttribute('for',"link_social");
        l_link.textContent = "Lien";
        div.appendChild(l_link);

        let i_link = document.createElement("input"); 
        i_link.setAttribute('type',"text");
        i_link.setAttribute('name',"link_social");
        div.appendChild(i_link);

    });
});