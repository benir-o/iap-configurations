function addToCart(userId, refNo) {
  const xhr = new XMLHttpRequest();
  xhr.open("POST", "addtoCart.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4) {
      if (xhr.status === 200) {
        alert(xhr.responseText); // feedback from PHP
      } else {
        alert("Error adding to cart!");
      }
    }
  };

  // send data as form-like string
  xhr.send("user_id=" + userId + "&ref_no=" + refNo);
}