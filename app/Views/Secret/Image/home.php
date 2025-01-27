<?php $this->layout('Secret::dashboard', ['title' => 'Images']) ?>

<?php $this->unshift('html_head') ?>
<style>
    /* Basic table styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        padding: 8px;
        text-align: left;
        border: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        cursor: pointer;
        position: relative;
    }

    th.asc::after {
        content: " ▲";
        font-size: 12px;
        position: absolute;
        right: 5px;
    }

    th.desc::after {
        content: " ▼";
        font-size: 12px;
        position: absolute;
        right: 5px;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        table {
            display: block;
            overflow-x: auto;
            white-space: nowrap;
        }
    }

    /* Filter and search styling */
    .filter {
        margin-bottom: 10px;
    }

    .filter label {
        margin-right: 10px;
    }

    .filter input,
    .filter select {
        padding: 5px;
    }
</style>
<?php $this->end() ?>

<form action="/dash/Article/8192/upload" method="post" enctype="multipart/form-data">
    <label for="file">Select a file:</label>
    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
    <input type="file" name="files[]" id="files">
    <input type="file" name="files[]" id="files">
    <input type="file" name="anothfiles[]" id="files">
    <input type="file" name="afile" id="files">
    <br><br>
    <input type="submit" value="Upload File">
</form>

<div class="row">
    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_images_deadlinks', ['externalController' => 'Article']); ?>" class="card border-0 flex-fill w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Images perdues</h5>
                        <h2 class="mb-0">Articles</h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('relations', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_images_deadlinks', ['externalController' => 'Organisation']); ?>" class="card border-0 flex-fill w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Images perdues</h5>
                        <h2 class="mb-0">Films</h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('relations', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-sm-6 col-lg-4 col-xl-3 d-flex">
        <a href="<?= $controller->router()->hyp('dash_images_deadlinks', ['externalController' => 'Professional']); ?>" class="card border-0 flex-fill w-100">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <h5 class="text-uppercase text-muted fw-semibold mb-2">Images perdues</h5>
                        <h2 class="mb-0">Personne</h2>
                    </div>
                    <div class="col-auto">
                        <?= $this->icon('relations', 30, ['class' => 'text-primary']); ?>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="filter">
    <label for="search">Search:</label>
    <input type="text" id="search" placeholder="Enter search term...">
    <label for="mime-filter">Filter by MIME Type:</label>
    <select id="mime-filter">
        <option value="">All</option>
        <?php
        // Generate distinct MIME type options
        $mimeTypes = array_unique(array_column($images, 'mime'));
        foreach ($mimeTypes as $mime) {
            echo "<option value=\"$mime\">$mime</option>";
        }
        ?>
    </select>

    <label for="path-filter">Filter by Path:</label>
    <select id="path-filter">
        <option value="">All</option>
        <option value="/auteur/">Auteur</option>
        <option value="/film/">Film</option>
        <option value="/organisation/">Organisation</option>
        <option value="/professional/">Professionel</option>
    </select>
</div>


<!-- Table -->
<table id="image-table">
    <thead>
        <tr>
            <th data-column="id">ID</th>
            <th data-column="path">Path</th>
            <th data-column="extension">Ext</th>
            <th data-column="size">Size</th>
            <th data-column="width">Width</th>
            <th data-column="height">Height</th>
            <th data-column="mime">MIME Type</th>
            <th data-column="is_active">Is Active</th>
        </tr>
    </thead>
    <tbody>
    </tbody>
</table>
<script type="application/json" id="images">
    <?= json_encode($images); ?>
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const images = JSON.parse(document.getElementById("images").textContent);
        let filteredImages = images;

        const table = document.getElementById("image-table");
        const headers = table.querySelectorAll("th");
        const searchInput = document.getElementById("search");
        const mimeFilter = document.getElementById("mime-filter");
        const pathFilter = document.getElementById("path-filter");

        // load the JSON
        function render() {
            const LIMIT = 1000;
            //create a fragment to append the new tr
            const fragment = document.createDocumentFragment();

            filteredImages.slice(0, LIMIT).forEach(image => {
                const row = document.createElement("tr");
                row.innerHTML = `
                <td>${image.id}</td>
                <td>${image.path}</td>
                <td>${image.extension}</td>
                <td>${image.size}</td>
                <td>${image.width}</td>
                <td>${image.height}</td>
                <td>${image.mime}</td>
                <td>${image.is_active}</td>
            `;
                fragment.appendChild(row);
            });
            table.querySelector("tbody").innerHTML = "";
            table.querySelector("tbody").appendChild(fragment);
        }

        // let filteredRows = Array.from(table.querySelectorAll("tbody tr"));

        // Function to filter rows based on search term, MIME type, and path
        function filterRows() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedMime = mimeFilter.value;
            const selectedPath = pathFilter.value;

            filteredImages = images.filter(image => {
                return (selectedMime === "" || image.mime === selectedMime) &&
                    (selectedPath === "" || image.path.includes(selectedPath)) &&
                    (searchTerm === "" || image.path.toLowerCase().includes(searchTerm));
            });
            console.log('count', filteredImages.length, 'total', images.length, 'search', searchTerm, 'mime', selectedMime, 'path', selectedPath);
            render();
        }

        // Sorting functionality
        headers.forEach(header => {
            header.addEventListener("click", () => {
                // Toggle sorting direction
                const isAscending = !header.classList.contains("asc");

                // Remove sorting indicators from all headers
                headers.forEach(h => h.classList.remove("asc", "desc"));

                header.classList.toggle("asc", isAscending);
                header.classList.toggle("desc", !isAscending);

                // Sort rows
                const column = header.getAttribute("data-column");

                if (column === 'id' || column === 'size' || column === 'width' || column === 'height' || column === 'is_active') {
                    filteredImages.sort((a, b) => {
                        const aValue = parseInt(a[column]);
                        const bValue = parseInt(b[column]);
                        return isAscending ? aValue - bValue : bValue - aValue;
                    });
                } else {
                    filteredImages.sort((a, b) => {
                        const aValue = a[column];
                        const bValue = b[column];
                        return isAscending ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
                    });
                }

                // Update filtered rows
                render();
            });
        });

        // Event listeners for search and filter
        searchInput.addEventListener("input", filterRows);
        mimeFilter.addEventListener("change", filterRows);
        pathFilter.addEventListener("change", filterRows);

        render(images);

    });
</script>