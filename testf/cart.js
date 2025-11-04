function removeOneCopy(bookName, author) {
  if (!confirm(`Remove one copy of "${bookName}" by ${author}?`)) return;

  const xhr = new XMLHttpRequest();
  xhr.open("POST", "removeOneCopy.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      try {
        const response = JSON.parse(xhr.responseText);
        if (response.success) {
          alert("Removed one copy successfully!");
          loadCartData(); // Refresh cart contents + totals
        } else {
          alert("oneCopyAjax:  " + response.message);
        }
      } catch (e) {
        console.error("Invalid JSON from server:", xhr.responseText);
      }
    }
  };

  const params =
    "book_name=" +bookName +
    "&author=" +author;

  xhr.send(params);
}


const urlParams = new URLSearchParams(window.location.search);
const userId = urlParams.get("user_id");
//Load the cart automatically when the page loads
window.onload = function () {
    if (userId) {
        viewCart(userId);
    } else {
        alert("No user ID found!");
    }
};

document.addEventListener("DOMContentLoaded", () => {
  const searchInput = document.getElementById("searchInput");
  // const tbody = document.getElementById("cartBody");
  // const totalCell = document.getElementById("cartTotal");

  // Load all data initially
  loadCartData();

  // Listen for typing in the search box
  searchInput.addEventListener("keyup", function () {
    const query = this.value.trim();
    loadCartData(query);
  });
});

function loadCartData(search = "") {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", `searchCartItem.php?search=${encodeURIComponent(search)}`, true);

    xhr.onload = function () {
      if (xhr.status === 200) {
        const data = JSON.parse(xhr.responseText);
        displayCart(data);
      } else {
        console.error("Error loading data:", xhr.status);
      }
    };
    xhr.send();
}


function viewCart(id) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "displayCart.php?user_id=" + id, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
              const data = JSON.parse(xhr.responseText);
              console.log(data);//For debugging
              displayCart(data);
            } catch (e) {
              console.error("Error parsing JSON:", e);
            }
          }
        };
        xhr.send();
}

function displayCart(data) {
    const tbody = document.getElementById("cartBody");
    const totalCell = document.getElementById("cartTotal");

    tbody.innerHTML = "";
    let totalAmount = 0;

    data.forEach((item) => {
    const row = document.createElement("tr");
    row.innerHTML = `
        <td>${item.book_name}</td>
        <td>${item.author}</td>
        <td>Ksh. ${item.book_price}</td>
        <td>${item.quantity}</td>
        <td>Ksh. ${item.total_price}</td>
        <td>
        <button class="btn btn-danger btn-sm" onclick="removeOneCopy('${item.book_name}','${item.author}')">
          Remove
        </button>
      </td>
    `;
    tbody.appendChild(row);
    totalAmount += parseFloat(item.total_price);
});


    totalCell.textContent = "Ksh. " + totalAmount.toFixed(2);
}