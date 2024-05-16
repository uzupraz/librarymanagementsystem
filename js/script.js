function searchUserID() {
    var userid = document.getElementById('userid').value;
    if (userid.trim() !== '') {
      window.location.href = 'lentbook.php?userid=' + encodeURIComponent(userid);
    } else {
      alert('Please enter a User ID.');
    }
  }