<?php 

if ($_GET) 
{

include("database.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.

// id'si seçilen veriyi silme sorgumuzu yazıyoruz.
if ($db->query("DELETE FROM product WHERE id =".$_GET['id'])) 
{
    header("location:urunekle.php"); // Eğer sorgu çalışırsa ekle.php sayfasına gönderiyoruz.
}
}

?>