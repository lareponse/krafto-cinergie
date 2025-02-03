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
    <label for="search">Search:
        <input type="text" id="search" placeholder="Enter search term..."></label>
    <label for="mime-filter">Filter by MIME Type:
        <select id="mime-filter">
            <option value="">All</option>
            <?php
            // Generate distinct MIME type options
            foreach ($mime_types as $value) {
                echo "<option value=\"$value\">$value</option>";
            }
            ?>
        </select>
    </label>

    <label for="path-filter">Répertoire
        <select id="path-filter">
            <option value="">All</option>
            <?php
            $directories = array_unique(array_map(function ($image) {
                return preg_match('/^(\/[a-zA-Z]+\/)/', $image['path'], $matches) ? $matches[1] : $image['path'];
            }, $images));
            sort($directories);
            foreach ($directories as $value) {
                echo "<option value=\"$value\">$value</option>";
            }
            ?>
        </select>
    </label>

    <!-- Custom Filters -->
    <label for="size-filter">Taille
        <select id="size-filter">
            <option value="">Tous</option>
            <option value="too-urgent">Urgent (> 1 MB)</option>
            <option value="too-heavy">Trop Lourd (> 500 KB)</option>
            <option value="too-big">Trop Grand (Largeur > 1920px ou Hauteur > 1080px)</option>
            <option value="too-small">Trop Petit (Largeur < 320px ou Hauteur < 480px)</option>
        </select>
    </label>
</div>

<div class="d-flex gap-4">
    <strong id="image_table_total"></strong>
    <strong id="image_table_selected"></strong>
    <strong id="image_table_visible"></strong>
</div>
<!-- Table -->
<table id="image_table">
    <thead>
        <tr>
            <th data-column="id" data-type="int">ID</th>
            <th data-column="path">Chemin</th>
            <th data-column="extension">Ext</th>
            <th data-column="size" data-type="int">Taille</th>
            <th data-column="width" data-type="int">Largeur</th>
            <th data-column="height" data-type="int">Hauteur</th>
            <th data-column="expected_size">Expected Size (KB)</th>
            <th data-column="mime">Type MIME</th>
            <th data-column="is_active" data-type="int">Actif</th>
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

        const table = document.getElementById("image_table");
        const headers = table.querySelectorAll("th");
        const searchInput = document.getElementById("search");
        const mimeFilter = document.getElementById("mime-filter");
        const pathFilter = document.getElementById("path-filter");
        const sizeFilter = document.getElementById("size-filter");

        const LIMIT = 1000;

        // Define thresholds for custom filters
        const TOO_URGENT_SIZE = 1000 * 1024; // 500 KB
        const TOO_HEAVY_SIZE = 500 * 1024; // 500 KB
        const TOO_BIG_WIDTH = 1920; // Full HD width
        const TOO_BIG_HEIGHT = 1080; // Full HD height
        const TOO_SMALL_WIDTH = 320; // Mobile width
        const TOO_SMALL_HEIGHT = 480; // Mobile height


        // Event listeners for search and filter
        searchInput.addEventListener("input", filterRows);
        mimeFilter.addEventListener("change", filterRows);
        pathFilter.addEventListener("change", filterRows);
        sizeFilter.addEventListener("change", filterRows);

        // Initial render
        render();


        function computeExpectedSize(width, height, qualityFactor = 0.2, compressionThreshold = 2) {
            return Math.round((width * height * qualityFactor) / (1024 * compressionThreshold));
        }
        // Render the table
        function render() {
            const fragment = document.createDocumentFragment();

            filteredImages.slice(0, LIMIT).forEach(image => {
                const expectedSize = computeExpectedSize(image.width, image.height, 0.3, 2);

                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${image.id}</td>
                    <td>${image.path}</td>
                    <td>${image.extension}</td>
                    <td>${(image.size / 1024).toFixed(2)} KB</td>
                    <td>${image.width}</td>
                    <td>${image.height}</td>
                    <td>${expectedSize} KB</td>
                    <td>${image.mime}</td>
                    <td>${image.is_active}</td>
                `;

                row.addEventListener('click', (e) => {
                    let img, tr;
                    tr = e.target.closest('tr');
                    img = tr.querySelector('img');
                    if (img) {
                        img.remove();
                    } else {
                        img = document.createElement("img");
                        img.src = `/public/images/${image.path}`;

                        e.target.append(img);
                    }

                });
                row.addEventListener('unfocus', (e) => {
                    e.target.querySelector('img')?.remove();
                });
                fragment.appendChild(row);
            });
            table.querySelector("tbody").innerHTML = "";
            table.querySelector("tbody").appendChild(fragment);

            document.getElementById("image_table_total").textContent = `Total: ${images.length}`;
            document.getElementById("image_table_selected").textContent = `Selected: ${filteredImages.length}`;
            document.getElementById("image_table_visible").textContent = `Visible: ${Math.min(LIMIT, filteredImages.length)}`;
        }

        // Function to filter rows based on search term, MIME type, path, and custom filters
        function filterRows() {
            const searchTerm = searchInput.value.toLowerCase();
            const selectedMime = mimeFilter.value;
            const selectedPath = pathFilter.value;
            const selectedSizeFilter = sizeFilter.value;

            filteredImages = images.filter(image => {
                // Apply search, MIME, and path filters
                const matchesSearch = searchTerm === "" || image.path.toLowerCase().includes(searchTerm);
                const matchesMime = selectedMime === "" || image.mime === selectedMime;
                const matchesPath = selectedPath === "" || image.path.includes(selectedPath);

                // Apply custom size filters
                let matchesSize = true;
                if (selectedSizeFilter === "too-urgent") {
                    matchesSize = image.size > TOO_URGENT_SIZE;
                } else if (selectedSizeFilter === "too-heavy") {
                    matchesSize = image.size > TOO_HEAVY_SIZE;
                } else if (selectedSizeFilter === "too-big") {
                    matchesSize = image.width > TOO_BIG_WIDTH || image.height > TOO_BIG_HEIGHT;
                } else if (selectedSizeFilter === "too-small") {
                    matchesSize = image.width < TOO_SMALL_WIDTH || image.height < TOO_SMALL_HEIGHT;
                }

                return matchesSearch && matchesMime && matchesPath && matchesSize;
            });

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

                if (header.getAttribute("data-type") === 'int') {
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


    });
</script>