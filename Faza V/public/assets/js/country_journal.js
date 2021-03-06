let p=null;
function insertTrash(list,parent,title){
    let trash=document.createElement("button");
    trash.classList.add("bottomButton");
    let itr=document.createElement("i");
    itr.classList.add("fas");
    itr.classList.add("fa-trash-alt");
    trash.id="trash"+parent.id;
    $(document).on("click","#trash"+parent.id,function (){
        document.getElementById("bodyM").innerHTML+=" "+title+"?"
        $("#myModal").modal('show');
        p=parent;
    });

    trash.appendChild(itr);
    return trash;
}

function insertReview(data,list,country){
    let elem=document.createElement("li");
    elem.id=data["id_rev"];
    elem.classList.add("forList");

    let div=document.createElement("div");
    div.classList.add("grid");
    let placetime=document.createElement("div");

    let sign=document.createElement("img");
    sign.src=plcURL;
    placetime.appendChild(sign);
    placetime.innerHTML+="&nbsp"+data["place"]+", "+data["country"]+"<br>";
    placetime.id="placetime";
    let cal=document.createElement("img");
    cal.src=calURL;
    placetime.appendChild(cal);
    placetime.innerHTML+="&nbsp"+data["date_posted"];
    placetime.classList.add("w-25");

    div.appendChild(placetime);
    let d=document.createElement("div");
    let link=document.createElement("a");
    link.setAttribute("href",reviewUrl+"/"+data["id_rev"]);
    link.classList.add("revName");
    link.classList.add("listTitle");
    link.innerHTML="<b> &nbsp"+data["title"]+" &nbsp</b>";
    link.classList.add("my-auto");
    d.appendChild(link);
    d.classList.add("text-center");
    d.classList.add("w-50");
    d.classList.add("align-items-center");
    d.classList.add("d-flex");
    div.appendChild(d);


    div.appendChild(insertTrash(list,elem,data["title"]));
    elem.appendChild(div);
    elem.innerHTML+="<br>";
    list.appendChild(elem);
    div.addEventListener("click",function(){
       alert();
    });
}
let places=[];
function insertOption(place,country,select,button,list){

    for(let i=0;i<places.length;i++){
        if(places[i]==place)return;
    }
    places.push(place);
    let opt=document.createElement("a");
    opt.classList.add("dropdown-item");
    opt.value=place;
    let str= place+", "+country;
    if(str.length>25)
        opt.innerHTML=place+",<br>"+country;
    else
        opt.innerHTML=str;
    opt.addEventListener("click",function(){
       button.innerText=opt.innerText;
       eventHandler(list,opt);
    });
    select.appendChild(opt);
}

function insertDefaultMsg(list,country){
    let elem=document.createElement("li");
    elem.classList.add("forList");
    let excl=document.createElement("img");
    excl.src=exclURL;
    excl.style.marginBottom="10px";
    elem.appendChild(excl);
    if(country!=null)elem.innerHTML+=" It looks like you haven't written anything about your experiences in "+country+" yet! Hurry up and save your memories!";
    else elem.innerHTML+=" It looks like you haven't wrote anything jet! Hurry up and save your memories!";
    elem.style.fontSize="30px";
    list.appendChild(elem);
}

function insertData(data){
    let country=data[0]["country"];
    let header=document.getElementsByTagName("h1");

    if(country!=null){
        let img=document.createElement("img");
        img.setAttribute("src","https://flagcdn.com/48x36/"+data[0]["code"].toLowerCase()+".png");
        header[0].innerHTML="";
        header[0].appendChild(img);
        header[0].innerHTML+=" "+country+" ";
        header[0].appendChild(img);
    }
    else{
        header[0].innerHTML="My Travel Journal";
    }

    let list= document.getElementById("JournalList");
    let select=document.getElementById("menu");
    let button=document.getElementById("dropdownMenuButton");

    if(data.length<=1){
        insertDefaultMsg(list,data[0]["country"]);
    }
    $("#ok").on("click",function(){
        deleteReview(p.id);
        list.removeChild(p);
    });
    for(let i=1;i<data.length;i++){
        insertReview(data[i],list,data[0]["country"]);
        insertOption(data[i]["place"],data[i]["country"],select,button,list);
    }
    $("body").fadeTo("slow",1);

}
function eventHandler(list,selected){
    let child=list.childNodes[0];
    while(child!=null){
        list.removeChild(child);
        child=list.childNodes[0];
    }
    let place=selected.innerHTML;

    if(place=="All visited cities") {

        ajaxCall();
    }
    else {
        ajaxCall(place);
    }
}

$(document).ready(function(){
   $("#all").click(function(){
       $("#dropdownMenuButton").text($("#all").text());
       let list= document.getElementById("JournalList");
       eventHandler(list,$("#all"));
   }) ;

   $("#back").click(function(){
      window.location.href=backURL;
   });



});

