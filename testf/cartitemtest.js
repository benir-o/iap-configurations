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
  // xhr.send(
  //   "user_id=" + userId +
  //   "&book_name=" + encodeURIComponent(book_name) +
  //   "&author=" + encodeURIComponent(author)
  // );
}