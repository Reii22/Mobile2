<?php

function get_warga()
{
    global $connection;
    $query = "SELECT * FROM tb_warga";
    $response = array();
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result)) {
        $response[] = array("id" => $row["id"], "nama_warga" => $row["nama"], "umur" => $row["umur"], "jumlah" => $row["jumlahkeluarga"]);
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function get_wargabyid($id = 0)
{
    global $connection;
    $query = "SELECT * FROM tb_warga";
    if ($id != 0) {
        $query .= " WHERE id=" . $id . " LIMIT 1";
    }
    $response = array();
    $result = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_array($result)) {
        $response[] = array("id" => $row["id"], "nama_warga" => $row["nama"], "umur" => $row["umur"], "jumlah" => $row["jumlahkeluarga"]);
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function insert_warga()
{
    global $connection;
    $data = json_decode(file_get_contents('php://input'), true);
    $nama_warga = $data["nama"];
    $umur_warga = $data["umur"];
    $jumlah = $data["jumlah"];
    echo $jumlah;
    echo $nama_warga;
   $query = "INSERT INTO tb_warga SET
     nama='" . $nama_warga . "', 
     umur='" . $umur_warga . "', 
    jumlahkeluarga='" . $jumlah . "'";
    if (mysqli_query($connection, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'warga Added Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'warga Addition Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function update_warga($id)
{
    global $connection;
    $data = json_decode(file_get_contents('php://input'), true);
    $nama_warga = $data["nama"];
    $umur_warga = $data["umur"];
    $jumlahkeluarga_warga = $data["jumlahkeluarga"];
    $query = "UPDATE tb_warga SET nama='" . $nama_warga . "', 
     umur='" . $umur_warga . "', 
    jumlahkeluarga='" . $jumlahkeluarga_warga . "' WHERE id=" . $id;
    if (mysqli_query($connection, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'warga Updated Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'warga Updation Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function delete_warga($id)
{
    global $connection;
    $query = "DELETE FROM tb_warga WHERE id=" . $id;
    if (mysqli_query($connection, $query)) {
        $response = array(
            'status' => 1,
            'status_message' => 'warga Deleted Successfully.'
        );
    } else {
        $response = array(
            'status' => 0,
            'status_message' => 'warga Deletion Failed.'
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}
