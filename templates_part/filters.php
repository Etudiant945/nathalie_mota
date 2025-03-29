<div class="filters-container">
    <div class="category-format-filters">
        <!-- Filter Categories -->
        <div class="categories-filter">
            <form class="filter-column" id="category-filter">
                <select id="categories" name="categorie" class="filters-container__photo-filter">
                    <option value="all" selected>CATÉGORIES</option>
                    <?php
                        $categories = get_terms(array(
                            "taxonomy" => "categorie", 
                            "hide_empty" => false,
                        ));
                        foreach ($categories as $categorie) {
                            echo '<option value="' . $categorie->slug . '" ' . (isset($_GET['categorie']) && $_GET['categorie'] == $categorie->slug ? 'selected' : '') . '>' . mb_convert_case($categorie->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                        }
                        ?>
                </select>
            </form>
        </div>

        <!-- Filter Formats -->
        <div class="formats-filter">
            <form class="filter-column" id="format-filter">
                <select id="formats" name="format" class="filters-container__photo-filter">
                    <option value="all" selected>FORMATS</option>
                    <?php
                        $formats = get_terms(array(
                            "taxonomy" => "format", 
                            "hide_empty" => false,
                        ));
                        foreach ($formats as $format) {
                            echo '<option value="' . $format->slug . '" ' . (isset($_GET['format']) && $_GET['format'] == $format->slug ? 'selected' : '') . '>' . mb_convert_case($format->name, MB_CASE_TITLE, "UTF-8") . '</option>';
                        }
                        ?>
                </select>
            </form>
        </div>
    </div>

    <!-- Filter Sort By Date -->
    <div class="sort-by-date-filter">
        <form class="filter-column" id="sort-filter">
            <select id="sort-by-date" name="sort" class="filters-container__photo-filter">
                <option value="all" selected>TRIER PAR</option>
                <option value="DESC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'DESC') ? 'selected' : ''; ?>>
                    Les Plus Récentes</option>
                <option value="ASC" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'ASC') ? 'selected' : ''; ?>>
                    Les Plus Anciennes</option>
            </select>
        </form>
    </div>
</div>

</section>