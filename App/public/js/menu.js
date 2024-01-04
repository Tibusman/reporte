var menu1 = document.getElementById("menu1");
var name1 = document.getElementById("name");
var submenu = document.getElementById("submenu");
var inicio = document.getElementById("inicio");
var reporte = document.getElementById("reporte");
var mantenimiento = document.getElementById("mantenimiento");
var respaldo = document.getElementById("respaldo");
var usuario = document.getElementById("usuario");
var equipo = document.getElementById("equipo");
var fill = document.getElementsByClassName("fill");
var modal = document.getElementsByClassName("modal");

window.addEventListener("load", ()=>{
    if(document.getElementsByClassName("modal") !== null)
    {
        for(let i=0; i<modal.length; i++)
        {
            modal[i].style.visibility="visible";
        }
    }
})

window.addEventListener("keyup",(e)=>{
    if(e.key === "Escape")
    {
        menu1.style.display="none";
        closeSubMenu();
    }
})

init();

function init()
{
    isactive();
}

function isactive()
{
    if(module === "inicio")
    {
        inicio.classList.add("active");
    }
    if(module === "reporte")
    {
        reporte.classList.add("active");
    }
    if(module === "mantenimiento")
    {
        mantenimiento.classList.add("active");
    }
    if(module === "respaldo")
    {
        respaldo.classList.add("active");
    }
    if(module === "usuario")
    {
        usuario.classList.add("active");
    }
    if(module === "equipo")
    {
        equipo.classList.add("active");
    }

}
name1.addEventListener("click", ()=>{
    if(menu1.style.display==="block")
    {
        menu1.style.display="none";
    }
    else
    {
        menu1.style.display="block";
    }
})

function LoadSubMenu(area)
{
    submenu.style.transform = "translatex(75%)";
    submenu.style.translate = ".35s";
    fill[0].style.display="none";
    fill[1].style.display="none";
    fill[2].style.display="none";
    fill[3].style.display="none";
    fill[4].style.display="none";
    if(area === "reporte")
    {
        fill[0].style.display="block";
    }
    if(area === "mantenimiento")
    {
        fill[1].style.display="block";
    }
    if(area === "respaldo")
    {
        fill[2].style.display="block";
    }
    if(area === "usuario")
    {
        fill[3].style.display="block";
    }
    if(area === "equipo")
    {
        fill[4].style.display="block";
    }
}

function closeSubMenu()
{
    submenu.style.transform = "translatex(-100%)";
}