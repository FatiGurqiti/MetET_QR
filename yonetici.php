<!DOCTYPE html>
<html>
    <head>
<link rel="stylesheet" href="style.css">
<meta charset="UTF-8">
</head>
<style>
table {
margin-top:100px;
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #fff;
}
a{
    text-decoration:none;
}
</style>
    <body style="background-color: aliceblue;">
        <div style="text-align: center;" >
            <h1>YÖNETİCİ PANELİ</h1>
        </div>
        <div id="logo" style="text-align:center;" >
            <img style="width: 400px;height: 400px;text-align:center;"  src="metetyenilogo.png" >
        </div>
       
        <div id="giris" style="text-align:center;" >
            <a style="text-decoration: none;font-size: 30px;text-align:center;" href="urunekle.php">Ürün Ekle</a>
            <br>
            <a style="text-decoration: none;font-size: 30px;text-align:center;" href="mesaj.html">Mesajlar</a>


        </div>
        <div>
            <h1 style="text-align: center;" >SİPARİŞLER</h1>
            <div class="urunler">

        <table  class="table">
    
    <tr>
        <th></th>
        <th>Sipariş_ID</th>
        <th>Sipariş Adı</th>
        <th>Sipariş Adresi</th>
        <th>Sipariş Bilgisi</th>
        <th>Sipariş Fiyatı</th>
        <th>Sipariş Telefon</th>
        <th>Sipariş Notu</th>
        <th>Sipariş Ödeme</th>


        <th></th>
    </tr>

<!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

<?php 


include 'database.php';
        $user_check_query2 = "SELECT * FROM product";
$result2 = mysqli_query($db,$user_check_query2);
while($row=$result2 -> fetch_array() ){

    $id=$row['siparis_id'];
    $ad=$row['siparis_adi'];
    $fiyat=$row['siparis_fiyat'];
    $adres=$row['siparis_adres'];
    $odeme=$row['siparis_odeme'];
    $not=$row['siparis_not'];
    $bilgi=$row['siparis_bilgi'];
    $telefon=$row['siparis_tlf'];



   
?>
    <tr>
    <td></td>
    <td><p1><?php echo $id; ?></p1></td>
    <td><p1><?php echo $ad; ?></p1></td>
    <td><p1><?php echo $adres; ?></p1></td>
    <td><p1><?php echo $bilgi; ?></p1></td>
    <td><p1><?php echo $fiyat; ?></p1></td>
    <td><p1><?php echo $telefon; ?></p1></td>
    <td><p><?php echo $not; ?></p></td>
    <td><p1><?php echo $odeme; ?></p1></td>
    <td><a href="siparissil.php?id=<?php echo $id; ?>" class="btn btn-primary">Siparişi Sil</a></td>
</tr>

<?php
}
     ?>
    
   



</table>






     
</div>

        </div>
    </body>
</html>