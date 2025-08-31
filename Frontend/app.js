const elements = document.querySelectorAll("li");

elements.forEach((element)=>
{
    element.addEventListener("mouseenter" , () =>
    {
        element.querySelector(".created_at").classList.add("visible");
    });
    element.addEventListener("mouseleave" , () =>
    {
        element.querySelector(".created_at").classList.remove("visible");
    });
    console.log(element);
})
