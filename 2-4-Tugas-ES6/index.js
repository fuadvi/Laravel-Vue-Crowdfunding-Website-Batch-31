
// soal 2
const newFunction = function literal(firstName, lastName) {
  return {
    firstName: firstName,
    lastName: lastName,
    fullName: function(){
      console.log(firstName + " " + lastName)
    }
  }
}

// jawaban soal 2
const newFunction2 = (firstName, lastName) => ({
  firstName: firstName,
  lastName: lastName,
  fullName: () => console.log(firstName + " " + lastName)
})

//Driver Code 
// newFunction("William", "Imoh").fullName() 



// soal 3
const newObject = {
  firstName: "Teuku",
  lastName: "Fuad maulana",
  address: "Jalan sepanjang kenangan",
  hobby: "playing basketball",
}

// jawaban soal 3
const { firstName, lastName, address, hobby } = newObject
console.log(firstName, lastName, address, hobby)


// soal 4
const west = ["Will", "Chris", "Sam", "Holly"]
const east = ["Gill", "Brian", "Noel", "Maggie"]
const combined = west.concat(east)

// jawaban soal 4
const gabungkan = [
  ...west,
  ...east
]

//Driver Code
console.log(gabungkan)


// soal  5
const planet = "earth" 
const view = "glass" 
var before = 'Lorem ' + view + 'dolor sit amet, ' + 'consectetur adipiscing elit,' + planet 

// jawaban soal 5
const after = `Lorem  ${view} dolor sit amet, consectetur adipiscing elit, ${planet} `
console.log(after)