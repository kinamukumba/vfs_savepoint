const api = "http://localhost/save_point/backend/";

document.getElementById("userForm").onsubmit = async e => {
  e.preventDefault();

  const data = {
    first_name: first_name.value,
    last_name: last_name.value,
    passport_number: passport.value,
    birth_date: birth_date.value,
    phone: phone.value,
    email: email.value
  };

  console.log(data)
  await fetch(api + "/create_user.php", {
    method: "POST",
    body: JSON.stringify(data)
  });

  alert("Usuário cadastrado");
  loadUsers();
};

/*document.getElementById("prepare").onclick = async () => {
  const userSelect = document.getElementById('userSelect');
  const id = userSelect.value;

  if (!id) {
    alert("Selecione um usuário");
    return;
  }

  const res = await fetch(api + "/get_user.php?id=" + id);
  const user = await res.json();

  localStorage.setItem("VFS_PREFILL", JSON.stringify({
    "First Name": user.first_name,
    "Last Name": user.last_name,
    "Passport Number": user.passport_number,
    "Date of Birth": user.birth_date,
    "Phone Number": user.phone,
    "Email": user.email
  }));

  alert("✅ Dados preparados. Agora abra o site da VFS.");
};*/


document.getElementById("prepare").onclick = async () => {
  const userSelect = document.getElementById('userSelect');
  const id = userSelect.value;

  if (!id) {
    alert("Selecione um usuário");
    return;
  }

  // 1️⃣ Define o usuário ativo no backend
  await fetch(api + "/set_active_user.php", {
    method: "POST",
    headers: { "Content-Type": "application/x-www-form-urlencoded" },
    body: "id=" + id
  });

  alert("✅ Usuário preparado. Agora abra o site da VFS.");
};
