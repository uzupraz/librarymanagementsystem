<?php
session_start();
include 'connection.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Homepage</title>
  <link rel="stylesheet" href="a_dashboard.css">
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="logo.png" alt="Librify Logo">
            <h2>Librify</h2>
        </div>
        <button onclick="showTotalUsers()" class="sidebar-btn">Users</button>
        <button onclick="showTotalBooks()" class="sidebar-btn">Books</button>
        <button onclick="showSubscriptionUsers()" class="sidebar-btn">Subscription User</button>
        <button onclick="logout()" class="sidebar-btn">Logout</button>
    </div>      
    <div class="content">
        <h1>Welcome to Admin Dashboard</h1>
        <div class="line"></div>
        <div class="stats">
          <button onclick="showTotalUsers()" class="stat-box">
            <p>Total Users</p>
            <span id="totalUsers">0</span>
          </button>
          <button onclick="showTotalBooks()" class="stat-box">
            <p>Total Books</p>
            <span id="totalBooks">0</span>
          </button>
          <button onclick="showActiveSubscriptions()" class="stat-box">
            <p>Active Subscriptions</p>
            <span id="activeSubscriptions">0</span>
          </button>
          <button onclick="showTotalInventoryBooks()" class="stat-box">
            <p>Inventory Totalbooks</p>
            <span id="totalInventoryBooks">0</span>
          </button>
          <button onclick="showTotalLentBooks()" class="stat-box">
            <p>Total Lentbooks</p>
            <span id="totalLentBooks">0</span>
          </button>
          <button onclick="showTotalReturnBooks()" class="stat-box">
            <p>Total Returnbooks</p>
            <span id="ReturnBooks">0</span>
          </button>
        </div>
    </div>

    <script src="a_dashboard.js"></script>

    
<!-- Code injected by live-server
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script> -->
</body>
</html>