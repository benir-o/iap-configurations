function addBook(event) {
      event.preventDefault(); // stop form from refreshing

      const bookName = document.getElementById("bookName").value.trim();
      const author = document.getElementById("author").value.trim();
      const price = parseFloat(document.getElementById("price").value.trim());
      const quantity = parseInt(document.getElementById("quantity").value.trim());
      const messageDiv = document.getElementById("message");

      if (!bookName || !author || isNaN(price) || isNaN(quantity) || quantity <= 0) {
        messageDiv.innerHTML = `<div class="alert alert-warning">Please fill in all fields correctly.</div>`;
        return;
      }

      // create request
      const xhr = new XMLHttpRequest();
      xhr.open("POST", "/iap-configurations/testf/addBookHandler.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

      // handle response
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          console.log("Ready state is 4");
          if (xhr.status === 200) {
            console.log("Status is 200");
            try {
              const response = JSON.parse(xhr.responseText);
              if (response.status === "success") {
                messageDiv.innerHTML = `<div class="alert alert-success">${response.message}</div>`;
                document.getElementById("addBookForm").reset();
                console.log("Insertion successful");
              } else {
                messageDiv.innerHTML = `<div class="alert alert-danger">${response.message}</div>`;
              }
            } catch (error) {
              messageDiv.innerHTML = `<div class="alert alert-danger">Invalid server response.</div>`;
            }
          } else {
            console.log("Request is not working");
            messageDiv.innerHTML = `<div class="alert alert-danger">Request failed. Try again later.</div>`;
          }
        }
      };

      // encode and send data
      const params = `bookName=${encodeURIComponent(bookName)}&author=${encodeURIComponent(author)}&price=${encodeURIComponent(price)}&quantity=${encodeURIComponent(quantity)}`;
      xhr.send(params);
    }


function addToCart(userId, book_name, author) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "/iap-configurations/testf/addtoCart.php", true);
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

  xhr.send(`user_id=${userId}&book_name=${encodeURIComponent(book_name)}&author=${encodeURIComponent(author)}`);
  
}
//Redirects the user to the cart page
function goToCart(userId) {
  window.location.href = "/iap-configurations/testf/cart.html?user_id=" + userId;
}

function viewCart() {
  const xhr = new XMLHttpRequest();//OOP
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
      <td>Ksh. ${item.price}</td>
      <td>Ksh. ${item.total_price}</td>
    `;
    tbody.appendChild(row);
    totalAmount += parseFloat(item.total_price);
  });

  totalCell.textContent = "$" + totalAmount.toFixed(2);
}