<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $title; ?>/</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h2 class="text-center"><?= $title_pdf ?></h2>
        <p></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Ruangan</th>
                    <th>Petugas</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($laporan as $item) : ?>
                    <tr>
                        <td><?= date('d M Y', strtotime($item['tgl'])) ?></td>
                        <td><?= $item['ruangan'] ?></td>
                        <td><?= $item['petugas'] ?></td>
                        <td><?= $item['status'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS and jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>