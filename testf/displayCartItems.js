const urlParams = new URLSearchParams(window.location.search);
const userId = urlParams.get("user_id");

      // Automatically load the cart when the page loads
window.onload = function () {
    if (userId) {
        viewCart(userId);
    } else {
        alert("No user ID found!");
    }
};

function viewCart(id) {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", "displayCart.php?user_id=" + id, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
              const data = JSON.parse(xhr.responseText);
              console.log(data);
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
        <td>${item.quantity}</td>
        <td>$${item.book_price}</td>
        <td>$${item.total_price}</td>
        `;
        tbody.appendChild(row);
        totalAmount += parseFloat(item.total_price);
        });

    totalCell.textContent = "$" + totalAmount.toFixed(2);
}