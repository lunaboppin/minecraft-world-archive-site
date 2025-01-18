<?php
session_start();
require_once 'vendor/autoload.php';
require("ServerManager.php");

$notification = "";
$notificationType = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $server = new ServerManager();

    if (isset($_POST["start_server1"])) {
        $server->powerServer("start", "b268c546"); // morello 1.18.2
        $notification = "Server 1.18.2 world has been started. It may take around 30 seconds to start.";
        $notificationType = "success";
    /*} elseif (isset($_POST["start_server2"])) {
        $server->powerServer("start", "79956279"); // 1.7.10 pack
        $notification = "Server 1.7.10 modpack world has been started. It may take around 100 seconds to start.";
        $notificationType = "success";*/
    } elseif (isset($_POST["start_server3"])) {
        $server->powerServer("start", "9a2ebbb3"); // 24/7 minecraft
        $notification = "Server 24/7 world has been started. It may take around 20 seconds to start.";
        $notificationType = "success";
    } elseif (isset($_POST["start_server4"])) {
        $server->powerServer("start", "c5f4787a"); // atm 6
        $notification = "Server All The Mods 6 world has been started. It may take around 150 seconds to start.";
        $notificationType = "success";
	/*} elseif (isset($_POST["start_server5"])) {
        $server->powerServer("start", "6826ba1e"); // 1122 pack
        $notification = "Server 1.12.2 pack world has been started. It may take around 200 seconds to start.";
        $notificationType = "success";*/
	} elseif (isset($_POST["start_server6"])) {
        $server->powerServer("start", "419bbabb"); // atm 8 pack
        $notification = "Server ATM 8 pack world has been started. It may take around 200 seconds to start.";
        $notificationType = "success";

        $_SESSION['notification'] = [
            'type' => $notificationType,
            'message' => $notification
        ];

        header("Location: ".$_SERVER['PHP_SELF']);
        exit;
    }
}

if (isset($_SESSION['notification'])) {
    $notificationType = $_SESSION['notification']['type'];
    $notification = $_SESSION['notification']['message'];
    unset($_SESSION['notification']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta content="Minecraft worlds archive - downloads" property="og:title">
	<meta content="Download links and servers for all old maps. Preview servers will only stay on for 30 minutes before they need to be started again." property="og:description">
	<meta content="Minecraft worlds archive" property="og:site_name">
	<meta content='https://archive.clart.zip/static/img/1182world.png' property='og:image'>
    <title>Minecraft World Backups</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body, html {
            height: auto;
            margin: 0;
        }

        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .row {
            width: 100%;
        }

        .col-md-6 {
            width: 50%;
            padding: 15px;
            box-sizing: border-box;
        }

        img {
            width: 100%;
            height: auto;
            max-height: 100%;
        }

        .btn {
            width: 100%;
            margin-top: 10px;
        }
    </style>
</head>
<body class="container">
    <div class="text-center">
		<br>
        <h1 class="mb-4">Minecraft World Backups</h1>
		<br>
		<h4 class="mb-4">Download links and servers for all old maps. <s>Preview servers will only stay on for 30 minutes before they need to be started again.</s>(they don't work anymore)</h4>

        <form action="" method="POST">
            <div class="row mb-4">
                <div class="col-md-6">
                    <img src="static/img/1182world.png" alt="Start Image 1" class="img-fluid mb-2">
                    <button type="submit" name="start_server1" class="btn btn-primary btn-block mb-2" disabled>Start 1.18.2 server</button>
					<button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" data-target="#infoModal1">Server info</button>
                </div>
                <div class="col-md-6">
                    <img src="static/img/1182world2.png" alt="Download Image 1" class="img-fluid mb-2">
                    <a href="download.php?file=1182world.zip" class="btn btn-success btn-block" role="button" download>Download 1.18.2 world</a>
                </div>
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <img src="static/img/247world.png" alt="Start Image 3" class="img-fluid mb-2">
                    <button type="submit" name="start_server3" class="btn btn-primary btn-block mb-2" disabled>Start 24/7 server</button>
					<button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" data-target="#infoModal2">Server info</button>
                </div>
                <div class="col-md-6">
                    <img src="static/img/247world2.png" alt="Download Image 3" class="img-fluid mb-2">
                    <a href="download.php?file=247minecraft.zip" class="btn btn-success btn-block" role="button" download>Download 24/7 world</a>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <img src="static/img/atm6world.png" alt="Start Image 4" class="img-fluid mb-2">
                    <button type="submit" name="start_server4" class="btn btn-primary btn-block mb-2" disabled>Start ATM 6 server</button>
					<button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" data-target="#infoModal3">Server info</button>
                </div>
                <div class="col-md-6">
                    <img src="static/img/atm6world2.png" alt="Download Image 4" class="img-fluid mb-2">
                    <a href="download.php?file=atm6world.zip" class="btn btn-success btn-block" role="button" download>Download ATM 6 world</a>
                </div>
            </div>

			<div class="row mb-4">
                <div class="col-md-6">
                    <img src="static/img/1710world.png" alt="Start Image 2" class="img-fluid mb-2">
                    <button type="submit" name="start_server2" class="btn btn-primary btn-block mb-2" disabled>Start 1.7.10 modded server</button>
					<button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" data-target="#infoModal4">Server info</button>
                </div>
                <div class="col-md-6">
                    <img src="static/img/1710world2.png" alt="Download Image 2" class="img-fluid mb-2">
                    <a href="download.php?file=1710pack.zip" class="btn btn-success btn-block" role="button" download>Download 1.7.10 world</a>
                </div>
            </div>
			<div class="row mb-4">
                <div class="col-md-6">
                    <img src="static/img/1122pack.png" alt="Start Image 2" class="img-fluid mb-2">
                    <button type="submit" name="start_server5" class="btn btn-primary btn-block mb-2" disabled>Start 1.12.2 modded server</button>
					<button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" data-target="#infoModal5">Server info</button>
                </div>
                <div class="col-md-6">
                    <img src="static/img/1122pack2.png" alt="Download Image 2" class="img-fluid mb-2">
                    <a href="download.php?file=1122pack.zip" class="btn btn-success btn-block" role="button" download>Download 1.12.2 world</a>
                </div>
            </div>

			<div class="row mb-4">
                <div class="col-md-6">
                    <img src="static/img/lostatm8world.png" alt="Start Image 2" class="img-fluid mb-2">
                    <button type="submit" name="start_server6" class="btn btn-primary btn-block mb-2" disabled>Start ATM 8 server</button>
					<button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" data-target="#infoModal6">Server info</button>
                </div>
                <div class="col-md-6">
                    <img src="static/img/lostatm8world2.jpg" alt="Download Image 2" class="img-fluid mb-2">
                    <a href="download.php?file=atm8world.zip" class="btn btn-success btn-block" role="button">Download ATM 8 world</a>
                </div>
            </div>

            <h5>Missing maps</h5>
			<div class="row mb-4">
                <div class="col-md-6">
                    <img src="static/img/lostatm6world.png" alt="Start Image 2" class="img-fluid mb-2">
                    <button type="submit" name="start_server7" class="btn btn-primary btn-block mb-2" disabled>Start ATM 6 server (missing)</button>
					<button type="button" class="btn btn-info btn-block mb-2" data-toggle="modal" data-target="#infoModal7">Server info</button>
                </div>
                <div class="col-md-6">
                    <img src="static/img/lostatm6world2.png" alt="Download Image 2" class="img-fluid mb-2">
                    <a href="" class="btn btn-success btn-block disabled" role="button">Download ATM 6 world (missing)</a>
                </div>
            </div>
        </form>
    </div>

    <div class="modal fade" id="infoModal1" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel1" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel1">More Info for 1.18.2 Server</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p><b>Server IP:</b> hel-node1.clart.zip:27050</p>
					<p><b>Dynmap Link:</b><a href="https://archive1182-dynmap.clart.zip/"> https://archive1182-dynmap.clart.zip/</a></p>
					<p><b>Version:</b> 1.18.2 Vanilla</p>
					<p><b>World Size:</b> 3.5GB</p>
					<p><b>Note:</b> The dynmap link will only work when the server is running.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infoModal2" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel2" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel2">More Info for 24/7 Server</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><b>Server IP:</b> hel-node1.clart.zip:27122</p>
					<p><b>Dynmap Link:</b><a href="https://archive247-dynmap.clart.zip/"> https://archive247-dynmap.clart.zip/</a></p>
					<p><b>Version:</b> 1.20.1 Vanilla</p>
					<p><b>World Size:</b> 13.4GB</p>
					<p><b>Note:</b> The dynmap link will only work when the server is running.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infoModal3" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel3" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel3">More Info for ATM6 Server</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><b>Server IP:</b> hel-node1.clart.zip:27084</p>
					<p><b>Modpack Link:</b><a href="https://www.curseforge.com/minecraft/modpacks/all-the-mods-6/files/3925543"> https://www.curseforge.com/minecraft/modpacks/all-the-mods-6</a></p>
					<p><b>Version:</b> 1.16.5 ATM6</p>
					<p><b>World Size:</b> 7.6GB</p>
					<p><b>Note:</b> Modpack version is 1.8.28.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="infoModal4" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel4" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel4">More Info for 1.7.10 Pack Server</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><b>Server IP:</b> hel-node1.clart.zip:27076</p>
					<p><b>Modpack Link:</b><a href="https://www.technicpack.net/modpack/the-1710-pack.453902"> https://www.technicpack.net/modpack/the-1710-pack.453902</a></p>
					<p><b>Version:</b> 1.7.10 The 1.7.10 Pack</p>
					<p><b>World Size:</b> 577.3MB</p>
					<p><b>Note:</b> Modpack version is 0.9.8d.</p>
                </div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="infoModal5" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel5" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel5">More Info for 1.12.2 Pack Server</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><b>Server IP:</b> hel-node1.clart.zip:27124</p>
					<p><b>Modpack Link:</b><a href="https://www.technicpack.net/modpack/the-1122-pack.1406454"> https://www.technicpack.net/modpack/the-1122-pack.1406454</a></p>
					<p><b>Version:</b> 1.12.2 The 1.12.2 Pack</p>
					<p><b>World Size:</b> 315.2MB</p>
					<p><b>Note:</b> Modpack version is 1.2.3.</p>
                </div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="infoModal6" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel6" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel6">More Info for ATM 8 Server</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><b>Server IP:</b> hel-node1.clart.zip:27091</p>
					<p><b>Modpack Link:</b><a href="https://www.curseforge.com/minecraft/modpacks/all-the-mods-8/files/4372497"> https://www.curseforge.com/minecraft/modpacks/all-the-mods-8</a></p>
					<p><b>Version:</b> 1.19.2 ATM8</p>
					<p><b>World Size:</b> 3.0GB</p>
					<p><b>Note:</b> Modpack version is 1.0.10.</p>
                </div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="infoModal7" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel7" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="infoModalLabel7">More Info for ATM 6 Server</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
					<p><b><span class="text-danger">NOTICE: </span></b> The world save for this map is currently missing.</p>
					<p><b>Server IP:</b> N/A</p>
					<p><b>Modpack Link:</b><a href="https://www.curseforge.com/minecraft/modpacks/all-the-mods-6/files/3459526"> https://www.curseforge.com/minecraft/modpacks/all-the-mods-6</a></p>
					<p><b>Version:</b> 1.16.5 ATM6</p>
					<p><b>World Size:</b> N/A</p>
					<p><b>Note:</b> Modpack version is 1.8.3.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="notificationModal" tabindex="-1" role="dialog" aria-labelledby="notificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notificationModalLabel">Notification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-<?php echo $notificationType; ?>" role="alert">
                        <?php echo $notification; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        <?php if ($notification !== ""): ?>
            $(document).ready(function() {
                $('#notificationModal').modal('show');
            });
        <?php endif; ?>
    </script>
</body>
</html>
