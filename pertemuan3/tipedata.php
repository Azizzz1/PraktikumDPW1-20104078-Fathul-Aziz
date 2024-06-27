<?php 
$name = "Fathul Aziz";
$address = '123 PWT'

<!-- integer -->
 $age = 27;
 $quantity = 10;

// float
$price = 10.99;
$tax_rate = 0.08

// boolean
$is_active = true;
$is_admin = false

// array
$fruits = array("apple", "banana", "orange");
$numbers = [1, 2, 3 , 4 , 5];

// object
class Person {
  public $name;
  public $age;
  }
  $person = new Person();
  $person->name = "Kang Daniel";
  $person->age = 26;

  // null
  $no_value = null;

  // operator
  $a = 10;
  $b = 5;
  $c = $a + $b; //penjumlahan
  $d = $a - $b; //pengurangan
  $e = $a * $b; //perkalian
  $f = $a / $b; //pembagian
  $g = $a % $b; //modulus
  $h = $a ** $b; //pangkat

  // operator penugasan
  $a = 10;
$b = 5;
$a += $b; // $a sekarang bernilai 15 (sama dengan $a = $a + $b)
$a -= $b; // $a sekarang bernilai 10 (sama dengan $a = $a - $b)
$a *= $b; // $a sekarang bernilai 50 (sama dengan $a = $a * $b)
$a /= $b; // $a sekarang bernilai 10 (sama dengan $a = $a / $b)
$a %= $b; // $a sekarang bernilai 0 (sama dengan $a = $a % $b)
$a .= $b; // $a sekarang bernilai "105" (sama dengan $a = $a . $b)

//operator pembanding
$a = 10;
$b = 5;
if ($a == $b) {
//kode yang akan dijalankan jika $a sama dengan $b
}
if ($a != $b) {
//kode yang akan dijalankan jika $a tidak sama dengan $b
}
if ($a > $b) {
//kode yang akan dijalankan jika $a lebih besar dari $b
}
if ($a < $b) {
//kode yang akan dijalankan jika $a lebih kecil dari $b
}
if ($a >= $b) {
//kode yang akan dijalankan jika $a lebih besar atau sama dengan $b
}
if ($a <= $b) {
//kode yang akan dijalankan jika $a lebih kecil atau sama dengan $b
}

// operator logika
$a = 10;
$b = 5;
if ($a > 0 && $b > 0) {
//kode yang akan dijalankan jika $a dan $b lebih besar dari 0
}
if ($a > 0 || $b > 0) {
//kode yang akan dijalankan jika $a atau $b lebih besar dari 0
}
if (!($a > 0)) {
//kode yang akan dijalankan jika $a tidak lebih besar dari 0
}

// operator increment dan decrement
$a = 10;
$b = 5;
$a++; // $a sekarang bernilai 11
$b--; // $b sekarang bernilai 4

// struktur kontrol
$age = 26;
if ($age >= 17) {
echo "You are eligible to vote.";
} else {
echo "You are not eligible to vote yet.";
}
// for
for ($i = 1; $i <= 10; $i++) {
  echo $i . " ";
  }

// while
$i = 1;
while ($i <= 10) {
  echo $i . " ";
  $i++;
  }
// switch
$day = "Monday";
switch ($day) {
case "Monday":
echo "Today is Monday.";
break;
case "Tuesday":
echo "Today is Tuesday.";
break;
default:
echo "Today is another day.";
break;
}

 ?>