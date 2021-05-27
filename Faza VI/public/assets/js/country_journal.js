
function insertTrash(list,parent){
    let trash=document.createElement("button");
    trash.classList.add("bottomButton");
    let itr=document.createElement("i");
    itr.classList.add("fas");
    itr.classList.add("fa-trash-alt");
    trash.appendChild(itr);
    trash.addEventListener("click",function (){
        deleteReview(parent.id);
        list.removeChild(parent);
    });
    return trash;
}

function insertReview(data,list,country){
    let elem=document.createElement("li");
    elem.id=data["id_rev"];
    elem.appendChild(insertTrash(list,elem));
    let link=document.createElement("a");
    link.setAttribute("href",reviewUrl+"/"+data["id_rev"]);
    link.classList.add("revName");
    link.innerText=data["title"];
    elem.appendChild(link);
    elem.appendChild(document.createElement("br"));
    let place=document.createElement("div");
    place.innerHTML=data["place"]+", "+country+" &nbsp;&nbsp;"+data["date_posted"];
    elem.appendChild(place);
    place=document.createElement("div");
    place.innerHTML=data["text"];

    elem.appendChild(place);
    list.appendChild(elem);

}
let places=[];
function insertOption(place,select){
    for(let i=0;i<places.length;i++){
        if(places[i]==place)return;
    }
    places.push(place);
    let opt=document.createElement("option");
    opt.classList.add("content");
    opt.value=place;
    opt.innerText=place;
    select.appendChild(opt);
}

/*
* <option class="content" value="All visited cities" onclick="fAll()">All visited cities</option>
        <option class="content" value="Moscow" onclick="fM()">Moscow</option>
        <option class="content" value="Sankt Petersburg"onclick="fP()">Sankt Petersburg</option>
*
*
* */
function insertData(data){
    let country=data[0]["country"];
    let header=document.getElementsByTagName("h1");
    if(country!=null)header[0].innerHTML=country+" ";
    else header[0].innerHTML="My Travel Journal";
    if(country!=null){
        let img=document.createElement("img");
        img.setAttribute("src","https://flagcdn.com/48x36/"+data[0]["code"]+".png")
        header[0].appendChild(img);
    }

    let list= document.getElementById("JournalList");
    let select=document.getElementById("dropdown_list");
    if(country==null){
        select.style.display="none";
    }
    for(let i=1;i<data.length;i++){
        insertReview(data[i],list,data[0]["country"]);
        if(country!=null)insertOption(data[i]["place"],select);
    }




}

function setListener(){
    let select=document.getElementById("dropdown_list");
    let list= document.getElementById("JournalList");
    select.addEventListener("change",function (){
        let child=list.childNodes[0];
        while(child!=null){
            list.removeChild(child);
            child=list.childNodes[0];
        }
        let place=select.value;
        if(place=="All visited cities") ajaxCall();
        ajaxCall(place);
    });
}

