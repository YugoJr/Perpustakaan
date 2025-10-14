const authSection = document.getElementById("auth-section");
const librarySection = document.getElementById("library-section");
const usernameInput = document.getElementById("username");
const passwordInput = document.getElementById("password");
const loginBtn = document.getElementById("login-btn");
const signupBtn = document.getElementById("signup-btn");
const logoutBtn = document.getElementById("logout-btn");
const authMsg = document.getElementById("auth-msg");

const bookList = document.getElementById("book-list");
const addBookBtn = document.getElementById("add-book-btn");
const newTitle = document.getElementById("new-title");
const newAuthor = document.getElementById("new-author");
const newImage = document.getElementById("new-image");
const newStock = document.getElementById("new-stock");
const addBookMsg = document.getElementById("add-book-msg");

let users = [
  { username: "admin", password: "1234" }
];

let currentUser = null;

let books = [
  {
    id: 1,
    title: "Atomic Habits",
    author: "James Clear",
    image: "https://images-na.ssl-images-amazon.com/images/I/51-nXsSRfZL._SX329_BO1,204,203,200_.jpg",
    stock: 3,
    isBorrowed: 0,
    borrowedBy: []
  },
  {
    id: 2,
    title: "Clean Code",
    author: "Robert C. Martin",
    image: "https://images-na.ssl-images-amazon.com/images/I/41xShlnTZTL._SX374_BO1,204,203,200_.jpg",
    stock: 2,
    isBorrowed: 0,
    borrowedBy: []
  },
  {
    id: 3,
    title: "The Pragmatic Programmer",
    author: "Andrew Hunt",
    image: "https://images-na.ssl-images-amazon.com/images/I/41as+WafrFL._SX258_BO1,204,203,200_.jpg",
    stock: 4,
    isBorrowed: 0,
    borrowedBy: []
  },
  {
    id: 4,
    title: "Deep Work",
    author: "Cal Newport",
    image: "https://images-na.ssl-images-amazon.com/images/I/41uPjEenkFL._SX331_BO1,204,203,200_.jpg",
    stock: 5,
    isBorrowed: 0,
    borrowedBy: []
  },
  {
    id: 5,
    title: "The Lean Startup",
    author: "Eric Ries",
    image: "https://images-na.ssl-images-amazon.com/images/I/51Zymoq7UnL._SX331_BO1,204,203,200_.jpg",
    stock: 2,
    isBorrowed: 0,
    borrowedBy: []
  },
  {
    id: 6,
    title: "Sapiens",
    author: "Yuval Noah Harari",
    image: "https://images-na.ssl-images-amazon.com/images/I/41Xx2O6UxUL._SX322_BO1,204,203,200_.jpg",
    stock: 4,
    isBorrowed: 0,
    borrowedBy: []
  },
  {
    id: 7,
    title: "Thinking, Fast and Slow",
    author: "Daniel Kahneman",
    image: "https://images-na.ssl-images-amazon.com/images/I/41Fv1RfIXRL._SX331_BO1,204,203,200_.jpg",
    stock: 3,
    isBorrowed: 0,
    borrowedBy: []
  },
  {
    id: 8,
    title: "Zero to One",
    author: "Peter Thiel",
    image: "https://images-na.ssl-images-amazon.com/images/I/41SOc75BBvL._SX331_BO1,204,203,200_.jpg",
    stock: 3,
    isBorrowed: 0,
    borrowedBy: []
  },
  {
    id: 9,
    title: "Hooked",
    author: "Nir Eyal",
    image: "https://images-na.ssl-images-amazon.com/images/I/41R6XENJQVL._SX329_BO1,204,203,200_.jpg",
    stock: 2,
    isBorrowed: 0,
    borrowedBy: []
  },
  {
    id: 10,
    title: "Deep Learning",
    author: "Ian Goodfellow",
    image: "https://images-na.ssl-images-amazon.com/images/I/41oe4GYJZrL._SX379_BO1,204,203,200_.jpg",
    stock: 1,
    isBorrowed: 0,
    borrowedBy: []
  },
];

function renderBooks() {
  bookList.innerHTML = "";
  books.forEach((book) => {
    const card = document.createElement("div");
    card.className = "book-card";

    card.innerHTML = `
      <button class="delete-book-btn" onclick="deleteBook(${book.id})" title="Hapus buku">×</button>
      <img src="${book.image}" alt="${book.title}" />
      <div class="book-title" title="${book.title}">${book.title}</div>
      <div class="book-author">${book.author}</div>
      <div class="book-stock">Stok: ${book.stock - book.isBorrowed}</div>
      <div class="book-action">
        ${
          book.stock - book.isBorrowed > 0
            ? `<button onclick="borrowBook(${book.id})">Pinjam</button>`
            : `<small>Stok kosong</small>`
        }
      </div>
      ${
        book.borrowedBy.includes(currentUser)
          ? `<div class="book-action"><button onclick="returnBook(${book.id})">Kembalikan</button></div>`
          : ""
      }
    `;

    bookList.appendChild(card);
  });
}

function borrowBook(id) {
  const book = books.find((b) => b.id === id);
  if (!book) return;

  if (book.stock - book.isBorrowed <= 0) {
    alert("Stok buku habis, tidak bisa dipinjam sekarang.");
    return;
  }

  if (book.borrowedBy.includes(currentUser)) {
    alert("Kamu sudah meminjam buku ini.");
    return;
  }

  book.isBorrowed += 1;
  book.borrowedBy.push(currentUser);
  alert(`Kamu meminjam buku: "${book.title}"`);
  renderBooks();
}

function returnBook(id) {
  const book = books.find((b) => b.id === id);
  if (!book) return;

  if (!book.borrowedBy.includes(currentUser)) {
    alert("Kamu belum meminjam buku ini.");
    return;
  }

  book.isBorrowed -= 1;
  book.borrowedBy = book.borrowedBy.filter((u) => u !== currentUser);
  alert(`Kamu mengembalikan buku: "${book.title}"`);
  renderBooks();
}

function deleteBook(id) {
  if (!confirm("Yakin ingin menghapus buku ini?")) return;
  books = books.filter((b) => b.id !== id);
  renderBooks();
}

addBookBtn.addEventListener("click", () => {
  const title = newTitle.value.trim();
  const author = newAuthor.value.trim();
  const image = newImage.value.trim();
  const stock = parseInt(newStock.value);

  if (!title || !author || !image || !stock) {
    addBookMsg.textContent = "Semua field harus diisi dengan benar!";
    addBookMsg.classList.remove("success");
    return;
  }

  if (!image.startsWith("http://") && !image.startsWith("https://")) {
    addBookMsg.textContent = "URL gambar harus valid (http/https)!";
    addBookMsg.classList.remove("success");
    return;
  }

  if (stock < 1) {
    addBookMsg.textContent = "Stok harus lebih dari 0!";
    addBookMsg.classList.remove("success");
    return;
  }

  const newId = books.length > 0 ? Math.max(...books.map((b) => b.id)) + 1 : 1;

  books.push({
    id: newId,
    title,
    author,
    image,
    stock,
    isBorrowed: 0,
    borrowedBy: []
  });

  addBookMsg.textContent = "Buku berhasil ditambahkan!";
  addBookMsg.classList.add("success");

  newTitle.value = "";
  newAuthor.value = "";
  newImage.value = "";
  newStock.value = "";

  renderBooks();
});

loginBtn.addEventListener("click", () => {
  const username = usernameInput.value.trim();
  const password = passwordInput.value.trim();

  if (!username || !password) {
    authMsg.textContent = "Username dan password tidak boleh kosong!";
    authMsg.classList.remove("success");
    return;
  }

  const user = users.find((u) => u.username === username && u.password === password);
  if (!user) {
    authMsg.textContent = "Username atau password salah!";
    authMsg.classList.remove("success");
    return;
  }

  currentUser = username;
  authMsg.textContent = "";
  usernameInput.value = "";
  passwordInput.value = "";

  authSection.style.display = "none";
  librarySection.style.display = "block";

  renderBooks();
});

signupBtn.addEventListener("click", () => {
  const username = usernameInput.value.trim();
  const password = passwordInput.value.trim();

  if (!username || !password) {
    authMsg.textContent = "Username dan password tidak boleh kosong!";
    authMsg.classList.remove("success");
    return;
  }

  if (users.find((u) => u.username === username)) {
    authMsg.textContent = "Username sudah digunakan!";
    authMsg.classList.remove("success");
    return;
  }

  users.push({ username, password });
  authMsg.textContent = "Signup berhasil, silakan login!";
  authMsg.classList.add("success");
});

logoutBtn.addEventListener("click", () => {
  currentUser = null;
  authSection.style.display = "block";
  librarySection.style.display = "none";
  authMsg.textContent = "";
});
