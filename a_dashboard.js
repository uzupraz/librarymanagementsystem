document.addEventListener('DOMContentLoaded', () => {
    updateStats();
  });
  
  function updateStats() {
    document.getElementById('totalUsers').textContent = totalUsers;
    document.getElementById('totalBooks').textContent = totalBooks;
    document.getElementById('activeSubscriptions').textContent = activeSubscriptions;
    document.getElementById('totalInventoryBooks').textContent = totalInventoryBooks;
    document.getElementById('totalLentBooks').textContent = totalLentBooks;
    document.getElementById('totalReturnBooks').textContent = totalReturnBooks;
  }
  
  function showTotalLentBooks() {
    window.location.href = 'lentbook.php';
  }
  
  function showTotalReturnBooks() {
    window.location.href = 'returnbook.html'
  }
  
  function showTotalBooks() {
    window.location.href = 'bookshow.php';
  }
  
  
  function sendReq(city) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "checkdb.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        var response = JSON.parse(xhr.responseText);
        if (response) {
          // Displays the data using the received data from database
          offline_main(response);
        }
        else {
          alert("Offline: Saved Data Not Found For " + city);
        }
      }
    };
    xhr.send("city=" + city);
  }
  
  