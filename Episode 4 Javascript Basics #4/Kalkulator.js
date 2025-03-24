const kalkulator = {
    tambah: (...angka) => angka.reduce((a, b) => a + b, 0),
    kurang: (...angka) => angka.reduce((a, b) => a - b),
    kali: (...angka) => angka.reduce((a, b) => a * b, 1),
    bagi: (...angka) => angka.reduce((a, b) => a / b),
    modulus: (...angka) => angka.reduce((a, b) => a % b)
};

console.log(kalkulator.tambah(2, 4));
console.log(kalkulator.kurang(2, 4));
console.log(kalkulator.kali(2, 4));
console.log(kalkulator.bagi(2, 4));
console.log(kalkulator.modulus(2, 4)); 