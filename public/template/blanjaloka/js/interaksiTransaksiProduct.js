const quantity = document.getElementById("quantity-product");
var quantityParsedInt = parseInt(quantity.innerHTML);
var stok = 20;
var valueTotHarga = document.getElementById("total-harga");
var valueHarga = document.getElementById("harga-satuan");

checkQuantity();

//KETIKA TOMBOL TAMBAHKAN KERANJANG DIKLIK
document.getElementById("tambahkan-keranjang-btn").addEventListener("click", () => {
    quantity.innerHTML = "1";
    quantityParsedInt = 1;
    ubahTotHarga();

    let test = document.getElementById("interaksi-transaksi-modal").getElementsByClassName("modal-title")[0];
    test.innerHTML = "Buah Segar Apel Purbalinggo";
    
    //cek font size
    if (test.classList.contains("fs-6")){
        test.classList.remove("fs-6");
    }
    //mengganti fontsize jadi 4
    test.classList.add("fs-4");

    //ganti penamaan di elemen submit button
    document.getElementById("submit-btn").innerHTML = "Masukan ke Keranjang";
    
    console.log("ke klik nih:");
    console.log(test);
})

//KETIKA TOMBOL BUAT TAWARAN DIKLIK
document.getElementById("buat-tawaran-btn").addEventListener("click", () => {
    quantity.innerHTML = "1";
    quantityParsedInt = 1;
    ubahTotHarga();

    let test = document.getElementById("interaksi-transaksi-modal").getElementsByClassName("modal-title")[0];
    test.innerHTML = "";

    //cek font size
    if (test.classList.contains("fs-4")){
        test.classList.remove("fs-4");
    }
    //mengganti fontsize jadi 6
    test.classList.add("fs-6");
    let title = document.createTextNode = "Pak Makmur  menjual dengan harga 28.500";

    //membuat profile picture kecil di modal penawaran
    let profilePicture = document.createElement("img");
    profilePicture.src = "images/pak-sudjaya.svg";
    profilePicture.classList.add("img-fluid","rounded-circle","me-2");
    profilePicture.width = 38;
    test.appendChild(profilePicture);
    test.append(title);
    

    //ganti penamaan di elemen submit button
    document.getElementById("submit-btn").innerHTML = "Buat Penawaran";
})


function checkQuantity() {
    //Kondisi Saat Quantitas 1, maka button min dinonaktifkan
    if (quantityParsedInt == 1) {
        document.getElementById("action-min").classList.add("text-secondary-light", "disabled");
    }
    else {
        document.getElementById("action-min").classList.remove("text-secondary-light","disabled");
    }

    //Kondisi Saat Quantitas 20, maka button plus dinonaktifkan
    if (quantityParsedInt >= stok) document.getElementById("action-plus").classList.add("text-secondary-light", "disabled");
    
    else document.getElementById("action-plus").classList.remove("text-secondary-light", "disabled");

}

function ubahTotHarga(){
    //Menghapus titik pada innerHTML harga satuan, bertujuan agar dapat parse from str to Integer
    let hargaSatuanHasilSplit = valueHarga.innerHTML.substr(3).split(".");
    console.log(hargaSatuanHasilSplit[0] + hargaSatuanHasilSplit[1]);

    //Konversi hargaSatuan dari str to Int, guna dapat dioperasikan valuenya
    let hargaSatuan = parseInt(hargaSatuanHasilSplit[0] + hargaSatuanHasilSplit[1]);
    console.log(hargaSatuan);

    //Total Harga didapatkan dari harga satuan dikali dengan kuantitas
    let totHarga = hargaSatuan * quantityParsedInt;
    console.log("RP."+totHarga);

    valueTotHarga.innerHTML = "Rp." + totHarga;

    //Algoritma menambahkan format titik pada rupiah
    var totalHargaStr = totHarga.toString();
    console.log("TEST:" + totalHargaStr);
    var hitung = 0;
    var temp;
    var temp2 = "";

    if (totalHargaStr.length > 3) {
        for (i=totalHargaStr.length-1 ; i >= 0 ; i--){

            hitung++;
            if (hitung == 3 || (hitung == 3 && i == 0)){
                if (hitung == 3 && i==0){
                    temp = totalHargaStr.substring(i,i+3) + temp2;    
                }
                else {
                    temp =  "." + totalHargaStr.substring(i,i+3) + temp2;
                }
                temp2 = temp;
                hitung = 0;
                console.log(temp);
                if (i<=2) temp = totalHargaStr.substring(0,i) + temp2;
            }
            console.log(i);
        }
    }

    console.log(temp);

    valueTotHarga.innerHTML = "Rp." + temp;


}
//Untuk Tombol mengurangi kuantitas
function decQuantity(){
    quantityParsedInt -= 1;
    quantity.innerHTML = quantityParsedInt;

    ubahTotHarga();
    checkQuantity();
}
//Untuk Tombol menambahkan kuantitas
function incQuantity(){
    quantityParsedInt += 1;
    quantity.innerHTML = quantityParsedInt;

    ubahTotHarga();
    checkQuantity();
}