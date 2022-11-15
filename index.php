<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Đây là trang chủ</h1>
    <?php 
    use Illuminate\Cache\RateLimiting\Limit;
        require 'connect.php';
        if(isset($_GET['trang'])){
            $trang  = $_GET['trang'];        
        }else{
            $trang = 1;
        }
        $tim_kiem ="";
        if(isset($_GET['tim_kiem'])){
            $tim_kiem  = $_GET['tim_kiem'];        
        }
        $sql_so_tt = "select count(*) from tin_tuc
        where
        tieu_de like '%$tim_kiem%'  ";
        $mang_so_tt = mysqli_query($ket_noi, $sql_so_tt);
        $kq_so_tt = mysqli_fetch_array($mang_so_tt);
        $so_tt =  $kq_so_tt['count(*)'];
        $so_tt_1_trang = 1;
        $so_trang =  ceil($so_tt / $so_tt_1_trang);
        $bo_qua = $so_tt_1_trang * ($trang - 1);

        $sql= "select * from tin_tuc
        where
        tieu_de like '%$tim_kiem%'    
        limit $so_tt_1_trang offset $bo_qua";
        $ket_qua = mysqli_query($ket_noi, $sql);
    ?>
    <a href="form_insert.php">
        Thêm bài viết
    </a>

    <table border="1" width="100%">
        <caption>
            <form action="">
                <input type="search" name="tim_kiem" 
                value="<?php echo $tim_kiem ?>">
            </form>
        </caption>
        <tr>
            <th>Mã</th>
            <th>Tiêu đề</th>
            <th>Ảnh</th>
            <th>Sửa</th>
            <th>Xóa</th>
        </tr>
        <?php foreach($ket_qua as $item_tin_tuc){ ?>
            <tr>
                <td><?php echo $item_tin_tuc['ma'] ?></td>
                <td>
                    <a style="text-decoration: none;"
                     href="show.php?ma=<?php echo $item_tin_tuc['ma'] ?>" >
                    <?php echo $item_tin_tuc['tieu_de'] ?>  
                </a>
            </td>
                <td>
                    <img src="<?php echo $item_tin_tuc['anh'] ?>" alt="" height="100">
                </td>
                <td>
                    <a href="form_update.php?ma=<?php echo $item_tin_tuc['ma'] ?>">
                        Sửa
                    </a>
                </td>
                <td>
                    <a href="delete.php?ma=<?php echo $item_tin_tuc['ma'] ?>">
                        Xóa
                    </a>
                </td>
            </tr>
        <?php } ?>
    </table>
    <?php for($i=1; $i<=$so_trang; $i++){ ?>
        <a href="?trang=<?php echo $i?> & tim_kiem=<?php echo $tim_kiem ?>">
            <?php echo $i ?>
        </a>
        <?php } ?>
    <?php mysqli_close($ket_noi); ?>
</body>
</html>