<?php

abstract class Hewan
{
  public $nama;
  public $darah = 50;
  public $jumlahKaki;
  public $keahlian;

  abstract public function atraksi();
}

trait Fight
{
  public $attackPower, $defencePower;

  abstract public function serang($defencePower);
  abstract public function diserang($defencePower);
}

class Elang extends Hewan
{
  use Fight;

  public function __construct($jumlahKaki = 2, $keahlian = "terbang tinggi", $attackPower = 10, $defencePower = 5, $nama = "Elang")
  {
    $this->jumlahKaki = $jumlahKaki;
    $this->keahlian = $keahlian;
    $this->attackPower = $attackPower;
    $this->defencePower = $defencePower;
    $this->nama = $nama;
  }

  public function serang($defencePower)
  {
    echo PHP_EOL;
    echo "$this->nama sedang menyerang harimau";
    echo PHP_EOL;
    $this->diserang($defencePower);
  }
  public function diserang($defencePower)
  {
    $this->darah = $this->darah - $this->attackPower / $defencePower;
    echo "harimau sedang diserang darah sisa $this->darah";
  }

  function atraksi()
  {

    return "$this->nama sedang $this->keahlian";
  }

  public function getInfoHewan($jenis)
  {
    return "Info Hewan" . PHP_EOL .
      "jumlah kaki " . $this->jumlahKaki . PHP_EOL .
      "keahlian " . $this->keahlian . PHP_EOL .
      "kekuatan serang " . $this->attackPower . PHP_EOL .
      "pertahanan " . $this->defencePower . PHP_EOL .
      "jenis binatang " . $jenis;
  }
}
class Harimau extends Hewan
{
  use Fight;

  public function __construct($jumlahKaki = 4, $keahlian = "lari cepat", $attackPower = 7, $defencePower = 8, $nama = "Harimau")
  {
    $this->jumlahKaki = $jumlahKaki;
    $this->keahlian = $keahlian;
    $this->attackPower = $attackPower;
    $this->defencePower = $defencePower;
    $this->nama = $nama;
  }

  public function serang($defencePower)
  {
    echo PHP_EOL;
    echo "$this->nama sedang menyerang Elang";
    echo PHP_EOL;
    $this->diserang($defencePower);
  }
  public function diserang($defencePower)
  {
    $this->darah = $this->darah - $this->attackPower / $defencePower;
    echo "Elang sedang diserang darah sisa $this->darah";
  }

  function atraksi()
  {

    return "$this->nama sedang $this->keahlian";
  }

  public function getInfoHewan($jenis)
  {
    return "Info Hewan" . PHP_EOL .
      "jumlah kaki " . $this->jumlahKaki . PHP_EOL .
      "keahlian " . $this->keahlian . PHP_EOL .
      "kekuatan serang " . $this->attackPower . PHP_EOL .
      "pertahanan " . $this->defencePower . PHP_EOL .
      "jenis binatang " . $jenis;
  }
}


$elang = new Elang();
echo $elang->getInfoHewan(get_class($elang));
$elang->serang(10);

$harimau = new Harimau();
echo $harimau->getInfoHewan(get_class($harimau));
$harimau->serang(10);
