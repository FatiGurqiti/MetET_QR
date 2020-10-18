<?php 
include("database.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz. 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ürün Ekleme</title>
<link rel="stylesheet" href="style.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>

    .container{
        text-align:center;
        width:100%;
    }
    .col-md-6{
        width:100%;
    }
    .col-md-7{
        width:100%;
    }
    th{
        text-align:center;
    }
</style>

</head>
<body>
<div id="logo" style="text-align:center;" >
            <a href="cart.php"><img style="width: 400px;height: 400px;text-align:center;"  src="metetyenilogo.png" ></a>
        </div>
      
<div class="container">
<div class="col-md-6">
<form action="" method="post" enctype="multipart/form-data" >
    
    <table class="table">
        
       

        <tr>
            <td>Ürün Adı</td>
            <td><textarea name="urun_adi" class="form-control" ></textarea></td>
        </tr>
        <tr>
            <td>Ürün Bilgisi</td>
            <td><textarea name="urun_bilgi" class="form-control" ></textarea></td>
        </tr>

        <tr>
            <td>Ürün Fiyatı</td>
            <td><textarea name="urun_fiyat" class="form-control" ></textarea></td>
        </tr>
        <tr>
            <td>Ürün Görseli</td>
            <td><input type="file" name="urun_gorsel" ></td>
        </tr>
        <tr>
            <td></td>
            <td><input class="btn btn-primary"  type="submit" value="Ekle"></td>
        </tr>

    </table>

</form>

<!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->





<?php 

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.
    include("database.php"); 
    // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $u_adi = $_POST['urun_adi'];
    $u_bilgi = $_POST['urun_bilgi'];
    $u_fiyat = $_POST['urun_fiyat'];

    $name = $_FILES['urun_gorsel']['name'];
  $target_dir = "";
  $target_file = $target_dir . basename($_FILES["urun_gorsel"]["name"]);
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  $extensions_arr = array("jpg","jpeg","png","gif");
  if( in_array($imageFileType,$extensions_arr) ){
 
    // Insert record
  
 
    // Upload file
    move_uploaded_file($_FILES['urun_gorsel']['tmp_name'],$target_dir.$name);

 }



    if ($u_adi<>"" && $u_bilgi<>"") { 
    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.
        
         // Veri ekleme sorgumuzu yazıyoruz.
        if ($db->query("INSERT INTO product VALUES (NULL,'$u_adi','$name,'$u_bilgi','$u_fiyat')")) 
        {
            echo "Veri Eklendi"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
        }
        else
        {
            echo "Hata oluştu";
        }

    }

}

?>
</div>
<!-- ############################################################## -->

<!-- Veritabanına eklenmiş verileri sıralamak için önce üst kısmı hazırlayalım. -->
<div class="col-md-7">
<table class="table">
    
    <tr>
    <br>

        <th>ÜRÜN ID</th>
        <th>ÜRÜN ADI</th>
        <th>ÜRÜN BİLGİ</th>

        <th>ÜRÜN FİYAT</th>
        <th>ÜRÜN GÖRSEL</th>


        <th></th>
        <th></th>
    </tr>

<!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

<?php 

$sorgu = $db->query("SELECT * FROM product"); // Makale tablosundaki tüm verileri çekiyoruz.

while ($sonuc = $sorgu->fetch_assoc()) { 

$id = $sonuc['id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
$adi = $sonuc['pname'];
$bilgi = $sonuc['pinfo'];
$image=$sonuc['image'];
$fiyat = $sonuc['price'];


// While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz. 
?>
    
    <tr>
        <td><?php echo $id; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
        <td><?php echo $adi; ?></td>
        <td><?php echo $bilgi; ?></td>
        <td><?php echo $fiyat; ?></td>
        <td><?php echo $image; ?></td>

<TD></TD>
        <td><a href="urunduzenle.php?id=<?php echo $id; ?>" class="btn btn-primary">Düzenle</a></td>
        <td><a href="urunsil.php?id=<?php echo $id; ?>" class="btn btn-danger">Sil</a></td>
    </tr>

<?php 
} 
// Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz. 
?>

</table>
</div>
</div>
</body>
</html>