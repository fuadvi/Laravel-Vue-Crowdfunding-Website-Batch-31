// soal 1
const daftarHewan = ["2. Komodo", "5. Buaya", "3. Cicak", "4. Ular", "1. Tokek"];
daftarHewan.sort()
daftarHewan.forEach((hewan) => {
  console.log(hewan)
})

// soal 2
function introduce(data) {
  return `Nama saya ${data.name}, Umur saya ${data.age}, alamat saya di jalan ${data.address}, saya punya hobi yaitu ${data.hobby}`
}
const data = { name: "John", age: 30, address: "Jalan Pelesiran", hobby: "Gaming" }

const perkenalan = introduce(data)
console.log(perkenalan)  

// soal 3
function hitung_huruf_vokal(data){
  return data.match(/[aeiou]/g).length;
}

const a = hitung_huruf_vokal("aaeuibbab")
console.log(a)

// soal 4
function hitung(x) {
  return 2 * x - 2
}

console.log(hitung(1))
