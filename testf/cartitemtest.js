function addToCart(userId, book_name, author) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "addToCart.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        let response = xhr.responseText.trim();
        if (response === "OUT_OF_STOCK") {
          alert("This book is out of stock!");
        } else if (response === "ADDED") {
          alert("Book added to cart!");
        } else {
          alert("An error occurred: " + response);
        }
      }
    }
  };

  xhr.send(`user_id=1&book_name=${encodeURIComponent(book_name)}&author=${encodeURIComponent(author)}`);
  
}
//Redirects the user to the cart page
function goToCart(userId) {
  window.location.href = "cart.html?user_id=" + userId;
}

function viewCart() {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "getCart.php?user_id=1", true);

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      try {
        const cartData = JSON.parse(xhr.responseText);
        displayCart(cartData);
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

  data.forEach(item => {
    const row = document.createElement("tr");
    row.innerHTML = `
      <td>${item.book_name}</td>
      <td>${item.author}</td>
      <td>${item.quantity}</td>
      <td>$${item.price}</td>
      <td>$${item.total_price}</td>
    `;
    tbody.appendChild(row);
    totalAmount += parseFloat(item.total_price);
  });

  totalCell.textContent = "$" + totalAmount.toFixed(2);
}