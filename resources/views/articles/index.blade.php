<!DOCTYPE html>
<html>
<head>
    <title>News Aggregator</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">

    <!-- Yajra DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">

</head>
<body>

<div class="container mt-5">
    <h2 class="mb-4">News Aggregator</h2>
    <div class="row mb-4">
    <div class="col-md-3">
        <select id="sourceFilter" class="form-control">
            <option value="">All Sources</option>
            <option value="newsapi">NewsAPI</option>
            <option value="guardian">Guardian</option>
            <option value="nyt">NYT</option>
        </select>
    </div>

    <div class="col-md-3">
        <input type="text" id="categoryFilter" class="form-control" placeholder="Category">
    </div>
    
    <div class="col-md-3">
        <input type="text" id="AuthorFilter" class="form-control" placeholder="Auther">
    </div>
</div>
    <table class="table table-bordered" id="news-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Source</th>
                <th>Author</th>
                <th>Category</th>
                <th>Published At</th>
                <th>Link</th>
            </tr>
        </thead>
    </table>

</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<script>
$(function () {
    $('#news-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('article.data') }}",
            data: function (d) {
                d.source = $('#sourceFilter').val();
                d.category = $('#categoryFilter').val();
                d.author = $('#AuthorFilter').val();
            }
        },
        columns: [
            { data: 'id' },
            { data: 'title' },
            { data: 'source' },
            { data: 'category' },
            { data: 'author' },
            { data: 'published_at' },
            { data: 'link', orderable: false, searchable: false }
        ]
    });

    // Reload table on filter change
    $('#sourceFilter, #categoryFilter, #AuthorFilter').on('change keyup', function () {
        $('#news-table').DataTable().ajax.reload();
    });
});
</script>

</body>
</html>
