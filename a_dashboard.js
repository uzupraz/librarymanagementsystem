// Mock data for demonstration
let totalUsers = 100;
let totalBooks = 500;

// Update total users and total books on page load
document.addEventListener('DOMContentLoaded', () => {
  updateStats();
});

// Function to update statistics
function updateStats() {
  document.getElementById('totalUsers').innerText = totalUsers;
  document.getElementById('totalBooks').innerText = totalBooks;
}

// Functions to handle button clicks
function showTotalUsers() {
  alert(`Total Users: ${totalUsers}`);
}

function showTotalBooks() {
  alert(`Total Books: ${totalBooks}`);
}

function showSubscriptionUsers() {
  alert('Subscription User View');
}
