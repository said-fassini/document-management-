<!-- resources/views/documents/index.blade.php -->
<style>
    /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f6f8;
    color: #333;
    margin: 20px;
}

h2 {
    color: #0056b3;
    font-size: 1.5em;
    margin-top: 20px;
}

/* Styling the Lists */
ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

li {
    background-color: #ffffff;
    padding: 15px;
    margin-bottom: 10px;
    border: 1px solid #e0e0e0;
    border-radius: 5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Document Details */
li strong {
    color: #333;
    font-weight: 500;
    margin-right: 10px;
}

/* Download Link */
li a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
    margin-right: 10px;
}

li a:hover {
    text-decoration: underline;
}

/* Status */
li .status {
    font-style: italic;
    font-size: 0.9em;
    color: #999;
}

/* Button Styles */
button[type="submit"] {
    background-color: #28a745;
    color: white;
    border: none;
    padding: 5px 10px;
    font-size: 0.9em;
    cursor: pointer;
    border-radius: 3px;
    margin-left: 10px;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #218838;
}

/* Optional: Differentiating Unread and Read */
li.unread {
    border-left: 5px solid #ffc107;
}

li.read {
    border-left: 5px solid #28a745;
}

</style>
<h2>Your Uploaded Documents</h2>
<ul>
    @foreach ($sentDocuments as $document)
        <li>{{ $document->title }} - {{ $document->description }}</li>
    @endforeach
</ul>

<h2>Documents You Received</h2>
@if($receivedDocuments->isEmpty())
    <p>No documents with the status "readbyDGS" found.</p>
@else
    <ul>
        @foreach ($receivedDocuments as $document)
            <li class="{{ $document->status === 'readbyDGS' ? 'read' : '' }}">
                {{ $document->title }} - {{ $document->description }}
                <strong>Status:</strong> <span class="status">{{ ucfirst($document->status) }}</span>
                <!-- Download link -->
                <a href="{{ route('documents.download', $document->id) }}">Download</a>
            </li>
        @endforeach
    </ul>
@endif