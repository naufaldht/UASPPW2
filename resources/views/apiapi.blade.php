<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Data Buku</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .book-list {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        .book-item {
            border: 1px solid #ddd;
            padding: 15px;
            border-radius: 8px;
        }
        .book-item img {
            max-width: 100px;
            display: block;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h1>Daftar Buku</h1>
    <div id="books" class="book-list">Memuat data buku...</div>

    <script>
        const apiURL = 'http://127.0.0.1:8000/api/books';

        async function fetchBooks() {
            try {
                const response = await fetch(apiURL);
                const result = await response.json();

                if (result.success) {
                    displayBooks(result.data.data);
                } else {
                    document.getElementById('books').innerText = 'Gagal mengambil data buku.';
                }
            } catch (error) {
                console.error('Error fetching books:', error);
                document.getElementById('books').innerText = 'Terjadi kesalahan dalam mengambil data.';
            }
        }

        function displayBooks(books) {
            const booksContainer = document.getElementById('books');
            booksContainer.innerHTML = '';

            books.forEach(book => {
                const bookItem = document.createElement('div');
                bookItem.classList.add('book-item');
                bookItem.innerHTML = `
                    <h2>${book.judul}</h2>
                    <p><strong>Penulis:</strong> ${book.penulis}</p>
                    <p><strong>Harga:</strong> Rp${book.harga.toLocaleString()}</p>
                    <p><strong>Tanggal Terbit:</strong> ${book.tgl_terbit}</p>
                    <img src="${book.filepath}" alt="${book.judul}" />
                `;
                booksContainer.appendChild(bookItem);
            });
        }

        fetchBooks();
    </script>
</body>
</html>

