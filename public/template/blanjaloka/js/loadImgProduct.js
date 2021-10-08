//membuat element logic saat image masih loading
const placeholder = document.createElement("div");
placeholder.style = "height: 178px";
placeholder.className = "bg-secondary";
console.log("placeholder:");
console.log(placeholder);
const parentPlaceholder = document.querySelectorAll(".card-kategori .card");

console.log("parent placeholder:");
console.log(parentPlaceholder);
console.log("Banyak: " + parentPlaceholder.length);

//Membuat element image
const image = document.createElement("img");
image.src = "images/jeruk-pakistan.svg";
image.className ="card-img-top";
console.log("element img");
console.log(image);


for (i = 0; i < parentPlaceholder.length ; i++){
    let placeholder = document.createElement("div");
    placeholder.style = "height: 178px";
    placeholder.className = "bg-secondary";
    console.log("placeholder:");
    console.log(placeholder);
    
    parentPlaceholder[i].insertBefore(placeholder, parentPlaceholder[i].childNodes[0]);
    
    console.log(i);
    console.log(parentPlaceholder[i]);
}

//keadaan setelah loading
window.addEventListener("load", (event) => {
    for (let i=0; i< parentPlaceholder.length; i++){
        let image = document.createElement("img");

        if (i==0 || i==3 || i==4 || i==7) {
            image.src = "images/jeruk-pakistan.jpg";
        }
        else if (i==1 || i==5){
            image.src = "images/mangga-muda.jpg";
        }
        else if (i==2 || i==6){
            image.src = "images/nanas-madu.jpg";
        }
        
        image.className = "card-img-top";
        //Hapus placeholder dan masukan image yg dimaksud
        parentPlaceholder[i].childNodes[0].remove();
        parentPlaceholder[i].insertBefore(image,parentPlaceholder[i].childNodes[0]);
    }
})