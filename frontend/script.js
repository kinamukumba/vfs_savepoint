

const api_get = "http://localhost/save_point/backend/";

async function loadUsers() {
  const res = await fetch(api_get + "/get_users.php");
  const users = await res.json();

  const select = document.getElementById("userSelect");

  users.forEach(user => {
    const option = document.createElement("option");
    option.value = user.id;

    option.textContent = `${user.first_name} ${user.last_name}`;
    select.appendChild(option);
  });
}

loadUsers();
