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

  abstract public function serang();
  abstract public function diserang();
}

class Elang extends Hewan
{
  use Fight;


  public function serang()
  {
    return 'a';
  }
  public function diserang()
  {
    return 'x';
  }

  function atraksi()
  {
    return 'a';
  }
  public function getInfoHewan($nama)
  {
    return $this->nama = $nama;
  }
}

$tes = new Elang;

echo $tes->getInfoHewan('Harimau');
