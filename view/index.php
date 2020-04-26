<?php include("view/header.html"); ?>
    <div class="container mt-5">
    <form name="quoteSort" action="admin.php?action=sort" method="post">
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <select class="form-control" name="author">
                        <option value="" <?php print ((isset($authorSort) and strlen($authorSort)) ? "SELECTED" : ""); ?>>
                            View All Authors
                        </option>
                        <?php
                        if (isset($authors) and count($authors)) {
                            foreach ($authors as $author) {
                                print "<option value='" . $author['id'] . "' " . ((isset($authorSort) and $authorSort == $author['id']) ? "SELECTED" : "") . ">" . proper($author['author']) . "</option>\n";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <select class="form-control" name="category">
                        <option value="" <?php print ((isset($categorySort) and strlen($categorySort)) ? "SELECTED" : ""); ?>>
                            View All Categories
                        </option>
                        <?php
                        if (isset($categories) and count($categories)) {
                            foreach ($categories as $category) {
                                print "<option value='" . $category['id'] . "' " . ((isset($categorySort) and $categorySort == $category['id']) ? "SELECTED" : "") . ">" . proper($category['category']) . "</option>\n";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <div class="form-group">
                    <div class="form-control">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="formSort" id="sort1" value="0"
                                <?php print ((isset($formSort) and !$formSort) ? "CHECKED" : ""); ?>>
                            <label class="form-check-label mr-3" for="sort1">Id</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="formSort" id="sort2" value="1"
                                <?php print (((isset($formSort) and $formSort) or !isset($formSort)) ? "CHECKED" : ""); ?>>
                            <label class="form-check-label" for="sort2">Quote</label>
                        </div>
                        <button type="submit" class="btn btn-primary ml-3">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row mt-4">
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Category</th>
                <th scope="col">Author</th>
                <th scope="col">Quote</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (isset($quotes) and count($quotes)) {
                foreach ($quotes as $quote) {
                    print "<tr>\n";
                    print "<td>" . $quote['id'] . "</td>\n";
                    print "<td>" . proper($quote['category']) . "</td>\n";
                    print "<td>" . proper($quote['author']) . "</td>\n";
                    print "<td>" . proper($quote['text']) . "</td>\n";
                }
            } else {
                print "<tr>\n";
                print "<td colspan='7'>No quotes currently available</td>\n";
            }
            ?>
            </tbody>
        </table>
    </div>
    <div class="row mt-4">
        <div class="col text-center">
            <button class="btn btn-outline-primary" type="button" id="requestQuote">Request New Quote</button>
        </div>
    </div>

    <section>
        <?php include("modals/index/modal_login.html"); ?>
        <?php include("modals/index/modal_request_quote.php"); ?>
        <?php include("modals/common/modal_general.html"); ?>
        <?php include("modals/common/modal_response_errors.html"); ?>
    </section>

<?php include("view/footer.html"); ?>