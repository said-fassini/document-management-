<!-- resources/views/documents/upload.blade.php -->
<style>
    /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f8;
    color: #333;
    margin: 20px;
}

/* Form Container */
form {
    background-color: #ffffff;
    padding: 20px;
    max-width: 400px;
    margin: 0 auto;
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Title */
h2 {
    color: #0056b3;
    text-align: center;
    font-size: 1.8em;
    margin-bottom: 20px;
}

/* Labels */
form label {
    font-size: 1em;
    color: #333;
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

/* Input Fields */
form input[type="text"],
form input[type="number"],
form input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 1em;
    background-color: #f9f9f9;
}

form input[type="file"] {
    padding: 8px;
}

/* Submit Button */
form button[type="submit"] {
    background-color: #007bff;
    color: white;
    font-size: 1em;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    transition: background-color 0.3s ease;
}

form button[type="submit"]:hover {
    background-color: #0056b3;
}

/* Add some space below each element */
form label,
form input,
form button {
    margin-bottom: 10px;
}

</style>
<h2>Upload Document</h2>
<form action="{{ route('documents.upload') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="description">Description:</label>
    <input type="text" name="description" required>
    
    <label for="receiver_id">Receiver ID:</label>
    <input type="number" name="receiver_id" required>

    <label for="file">File (PDF):</label>
    <input type="file" name="file" required>

    <button type="submit">Upload</button>
</form>