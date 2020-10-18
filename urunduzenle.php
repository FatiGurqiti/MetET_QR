<?php 
include("database.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz. 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ürün Düzenleme</title>
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
            <a href="index.php"><img style="width: 400px;height: 400px;text-align:center;"  src="metetyenilogo.png" ></a>
        </div>
<?php 

$sorgu = $db->query("SELECT * FROM product WHERE id =".$_GET['id']); 
//id değeri ile düzenlenecek verileri veritabanından alacak sorgu

$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor

?>

<div class="container">
<div class="col-md-6">

<form action="" method="post" enctype="multipart/form-data" >
    
    <table class="table">
        
        <tr>
            <td>Ürün Adı</td>
            <td><input type="text" name="urun_adi" class="form-control" value="<?php echo $sonuc['pname']; 
                 // Veritabanından verileri çekip inputların içine yazdırıyoruz. ?>">
            </td>
        </tr>

        <tr>
            <td>Ürün Bilgisi</td>
            <td><textarea name="urun_bilgi" class="form-control"><?php echo $sonuc['pinfo']; ?></textarea></td>
        </tr>
        <tr>
            <td>Ürün Fiyatı</td>
            <td><textarea name="urun_fiyat" class="form-control"><?php echo $sonuc['price']; ?></textarea></td>
        </tr>
        <tr>
            <td>Ürün Görseli</td>
            <td><a href="yukle.php"><input type="file" name="urun_gorsel" ></a></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-primary" value="Kaydet"></td>
        </tr>

    </table>

</form>
</div>
<div>
<?php 

if ($_POST) { // Post olup olmadığını kontrol ediyoruz.
    
    $u_adi = $_POST['urun_adi']; // Post edilen değerleri değişkenlere aktarıyoruz
    $u_bilgi = $_POST['urun_bilgi'];
    $u_fiyat = $_POST['urun_fiyat'];
    $u_gorsel=$_POST['urun_gorsel'];


    if ($u_adi<>"" && $u_bilgi<>"") { // Veri alanlarının boş olmadığını kontrol ettiriyoruz.
        
        // Veri güncelleme sorgumuzu yazıyoruz.
        if ($db->query("UPDATE product SET pname = '$u_adi', pinfo= '$u_bilgi' , image='$u_gorsel',  price='$u_fiyat' WHERE id =".$_GET['id'])) 
        {
            header("location:urunekle.php"); 
            // Eğer güncelleme sorgusu çalıştıysa ekle.php sayfasına yönlendiriyoruz.
        }
        else
        {
            echo "Hata oluştu"; // id bulunamadıysa veya sorguda hata varsa hata yazdırıyoruz.
        }
    }
}
?>
</body>
</html>