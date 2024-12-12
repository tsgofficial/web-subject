const API_URL = "https://api.escuelajs.co/api/v1";

document
  .getElementById("postForm")
  .addEventListener("submit", function (event) {
    event.preventDefault();
    const name = document.getElementById("nameInput").value;
    const email = document.getElementById("emailInput").value;
    const password = document.getElementById("passwordInput").value;

    fetch(`${API_URL}/users`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        name,
        email,
        password,
        avatar: "https://picsum.photos/800",
      }),
    })
      .then((response) => response.json())
      .then((data) => {
        document.getElementById(
          "postResult"
        ).innerText = `POST Response:\n${JSON.stringify(data, null, 2)}`;
      })
      .catch((error) => {
        document.getElementById("postResult").innerText = `Error: ${error}`;
      });
  });

document.getElementById("fetchPosts").addEventListener("click", function () {
  fetch(`${API_URL}/users`)
    .then((response) => response.json())
    .then((users) => {
      const usersTable = document
        .getElementById("usersTable")
        .getElementsByTagName("tbody")[0];

      usersTable.innerHTML = "";
      users.forEach((user) => {
        const row = usersTable.insertRow();
        row.innerHTML = `
                <td>${user.id}</td>
                <td>${user.email}</td>
                <td>${user.password}</td>
                <td>${user.name}</td>
                <td>${user.role}</td>
            `;
      });
    })
    .catch((error) => {
      document.getElementById("getResult").innerText = `Error: ${error}`;
    });
});

document.getElementById("fetchStudents").addEventListener("click", function () {
  const xhr = new XMLHttpRequest();
  xhr.open("GET", "students.json", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      const students = JSON.parse(xhr.responseText);
      const tableBody = document
        .getElementById("studentTable")
        .getElementsByTagName("tbody")[0];
      tableBody.innerHTML = ""; // Clear existing rows

      students.forEach((student) => {
        const row = tableBody.insertRow();
        row.innerHTML = `
                  <td>${student.lastName}</td>
                  <td>${student.firstName}</td>
                  <td>${student.studentCode}</td>
                  <td>${student.age}</td>
                  <td>${student.dateOfBirth}</td>
                  <td>${student.gpa}</td>
                  <td>${student.onLeave ? "Yes" : "No"}</td>
              `;
      });
    }
  };
  xhr.send();
});
