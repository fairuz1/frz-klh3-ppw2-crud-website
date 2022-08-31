<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }
        .headingData {
            font-size: 3em;
            font-weight: 700;
            color: #313131;
        }

        .btn-primary {
            background-color: #319DA0;
            font-size: 1.3em;
            border: none;
        }

        .btn-primary:hover {
            background-color: #313131;
            border: none;
        }

        .btn-secondary {
            background-color: #319DA0;
            font-size: 0.9em;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #313131;
            border: none;
        }

        .delete {
            background-color: #EC7272;
        }
    </style>
    <title>Data Game Favorit</title>
</head>
<body>
    <div class="container mt-3 mb-3">
        <h2 class="h2 mb-1 headingData">Data Game <span style="color: #319DA0;">Favorit</span></h2>
        <p style="font-size: 1.2em; color: #313131;"> 
            Apakah anda senang bermain game? Ayo ikut berpartisipasi 
            dengan memasukan data game yang kamu sukai beserta alasannya!
            Kamu juga bisa <b>mengubah</b> dan juga <b>menghapus</b> data juga loh!
        </p>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addData"><b>Tambah Data</b></button>
        <br><br>
        <table class="table">
            <caption>Data Game Favorit</caption>
            <thead class="table-dark">
                <tr class="text-center">
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Game</th>
                    <th scope="col">Alasan</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $mysqli = require __DIR__ . "/connection.php";
                    $sql = "SELECT * FROM data";
                    $data = mysqli_query($mysqli, $sql);
                    $array_data = array();
                    if (mysqli_num_rows($data)) {
                        while ($i = mysqli_fetch_assoc($data)){
                            $array_data[] = $i;
                        }

                        for ($i=0; $i < sizeof($array_data); $i++){ 
                            $data1 = $array_data[$i]['Nama'];
                            $data2 = $array_data[$i]['Game'];
                            $data3 = $array_data[$i]['Alasan'];
                            $data4 = $array_data[$i]['ID'];
                            $number = $i + 1;
                            echo"
                                <tr>
                                    <td class='text-center'>{$number}</td>
                                    <td>{$data1}</td>
                                    <td>{$data2}</td>
                                    <td>{$data3}</td>
                                    <td class='text-center'>
                                        <button class='btn btn-secondary me-1 mb-2' data-bs-toggle='modal' data-bs-target='#editData' onclick='setEditId(this)'>Edit</button>
                                        <button class='btn btn-secondary delete mb-2' data-bs-toggle='modal' data-bs-target='#removeData' onclick='setRemoveId(this)'>Hapus</button>
                                    </td>
                                    <td hidden readonly>{$data4}</td>
                                <tr>";
                        }
                    }
                ?>
            </tbody>
        </table>

        <!-- modal untuk menambah data -->
        <div class="modal fade" tabindex="-1" id="addData">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="h3 headingData mb-0" style="font-size: 2em;">Tambah <span style="color: #319DA0;">Data</span></h3>
                    </div>
                    <div class="modal-body" style="color: #313131;">
                        <form action="dataAdd.php" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Kamu</label>
                                <input type="text" class="form-control" id="name" name="name" maxlength="50">
                                <div class="form-text" id="nameDetail">masukan nama asli</div>
                            </div>
                            <div class="mb-3">
                                <label for="game" class="form-label">Game Favorit</label>
                                <input type="text" class="form-control" id="game" name="game" maxlength="50">
                                <div class="form-text" id="gameDetail">1 game yang paling kamu suka</div>
                            </div>
                            <div class="mb-3">
                                <label for="reason" class="label-control">Alasan kamu</label>
                                <textarea class="form-control mt-3" name="reason" id="reason" cols="10" rows="5" maxlength="200"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" style="font-size: 1em;">Tambah Data</button>
                            <button type="button" class="btn btn-secondary delete ms-2" style="font-size: 1em;" data-bs-dismiss="modal">Kembali</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal untuk mengubah data -->
        <div class="modal fade" tabindex="-1" id="editData">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="h3 headingData mb-0" style="font-size: 2em;">Rubah <span style="color: #319DA0;">Data</span></h3>
                    </div>
                    <div class="modal-body" style="color: #313131;">
                        <form action="dataEdit.php" method="post">
                            <div class="mb-3">
                                <label for="changeName" class="form-label">Nama Kamu</label>
                                <input type="text" class="form-control" name="changeName" id="changeName" maxlength="50">
                                <div class="form-text" id="nameDetail1">Masukan nama asli</div>
                            </div>
                            <div class="mb-3">
                                <label for="changeGame" class="form-label">Game Favorit</label>
                                <input type="text" class="form-control" name="changeGame" id="changeGame" maxlength="50">
                                <div class="form-text" id="gameDetail1">1 game yang paling kamu suka</div>
                            </div>
                            <div class="mb-3">
                                <label for="changeReason" class="form-label">Alasan Kamu</label>
                                <textarea class="form-control mt-2" name="changeReason" id="changeReason" cols="10" rows="5" maxlength="200"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="dataChange" class="form-label"></label>
                                <input type="text" class="form-control" name="dataChange" id="dataChange" readonly hidden>
                            </div>

                            <button type="submit" class="btn btn-primary" style="font-size: 1em;">Rubah Data</button>
                            <button type="button" class="btn btn-secondary delete ms-2" style="font-size: 1em;" data-bs-dismiss="modal">Kembali</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- modal untuk menghapus data -->
        <div class="modal fade" tabindex="-1" id="removeData">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="h3 headingData mb-0" style="font-size: 2em;">Hapus <span style="color: #319DA0;">Data</span></h3>
                    </div>
                    <div class="modal-body" style="color: #313131;">
                        <form action="dataRemove.php" method="post">
                            <p class="mb-3">Apakah kamu yakin mau menghapus data ini ?</p>
                            <div class="mb-3" hidden>
                                <label for="dataRemove" class="form-label"></label>
                                <input type="text" class="form-control" name="dataRemove" id="dataRemove" readonly>
                            </div>

                            <button type="submit" class="btn btn-primary" style="font-size: 1em;">Hapus Data</button>
                            <button type="button" class="btn btn-secondary delete ms-2" style="font-size: 1em;" data-bs-dismiss="modal">Kembali</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script>
        function setEditId(data) {
            document.getElementById("dataChange").value = data.parentNode.nextElementSibling.innerHTML;
            console.log(document.getElementById("dataChange").value);
        }

        function setRemoveId(data) {
            document.getElementById("dataRemove").value = data.parentNode.nextElementSibling.innerHTML;
            console.log(document.getElementById("dataRemove").value);
        }
    </script>
</body>
</html>