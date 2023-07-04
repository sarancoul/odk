var imgs = document.querySelectorAll(".rows");
var imgModal = document.getElementById("imgModal");
var modal = document.getElementById("modal"); 
var btnEdit = document.createElement("button");
    btnEdit.className = "button";
    btnEdit.innerHTML = "Modifier";
    btnEdit.type = "submit";

   
/*
var imgModal = document.querySelector("#imgModal");

*/
   // permet de parrcouris un tableau d'elements ici notre tableau element imgs (imgs)
    for (let i = 0; i < imgs.length; i++) {

        console.log("test===========",imgs[i]);

        // Ajout d'un evenenment ecouteur ici nous ciblé le click
         imgs[i].addEventListener("click",function (e) {
            // je vais reccupere le src de l'image clické avec this.src et le reattribuer à l'image modal
             var allTd = this.querySelectorAll("td");
             var allInput = modal.querySelectorAll(".modalElem");
             console.log(allTd,allInput);
                for (let t = 0; t < allTd.length-1; t++) {
                    if(t == 0){
                        allInput[t].src = allTd[t].querySelector('img').src;
                        console.log("chemin foto=========",allInput[t].src)
                    }else
                    allInput[t].value = allTd[t].innerHTML;
                    
                }
           
            modal.style.display = "block";
            modal.querySelector("div").appendChild(btnEdit);
                modal.addEventListener("click",function () {
                     //   modal.style.display = "none";
                })           
            });
        
    }

   