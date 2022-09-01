const inputSearch = document.querySelector("[placeholder='Search']");
const autoComp = document.getElementById("autoComp");
const searchBtn= document.getElementById('searchBtn');
const xhrurl =autoComp.dataset.xhrurl
let id_movie ="";



inputSearch.addEventListener(
    "keyup",
    (e) => {
        const inputText = e.target.value;
        fetch(xhrurl+"?resultat="+inputText)
            .then((reponse) => {
                return reponse.json();
            })
            .then((json) => {  
                affichage(json);
            })
            
    }

)

function affichage(json) {
    if (json.length !== 0) {
        autoComp.innerHTML = "";
        let retour = "";
        json.forEach(element => {
            retour += `<div onclick= "validComplete('${element.title}','${element.id_movie}')"> ${element.title}</div>`;
        });
        autoComp.innerHTML = retour;
        
    }else{
        autoComp.innerHTML = "On a pas trouvé alors cherche ailleurs";
    }
    
}
function validComplete(value,id){ 
   inputSearch.value =value;
   autoComp.innerHTML = ""; 
   retour= "";
   id_movie=id;
   
}
searchBtn.addEventListener("click",()=>{
    console.log("blablabla");
    if (id_movie !== ""){
        
        location.href=searchBtn.dataset.xhrurl+"?id_movie="+id_movie;
    }
})
