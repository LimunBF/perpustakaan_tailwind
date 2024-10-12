<?php
    include '../../Connection/DBConnection.php';

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "DELETE FROM peminjaman WHERE id = '$id'";
        $result = mysqli_query($con, $query);

        if ($result) {
            header('Location: RiwayatPinjam.php');
            exit;
        } else {
            $message = "Error deleting data: " . mysqli_error($con);
            header('Location: RiwayatPinjam.php?error=' . urlencode($message));
            exit;
        }
    }
?>
<?php
    function deleteOldData() {
        include '../../Connection/DBConnection.php';
        $currentTime = date('Y-m-d H:i:s');
        $query = "DELETE FROM peminjaman WHERE tanggal_kembali < '$currentTime'";
        $result = mysqli_query($con, $query);

        if ($result) {
            $message =  "Old data deleted successfully.";
        } else {
            $message =  "Error deleting old data: " . mysqli_error($con);
        }
    }

    // Call the function when the page is loaded
    deleteOldData();
?>